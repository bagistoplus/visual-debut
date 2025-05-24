<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\GetProducts;
use BagistoPlus\Visual\Sections\LivewireSection;
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
    use HandlesProductListing;
    use WithPagination;

    protected static array $enabledOn = ['category'];

    protected static string $view = 'shop::sections.category-page';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/category-page.png';

    public static function name(): string
    {
        return _t('category-page.name');
    }

    public static function description(): string
    {
        return _t('category-page.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('heading', _t('category-page.settings.heading_label')),

            Range::make('columns', _t('category-page.settings.columns_label'))
                ->min(2)->max(6)->step(1)->default(4),

            Range::make('columns_tablet', _t('category-page.settings.columns_tablet_label'))
                ->min(2)->max(4)->step(1)->default(3),

            Range::make('columns_mobile', _t('category-page.settings.columns_mobile_label'))
                ->min(1)->max(2)->step(1)->default(2),

            Checkbox::make('show_filters', _t('category-page.settings.filters_label'))
                ->default(true),

            Checkbox::make('show_sorting', _t('category-page.settings.sorting_label'))
                ->default(true),

            Checkbox::make('show_category_banner', _t('category-page.settings.banner_label'))
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
        $this->initializeSort();
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
