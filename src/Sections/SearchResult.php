<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\GetProducts;
use BagistoPlus\Visual\Sections\LivewireSection;
use BagistoPlus\VisualDebut\Support\HandlesProductListing;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Webkul\Attribute\Repositories\AttributeRepository;

use function BagistoPlus\VisualDebut\_t;

class SearchResult extends LivewireSection
{
    use HandlesProductListing;
    use WithPagination;

    protected static array $enabledOn = ['search'];

    protected static string $view = 'shop::sections.search-result';

    public static function name(): string
    {
        return _t('search-result.name');
    }

    public static function description(): string
    {
        return _t('search-result.description');
    }

    public function paginationView()
    {
        return 'shop::pagination.default';
    }

    public function paginationSimpleView()
    {
        return 'shop::pagination.default';
    }

    #[Computed(persist: true)]
    public function availableFilters()
    {
        $filterableAttributes = app(AttributeRepository::class)->getFilterableAttributes();

        return $filterableAttributes->filter(function ($filter) {
            return $filter->type === 'price' || $filter->options->isNotEmpty();
        });
    }

    public function mount()
    {
        $this->initializeMaxPrice();
        $this->initializeFilters();
        $this->initializeSort();
    }

    public function getViewData(): array
    {
        return [
            'products' => app(GetProducts::class)->execute(
                $this->buildProductParams()
            ),
        ];
    }
}
