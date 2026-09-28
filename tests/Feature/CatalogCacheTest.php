<?php

use BagistoPlus\Visual\Actions\GetProducts;
use BagistoPlus\VisualDebut\Listeners\FlushCatalogCache;
use BagistoPlus\VisualDebut\Support\CatalogCache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Facades\Core;
use Webkul\Customer\Repositories\CustomerRepository;

/**
 * The shopper's channel, locale, currency and search engine, which the key
 * and the bypass read from Bagisto's core, without a Bagisto.
 */
function fakeCore(string $engine = 'database', string $storefrontMode = 'database'): void
{
    Core::swap(new class($engine, $storefrontMode)
    {
        public function __construct(private readonly string $engine, private readonly string $mode) {}

        public function getCurrentChannel(): object
        {
            return (object) ['id' => 1];
        }

        public function getCurrentLocale(): object
        {
            return (object) ['code' => 'en'];
        }

        public function getCurrentCurrencyCode(): string
        {
            return 'USD';
        }

        public function getConfigData(string $field): mixed
        {
            return match ($field) {
                'catalog.products.search.engine' => $this->engine,
                'catalog.products.search.storefront_mode' => $this->mode,
                default => null,
            };
        }
    });
}

function fakeCustomerGroup(int $id): void
{
    app()->instance(CustomerRepository::class, new class($id)
    {
        public function __construct(private readonly int $id) {}

        public function getCurrentGroup(): object
        {
            return (object) ['id' => $this->id];
        }
    });
}

/**
 * Records every search, so a second one shows the cache did not hold.
 */
function recordSearches(array $ids = [11, 22, 33], int $total = 90): object
{
    $fake = new class($ids, $total)
    {
        /** @var list<array<string, mixed>> */
        public array $paramsPerCall = [];

        /** @var list<bool> */
        public array $tracked = [];

        public function __construct(private readonly array $ids, private readonly int $total) {}

        public function execute(array $params, bool $trackSearch = true): LengthAwarePaginator
        {
            $this->paramsPerCall[] = $params;
            $this->tracked[] = $trackSearch;

            return new LengthAwarePaginator(
                collect($this->ids)->map(fn (int $id): object => (object) ['id' => $id]),
                $this->total,
                15,
                (int) ($params['page'] ?? 1),
            );
        }
    };

    app()->instance(GetProducts::class, $fake);

    return $fake;
}

/**
 * The ids a cached page hands back, without a products table to fetch from.
 */
function catalogCache(): CatalogCache
{
    return new class extends CatalogCache
    {
        protected function fetchByIds(array $ids): Collection
        {
            return collect($ids)->map(fn (int $id): object => (object) ['id' => $id]);
        }
    };
}

beforeEach(function (): void {
    fakeCore();
    fakeCustomerGroup(1);
    Event::listen(FlushCatalogCache::EVENTS, FlushCatalogCache::class);
});

it('searches once for a page and keeps which products matched', function (): void {
    $fake = recordSearches();

    $first = catalogCache()->products(['category_id' => 7]);
    $second = catalogCache()->products(['category_id' => 7]);

    expect($fake->paramsPerCall)->toHaveCount(1)
        ->and($second->getCollection()->pluck('id')->all())->toBe([11, 22, 33])
        ->and($second->total())->toBe(90)
        ->and($second->lastPage())->toBe($first->lastPage());
});

// The order is the answer as much as the set is. This pins the half that is
// plain PHP, that the cached ids keep their order; the SQL that restores it
// over the fetched models needs a products table and is checked in a browser.
it('keeps the order the search picked, through the cache', function (): void {
    recordSearches(ids: [33, 11, 22]);

    catalogCache()->products(['category_id' => 7]);

    expect(catalogCache()->products(['category_id' => 7])->getCollection()->pluck('id')->all())
        ->toBe([33, 11, 22]);
});

it('keeps each page and each narrowing apart', function (): void {
    $fake = recordSearches();

    catalogCache()->products(['category_id' => 7]);
    catalogCache()->products(['category_id' => 7, 'page' => 2]);
    catalogCache()->products(['category_id' => 7, 'color' => '3']);

    expect($fake->paramsPerCall)->toHaveCount(3);
});

// Bagisto scopes the price index join to the group, so two groups can match
// different products for the same filters.
it('keeps each customer group apart', function (): void {
    $fake = recordSearches();

    catalogCache()->products(['category_id' => 7]);

    fakeCustomerGroup(2);

    catalogCache()->products(['category_id' => 7]);

    expect($fake->paramsPerCall)->toHaveCount(2);
});

it('searches again once the catalog changes', function (): void {
    $fake = recordSearches();

    catalogCache()->products(['category_id' => 7]);

    Event::dispatch('catalog.product.update.after', (object) ['id' => 11]);

    catalogCache()->products(['category_id' => 7]);

    expect($fake->paramsPerCall)->toHaveCount(2);
});

// Elasticsearch already resolves ids without the join this avoids, so a store
// on it goes straight through and pays nothing for staleness.
it('leaves a store on elasticsearch alone', function (): void {
    fakeCore('elastic', storefrontMode: 'elastic');

    $fake = recordSearches();

    catalogCache()->products(['category_id' => 7]);
    catalogCache()->products(['category_id' => 7]);

    expect($fake->paramsPerCall)->toHaveCount(2);
});

// A store indexing into Elasticsearch can still read from SQL, which is what
// `storefront_mode` says, and then the cache is worth having.
it('still caches when only the admin is on elasticsearch', function (): void {
    fakeCore('elastic', storefrontMode: 'database');

    $fake = recordSearches();

    catalogCache()->products(['category_id' => 7]);
    catalogCache()->products(['category_id' => 7]);

    expect($fake->paramsPerCall)->toHaveCount(1);
});

it('never caches a text search, and still counts the term', function (): void {
    $fake = recordSearches();

    catalogCache()->products(['query' => 'sock'], trackSearch: true);
    catalogCache()->products(['query' => 'sock']);

    expect($fake->paramsPerCall)->toHaveCount(2)
        ->and($fake->tracked)->toBe([true, false]);
});
