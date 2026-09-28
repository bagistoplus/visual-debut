<?php

namespace BagistoPlus\VisualDebut\Support;

use BagistoPlus\Visual\Actions\GetProducts;
use Closure;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Product\Models\Product;

use function BagistoPlus\VisualDebut\core;

/**
 * What a listing works out about the catalog, kept between requests.
 *
 * A listing interaction is a Livewire POST, which no page cache serves, so
 * everything the listing recomputes on a click has to be kept here or not at
 * all. Deciding which products match is the expensive half: on a catalog of
 * fifty thousand the search costs seconds, fetching those products by id costs
 * milliseconds. So the ids are cached and the products are not, and a price or
 * a stock level is never served stale.
 */
class CatalogCache
{
    /**
     * What Bagisto's own search eager loads, copied from
     * `ProductRepository::searchFromDatabase`. A product fetched without them
     * lazy loads per card: the price and the stock badge each read a relation.
     *
     * @var array<int, string>
     */
    public const SEARCH_RELATIONS = [
        'attribute_family',
        'images',
        'videos',
        'attribute_values',
        'price_indices',
        'inventory_indices',
        'reviews',
        'variants',
        'variants.attribute_family',
        'variants.attribute_values',
        'variants.price_indices',
        'variants.inventory_indices',
    ];

    private const VERSION_KEY = 'visual_debut_catalog_version';

    private const VERSION_TTL = 31536000;

    /**
     * A backstop for a catalog edited outside Bagisto. Every entry is retired
     * on a catalog event long before this runs out.
     */
    private const TTL = 3600;

    /**
     * The generation every key is built against.
     *
     * Invalidation bumps this rather than deleting anything: Laravel has no
     * wildcard delete, and cache tags are absent from the file and database
     * stores. A bump makes the whole previous generation unreachable at once.
     */
    public function version(): int
    {
        return (int) Cache::get(self::VERSION_KEY, 1);
    }

    /**
     * Seeded with `add` and advanced with `increment`, both atomic, so two
     * administrators saving at the same moment count twice rather than once.
     */
    public function flush(): void
    {
        Cache::add(self::VERSION_KEY, 1, self::VERSION_TTL);

        Cache::increment(self::VERSION_KEY);
    }

    /**
     * @param  array<string, mixed>  $params
     */
    public function remember(string $segment, array $params, Closure $callback): mixed
    {
        return Cache::remember($this->key($segment, $params), self::TTL, $callback);
    }

    /**
     * One page of a listing: the ids and the pagination numbers come from the
     * cache, the products from the database.
     *
     * @param  array<string, mixed>  $params  Exactly the query the listing owns.
     */
    public function products(array $params, bool $trackSearch = false): mixed
    {
        if (! $this->cacheable($params, $trackSearch)) {
            return app(GetProducts::class)->execute($params, $trackSearch);
        }

        $page = $this->remember('products', $params, function () use ($params) {
            $results = app(GetProducts::class)->execute($params, false);

            if (! $results instanceof LengthAwarePaginator) {
                return null;
            }

            return [
                'ids' => $results->getCollection()->map(fn (mixed $product): int => (int) $product->id)->all(),
                'total' => (int) $results->total(),
                'perPage' => (int) $results->perPage(),
                'currentPage' => (int) $results->currentPage(),
            ];
        });

        if ($page === null) {
            return null;
        }

        return new LengthAwarePaginator(
            $this->fetchByIds($page['ids']),
            $page['total'],
            max(1, $page['perPage']),
            $page['currentPage'],
            ['path' => Paginator::resolveCurrentPath()],
        );
    }

    /**
     * A text search is never cached, for the reason Bagisto gives for not
     * caching its own: the term space is unbounded, and the term has to be
     * counted on every request rather than once. A store on Elasticsearch
     * never needs it: `searchFromElastic` already resolves ids from the index.
     *
     * @param  array<string, mixed>  $params
     */
    private function cacheable(array $params, bool $trackSearch): bool
    {
        if ($trackSearch || ($params['query'] ?? '') !== '') {
            return false;
        }

        return ! $this->usesElasticsearch();
    }

    /**
     * The rule `GetProducts` applies: the storefront reads Elasticsearch only
     * when the engine is elastic and the storefront mode agrees.
     */
    private function usesElasticsearch(): bool
    {
        return core()->getConfigData('catalog.products.search.engine') === 'elastic'
            && core()->getConfigData('catalog.products.search.storefront_mode') === 'elastic';
    }

    /**
     * The products the search picked, in the order it picked them.
     *
     * @param  array<int, int>  $ids
     * @return Collection<int, Product>
     */
    protected function fetchByIds(array $ids): Collection
    {
        if ($ids === []) {
            return new Collection;
        }

        $column = DB::getTablePrefix().'products.id';

        $order = function_exists('db_grammar')
            ? db_grammar()->orderByField($column, $ids)
            : 'FIELD('.$column.', '.implode(',', array_map('intval', $ids)).')';

        return Product::with(self::SEARCH_RELATIONS)
            ->whereIn('id', $ids)
            ->orderByRaw($order)
            ->get();
    }

    /**
     * Everything that changes the answer, in the key. The customer group is
     * there because Bagisto scopes the price index join to it, so two groups
     * can match different products.
     *
     * @param  array<string, mixed>  $params
     */
    private function key(string $segment, array $params): string
    {
        ksort($params);

        return implode(':', [
            'visual_debut',
            $this->version(),
            $segment,
            data_get(core()->getCurrentChannel(), 'id'),
            data_get(core()->getCurrentLocale(), 'code'),
            core()->getCurrentCurrencyCode(),
            $this->customerGroupId(),
            md5(json_encode($params)),
        ]);
    }

    /**
     * Asked of Bagisto rather than worked out here, so the key names the group
     * the search itself joined on, guest group included.
     */
    private function customerGroupId(): int
    {
        return (int) app(CustomerRepository::class)->getCurrentGroup()->id;
    }
}
