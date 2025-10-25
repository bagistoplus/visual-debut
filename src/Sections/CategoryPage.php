<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\GetProducts;
use BagistoPlus\Visual\Blocks\LivewireSection;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\VisualDebut\Support\HandlesProductListing;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Webkul\Attribute\Repositories\AttributeRepository;

use function BagistoPlus\VisualDebut\_t;

class CategoryPage extends LivewireSection
{
    protected static string $type = '@visual-debut/category-page';

    use HandlesProductListing;
    use WithPagination;

    protected static array $enabledOn = [
        'templates' => ['category'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.category-page';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>';

    protected static string $category = 'Products';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/category-page.png';

    public static function name(): string
    {
        return _t('sections.category-page.name');
    }

    public static function description(): string
    {
        return _t('sections.category-page.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('heading', _t('sections.category-page.settings.heading_label')),

            Range::make('columns', _t('sections.category-page.settings.columns_label'))
                ->min(2)->max(6)->step(1)->default(4),

            Range::make('columns_tablet', _t('sections.category-page.settings.columns_tablet_label'))
                ->min(2)->max(4)->step(1)->default(3),

            Range::make('columns_mobile', _t('sections.category-page.settings.columns_mobile_label'))
                ->min(1)->max(2)->step(1)->default(2),

            Checkbox::make('show_filters', _t('sections.category-page.settings.filters_label'))
                ->default(true),

            Checkbox::make('show_sorting', _t('sections.category-page.settings.sorting_label'))
                ->default(true),

            Checkbox::make('show_category_banner', _t('sections.category-page.settings.banner_label'))
                ->default(true),
        ];
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
        if (empty($filterableAttributes = $this->context['category']->filterableAttributes)) {
            $filterableAttributes = app(AttributeRepository::class)->getFilterableAttributes();
        }

        return $filterableAttributes->filter(function ($filter) {
            return $filter->type === 'price' || $filter->options->isNotEmpty();
        });
    }

    public function mount()
    {
        $this->initializeMaxPrice(['category_id' => $this->context['category']->id]);
        $this->initializeFilters();
    }

    public function getViewData(): array
    {
        return [
            'products' => app(GetProducts::class)->execute(
                $this->buildProductParams(['category_id' => $this->context['category']->id])
            ),
        ];
    }
}
