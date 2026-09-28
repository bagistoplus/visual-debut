<?php

namespace BagistoPlus\VisualDebut\Support;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Webkul\Product\Helpers\Toolbar;
use Webkul\Product\Repositories\ProductRepository;

trait HandlesProductListing
{
    public $maxPrice = 0;

    #[Url]
    public $sort = '';

    #[Url(except: '')]
    public $limit = '';

    /**
     * The applied selections, keyed by Bagisto's attribute code and holding the
     * chosen option ids comma joined, or `min,max` for a price, which is how
     * the catalog reads them. Empty means not applied.
     *
     * Bound to the URL under the code itself, see `queryString()`, so a link
     * reads `?color=1,2&price=10,50` here and in the default Bagisto theme.
     *
     * @var array<string, string>
     */
    public array $filters = [];

    #[Url(as: 'mode')]
    public $displayMode = 'grid';

    /**
     * @return Collection<int, mixed>
     */
    abstract public function availableFilters();

    /**
     * Bind every facet to the parameter name Bagisto itself uses.
     *
     * @return array<string, array<string, mixed>>
     */
    protected function queryString(): array
    {
        return $this->availableFilters()
            ->mapWithKeys(fn ($filter): array => [
                'filters.'.$filter->code => [
                    'as' => $filter->code,
                    'except' => '',
                    'history' => true,
                ],
            ])
            ->all();
    }

    /**
     * Tick or untick one option of one facet.
     */
    public function toggleFilter(string $code, string $value): void
    {
        $filter = $this->availableFilters()->first(fn ($candidate): bool => $candidate->code === $code);

        if (! $filter || $filter->type === 'price' || ! $filter->options->contains('id', (int) $value)) {
            return;
        }

        $applied = $this->appliedIds($code);

        $selected = in_array($value, $applied, true)
            ? array_values(array_diff($applied, [$value]))
            : [...$applied, $value];

        $this->filters[$code] = $this->validValue($filter, implode(',', $selected));

        $this->resetPage();
    }

    /**
     * @param  string  $value  `min,max` in the shopper's display currency.
     */
    public function applyPriceRange(string $code, string $value): void
    {
        $filter = $this->availableFilters()->first(fn ($candidate): bool => $candidate->code === $code);

        if (! $filter || $filter->type !== 'price') {
            return;
        }

        $applied = $this->validValue($filter, $value);

        if ($applied === ($this->filters[$code] ?? '')) {
            return;
        }

        $this->filters[$code] = $applied;

        $this->resetPage();
    }

    public function resetFilters(): void
    {
        $this->filters = array_map(fn (): string => '', $this->filters);

        $this->resetPage();
    }

    public function updatedSort()
    {
        $this->resetPage();
    }

    public function updatedLimit($value)
    {
        $this->resetPage();
    }

    public function updatedDisplayMode()
    {
        $this->resetPage();
    }

    #[Computed]
    public function availableSortOptions()
    {
        return app(Toolbar::class)->getAvailableOrders();
    }

    #[Computed]
    public function availablePaginationLimits()
    {
        return app(Toolbar::class)->getAvailableLimits();
    }

    /**
     * The top of the price span, which is an aggregate over every price index
     * row the listing covers: on a large catalog the one query on the page that
     * costs more than the cards. It is kept with the product ids, on the same
     * generation, so a catalog change retires it with them. The cache key
     * already carries the customer group the query scopes on.
     */
    protected function initializeMaxPrice(array $params = [])
    {
        $this->maxPrice = core()->convertPrice(app(CatalogCache::class)->remember(
            'maxPrice',
            $params,
            fn (): float => ceil((float) app(ProductRepository::class)->getMaxPrice($params)),
        ));
    }

    /**
     * Every facet gets an entry, and whatever the URL brought is checked
     * against the facet set, so a hand written address corrects itself.
     */
    protected function initializeFilters(): void
    {
        $this->filters = $this->validFilters($this->filters);
    }

    protected function initializeSort(): void
    {
        if ($this->sort) {
            return;
        }

        $defaultSort = app(Toolbar::class)->getDefaultOrder();

        if ($defaultSort) {
            $this->sort = $defaultSort['value'];
        }
    }

    /**
     * @param  array<string, mixed>  $filters
     * @return array<string, string>
     */
    protected function validFilters(array $filters): array
    {
        return $this->availableFilters()
            ->mapWithKeys(fn ($filter): array => [
                $filter->code => $this->validValue($filter, (string) ($filters[$filter->code] ?? '')),
            ])
            ->all();
    }

    private function validValue(mixed $filter, string $value): string
    {
        if ($value === '') {
            return '';
        }

        if ($filter->type === 'price') {
            return $this->validPrice($value);
        }

        $chosen = explode(',', $value);

        return $filter->options
            ->pluck('id')
            ->map(fn (mixed $id): string => (string) $id)
            ->filter(fn (string $id): bool => in_array($id, $chosen, true))
            ->implode(',');
    }

    /**
     * Two numbers, lowest first, inside the span the listing sells, which is
     * the shape Bagisto reads `price` in. A pair that spans everything narrows
     * nothing, so it is stored empty and leaves the URL.
     */
    private function validPrice(string $value): string
    {
        $bounds = array_slice(explode(',', $value), 0, 2);

        if (count($bounds) !== 2 || ! is_numeric($bounds[0]) || ! is_numeric($bounds[1])) {
            return '';
        }

        $max = (float) $this->maxPrice;
        $from = min(max((float) $bounds[0], 0), $max);
        $to = min(max((float) $bounds[1], 0), $max);

        if ($from > $to) {
            [$from, $to] = [$to, $from];
        }

        if ($from <= 0 && $to >= $max) {
            return '';
        }

        return $from.','.$to;
    }

    /**
     * @return array<int, string>
     */
    protected function appliedIds(string $code): array
    {
        $value = $this->filters[$code] ?? '';

        return $value === '' ? [] : explode(',', $value);
    }

    /**
     * The span the price slider shows: the applied one, or the whole span.
     *
     * @return array{0: float, 1: float}
     */
    public function priceBounds(string $code = 'price'): array
    {
        $applied = $this->appliedIds($code);

        return count($applied) === 2
            ? [(float) $applied[0], (float) $applied[1]]
            : [0.0, (float) $this->maxPrice];
    }

    /**
     * The applied option ids of one facet, for the view.
     *
     * @return array<int, string>
     */
    public function appliedOptions(string $code): array
    {
        return $this->appliedIds($code);
    }

    /**
     * Everything that changes the results, for `wire:target`. One list, so a
     * loading state never names some of the controls and not others.
     */
    public function resultsTargets(): string
    {
        return implode(',', [
            'toggleFilter', 'applyPriceRange', 'resetFilters',
            'sort', 'limit', 'displayMode',
            'gotoPage', 'nextPage', 'previousPage', 'setPage',
        ]);
    }

    /**
     * One page of results for this listing, through the catalog cache.
     *
     * @param  array<string, mixed>  $subject  What the page lists: a category, or a search term.
     */
    protected function fetchProducts(array $subject = [], bool $trackSearch = false): mixed
    {
        return app(CatalogCache::class)->products($this->productParams($subject), $trackSearch);
    }

    /**
     * Exactly the query the listing owns, and nothing from the request. Bagisto
     * turns every key into a filter, so a tracking parameter must never reach
     * it, and the cache keys on this array, so the page has to be in it: on a
     * Livewire request the URL carries none. An untouched facet is dropped
     * rather than sent empty.
     *
     * @param  array<string, mixed>  $subject
     * @return array<string, mixed>
     */
    protected function productParams(array $subject = []): array
    {
        $page = (int) $this->getPage();

        return [
            ...$subject,
            ...array_filter($this->filters, fn (string $value): bool => $value !== ''),
            ...($this->sort === '' ? [] : ['sort' => $this->sort]),
            ...($this->limit === '' ? [] : ['limit' => (int) $this->limit]),
            ...($page === 1 ? [] : ['page' => $page]),
        ];
    }
}
