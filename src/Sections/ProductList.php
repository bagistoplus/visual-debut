<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings\Category;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Blocks\Basic\Heading;
use BagistoPlus\VisualDebut\Blocks\Product as ProductBlock;
use BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay;
use Webkul\Product\Repositories\ProductFlatRepository;

use function BagistoPlus\VisualDebut\_t;

class ProductList extends BladeSection
{
    protected static string $type = '@visual-debut/product-list';

    protected static array $disabledOn = [
        'templates' => ['auth/*', 'account/*']
    ];

    protected static array $enabledOn = [
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.product-list';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.08 8.58v0A2 2 0 0 0 19 7H5a2 2 0 0 0-2.08 1.58l-1.5 9A2 2 0 0 0 3.5 20H11"/><path d="M16 18h6"/><path d="M19 15v6"/></svg>';

    protected static string $category = 'Products';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/product-list.png';

    protected static array $accepts = [
        Heading::class,
        ProductBlock::class
    ];

    protected function hasManualProducts(): bool
    {
        return !empty($this->section->children()) &&
            collect($this->section->children())
            ->some(fn($block) => $block->type === '@visual-debut/product');
    }

    protected function getManualProducts()
    {
        return collect($this->section->children())
            ->filter(fn($block) => $block->type === '@visual-debut/product')
            ->map(fn($block) => $block->settings->product)
            ->filter();
    }

    protected function getProductsByCategory($category)
    {
        return app(ProductFlatRepository::class)
            ->with(['product'])
            ->scopeQuery(function ($query) use ($category) {
                $channel = core()->getRequestedChannelCode();
                $locale = core()->getRequestedLocaleCode();

                return $query->distinct()
                    ->addSelect('product_flat.*')
                    ->leftJoin('product_categories', 'product_flat.product_id', '=', 'product_categories.product_id')
                    ->where('product_flat.status', 1)
                    ->where('product_flat.visible_individually', 1)
                    ->where('product_categories.category_id', $category->id)
                    ->where('product_flat.channel', $channel)
                    ->where('product_flat.locale', $locale);
            })
            ->take($this->section->settings->nb_products)
            ->get()
            ->map->product;
    }

    protected function getFeaturedProducts()
    {
        return app(ProductFlatRepository::class)
            ->with(['product'])
            ->scopeQuery(function ($query) {
                $channel = core()->getRequestedChannelCode();
                $locale = core()->getRequestedLocaleCode();

                return $query->distinct()
                    ->addSelect('product_flat.*')
                    ->where('product_flat.status', 1)
                    ->where('product_flat.visible_individually', 1)
                    ->where('product_flat.featured', 1)
                    ->where('product_flat.channel', $channel)
                    ->where('product_flat.locale', $locale);
            })
            ->take($this->section->settings->nb_products)
            ->get()
            ->map->product;
    }

    protected function getNewProducts()
    {
        return app(ProductFlatRepository::class)
            ->with(['product'])
            ->scopeQuery(function ($query) {
                $channel = core()->getRequestedChannelCode();
                $locale = core()->getRequestedLocaleCode();

                return $query->distinct()
                    ->addSelect('product_flat.*')
                    ->where('product_flat.status', 1)
                    ->where('product_flat.visible_individually', 1)
                    ->where('product_flat.new', 1)
                    ->where('product_flat.channel', $channel)
                    ->where('product_flat.locale', $locale);
            })
            ->take($this->section->settings->nb_products)
            ->get()
            ->map->product;
    }

    public function getProducts()
    {
        // Priority 1: Manually added products from child blocks
        if ($this->hasManualProducts()) {
            return $this->getManualProducts();
        }

        // Priority 2: Products from parent category
        if ($parentCategory = $this->section->settings->parent_category) {
            return $this->getProductsByCategory($parentCategory);
        }

        // Priority 3: Filter by product type (featured/new)
        return match ($this->section->settings->product_type ?? 'new') {
            'featured' => $this->getFeaturedProducts(),
            'new' => $this->getNewProducts(),
            default => collect(),
        };
    }

    public function getViewData(): array
    {
        return [
            'products' => $this->getProducts(),
        ];
    }

    public static function name(): string
    {
        return _t('sections.product-list.name');
    }

    public static function description(): string
    {
        return _t('sections.product-list.description');
    }

    public static function settings(): array
    {
        return [
            Category::make('parent_category', _t('sections.product-list.settings.parent_category_label'))
                ->info(_t('sections.product-list.settings.parent_category_info')),

            Select::make('product_type', _t('sections.product-list.settings.product_type_label'))
                ->options([
                    'new'      => _t('sections.product-list.settings.new_label'),
                    'featured' => _t('sections.product-list.settings.featured_label'),
                ])
                ->default('new')
                ->info(_t('sections.product-list.settings.product_type_info')),

            Range::make('nb_products', _t('sections.product-list.settings.nb_products_label'))
                ->default(8)->min(1)->max(24)->step(1)
                ->info(_t('sections.product-list.settings.nb_products_info')),

            Header::make(_t('sections.product-list.settings.layout_header')),

            Select::make('layout_type', _t('sections.product-list.settings.layout_type_label'))
                ->options([
                    'grid' => _t('sections.product-list.settings.layout_type_options.grid'),
                    'carousel' => _t('sections.product-list.settings.layout_type_options.carousel'),
                ])
                ->default('grid')
                ->responsive(),

            Range::make('columns', _t('sections.product-list.settings.columns_label'))
                ->min(1)->max(6)->step(1)
                ->default(['_default' => 4, 'mobile' => 2])
                ->responsive(),

            Range::make('gap', _t('sections.product-list.settings.gap_label'))
                ->min(0)->max(24)->step(1)
                ->default(4)
                ->info(_t('sections.product-list.settings.gap_info')),

            Select::make('content_width', _t('sections.product-list.settings.content_width_label'))
                ->options([
                    'full' => _t('sections.product-list.settings.content_width_options.full'),
                    'container' => _t('sections.product-list.settings.content_width_options.container'),
                ])
                ->default('container'),

            Header::make(_t('sections.product-list.settings.carousel_nav_header')),

            Select::make('nav_style', _t('sections.product-list.settings.nav_style_label'))
                ->options([
                    'arrow' => _t('sections.product-list.settings.nav_style_options.arrow'),
                    'dot' => _t('sections.product-list.settings.nav_style_options.dot'),
                    'both' => _t('sections.product-list.settings.nav_style_options.both'),
                    'none' => _t('sections.product-list.settings.nav_style_options.none'),
                ])
                ->default('arrow')
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'carousel')),

            Select::make('nav_shape', _t('sections.product-list.settings.nav_shape_label'))
                ->options([
                    'circle' => _t('sections.product-list.settings.nav_shape_options.circle'),
                    'square' => _t('sections.product-list.settings.nav_shape_options.square'),
                    'none' => _t('sections.product-list.settings.nav_shape_options.none'),
                ])
                ->default('circle')
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'carousel')),

            Header::make(_t('sections.product-list.settings.spacing_header')),

            Range::make('padding_top', _t('sections.product-list.settings.padding_top_label'))
                ->min(0)->max(24)->step(1)
                ->default(['_default' => 8])
                ->responsive(),

            Range::make('padding_bottom', _t('sections.product-list.settings.padding_bottom_label'))
                ->min(0)->max(24)->step(1)
                ->default(['_default' => 8])
                ->responsive(),

            Header::make(_t('sections.product-list.settings.appearance_header')),

            ColorScheme::make('color_scheme', _t('sections.product-list.settings.color_scheme_label'))
                ->default(null),
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make('Featured Products')
                ->category('Product')
                ->settings([
                    'product_type' => 'featured',
                    'nb_products' => 8,
                ])
                ->blocks([
                    PresetBlock::make('@visual-debut/heading')
                        ->settings([
                            'text' => 'Featured Products',
                            'tag' => 'h2',
                            'width' => '100%',
                            'alignment' => 'center',
                        ]),

                    ProductCardWithOverlay::asChild()
                        ->id('static-product-card')
                        ->static()
                        ->repeated()
                ]),

            Preset::make('New Arrivals')
                ->category('Product')
                ->settings([
                    'product_type' => 'new',
                    'nb_products' => 8,
                ])
                ->blocks([
                    PresetBlock::make('@visual-debut/heading')
                        ->settings([
                            'text' => 'New Arrivals',
                            'tag' => 'h2',
                            'width' => '100%',
                            'alignment' => 'center',
                        ]),

                    ProductCardWithOverlay::asChild()
                        ->id('static-product-card')
                        ->static()
                        ->repeated()
                ])
        ];
    }
}
