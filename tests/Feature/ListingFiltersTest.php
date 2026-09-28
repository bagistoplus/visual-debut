<?php

use BagistoPlus\VisualDebut\Support\HandlesProductListing;
use Illuminate\Support\Collection;

/**
 * A listing over two facets, a colour with options 1, 2 and 3 and a price
 * spanning 0 to 100, with the pagination the trait expects underneath it.
 */
function listing(array $filters = []): object
{
    $listing = new class
    {
        use HandlesProductListing {
            queryString as traitQueryString;
        }

        public int $pageResets = 0;

        public function availableFilters(): Collection
        {
            return collect([
                (object) ['code' => 'color', 'type' => 'select', 'options' => collect([
                    (object) ['id' => 1], (object) ['id' => 2], (object) ['id' => 3],
                ])],
                (object) ['code' => 'price', 'type' => 'price', 'options' => collect()],
            ]);
        }

        public function getPage(): int
        {
            return 1;
        }

        public function resetPage(): void
        {
            $this->pageResets++;
        }

        public function initialize(array $filters): void
        {
            $this->filters = $filters;
            $this->initializeFilters();
        }

        public function queryString(): array
        {
            return $this->traitQueryString();
        }

        public function params(): array
        {
            return $this->productParams(['category_id' => 7]);
        }
    };

    $listing->maxPrice = 100;
    $listing->initialize($filters);

    return $listing;
}

it('gives every facet an entry and drops what the URL invented', function (): void {
    $listing = listing(['color' => 'abc,2,999', 'brand' => '4']);

    expect($listing->filters)->toBe(['color' => '2', 'price' => '']);
});

it('normalises a price to two ordered numbers inside the span, and drops one that narrows nothing', function (): void {
    expect(listing(['price' => '80,20'])->filters['price'])->toBe('20,80')
        ->and(listing(['price' => '-5,500'])->filters['price'])->toBe('')
        ->and(listing(['price' => '10'])->filters['price'])->toBe('')
        ->and(listing(['price' => 'a,b'])->filters['price'])->toBe('');
});

it('checks what the client writes into a facet, resetting the page each time', function (): void {
    $listing = listing(['color' => '1']);

    $listing->updatedFilters('1,3,9', 'color');

    expect($listing->filters['color'])->toBe('1,3');

    $listing->updatedFilters('3', 'color');
    $listing->updatedFilters('90,10', 'price');
    $listing->updatedFilters(['1'], 'brand');

    expect($listing->filters)->toBe(['color' => '3', 'price' => '10,90'])
        ->and($listing->pageResets)->toBe(3);
});

it('sends the catalog only the applied facets, under Bagisto\'s own names', function (): void {
    $listing = listing(['color' => '1,2']);

    $listing->applyPriceRange('price', '30,10');
    $listing->applyPriceRange('price', '10,30');

    expect($listing->params())->toBe(['category_id' => 7, 'color' => '1,2', 'price' => '10,30'])
        ->and($listing->pageResets)->toBe(1);

    $listing->resetFilters();

    expect($listing->params())->toBe(['category_id' => 7])
        ->and($listing->queryString())->toBe([
            'filters.color' => ['as' => 'color', 'except' => '', 'history' => true],
            'filters.price' => ['as' => 'price', 'except' => '', 'history' => true],
        ]);
});
