<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\GetProducts;
use BagistoPlus\Visual\Blocks\LivewireSection;
use BagistoPlus\VisualDebut\Support\HandlesProductListing;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Webkul\Attribute\Repositories\AttributeRepository;

use function BagistoPlus\VisualDebut\_t;

class SearchResult extends LivewireSection
{
    protected static string $type = '@visual-debut/search-result';

    use HandlesProductListing;
    use WithPagination;

    protected static array $enabledOn = [
        'templates' => ['search'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.search-result';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>';

    protected static string $category = 'Search';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/search-result.png';

    public static function name(): string
    {
        return _t('sections.search-result.name');
    }

    public static function description(): string
    {
        return _t('sections.search-result.description');
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
