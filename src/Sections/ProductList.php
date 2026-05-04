<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Tailwind;
use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings\Category;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Spacing;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay;
use Webkul\Product\Repositories\ProductFlatRepository;

use function BagistoPlus\VisualDebut\_t;

class ProductList extends BladeSection
{
    protected static string $type = '@visual-debut/product-list';

    protected static array $disabledOn = [
        'templates' => ['auth/*', 'account/*'],
    ];

    protected static array $enabledOn = [
        'regions' => ['main'],
    ];

    protected static string $view = 'shop::sections.product-list';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.08 8.58v0A2 2 0 0 0 19 7H5a2 2 0 0 0-2.08 1.58l-1.5 9A2 2 0 0 0 3.5 20H11"/><path d="M16 18h6"/><path d="M19 15v6"/></svg>';

    protected static string $category = 'Products';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/product-list.png';

    protected static array $accepts = [
        Heading::class,
    ];

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
        if ($parentCategory = $this->section->settings->parent_category) {
            return $this->getProductsByCategory($parentCategory);
        }

        return match ($this->section->settings->product_type ?? 'new') {
            'featured' => $this->getFeaturedProducts(),
            'new' => $this->getNewProducts(),
            default => collect(),
        };
    }

    public function getViewData(): array
    {
        $products = $this->getProducts();
        $navStyle = $this->section->settings->nav_style ?? 'none';

        return [
            'products' => $products,
            'widthClass' => $this->computeWidthClass(),
            'columnClasses' => $this->computeColumnClasses(),
            'gapClass' => $this->computeGapClass(),
            'isCarousel' => $this->section->settings->layout_type === 'carousel',
            'showArrowNavigation' => in_array($navStyle, ['arrow', 'both']),
            'showDotNavigation' => in_array($navStyle, ['dot', 'both']),
            'navShapeClass' => $this->computeNavShapeClass(),
            'useArrowIcon' => ($this->section->settings->nav_icon ?? 'chevron') === 'arrow',
            'paddingClasses' => $this->computePaddingClasses(),
            'carouselConfig' => $this->buildCarouselConfig(),
        ];
    }

    protected function computeWidthClass(): string
    {
        return $this->section->settings->content_width === 'container'
            ? 'container mx-auto px-4 sm:px-6 lg:px-8'
            : 'px-4 sm:px-6 lg:px-8';
    }

    protected function computeColumnClasses(): string
    {
        return Tailwind::responsive(
            $this->section->settings->columns,
            fn ($v) => "grid-cols-{$v}"
        );
    }

    protected function computeGapClass(): string
    {
        return 'gap-'.($this->section->settings->gap ?? 4);
    }

    protected function computeNavShapeClass(): string
    {
        return match ($this->section->settings->nav_shape) {
            'circle' => 'rounded-full',
            'square' => 'rounded-md',
            default => '',
        };
    }

    protected function computePaddingClasses(): string
    {
        $paddingClasses = '';
        if ($this->section->settings->has('padding')) {
            $paddingClasses = Tailwind::responsive(
                $this->section->settings->padding,
                fn ($v) => Tailwind::buildSpacingClasses($v, 'p')
            );
        }

        return $paddingClasses;
    }

    protected function buildCarouselConfig(): array
    {
        $config = [];

        if ($this->section->settings->layout_type !== 'carousel') {
            return $config;
        }

        $settings = $this->section->settings;
        $itemsPerView = Tailwind::toResponsiveValue($settings->columns ?? 4);
        $gap = $settings->gap ?? 4;
        $hasResponsive = $itemsPerView->has('mobile') || $itemsPerView->has('tablet');

        if ($hasResponsive) {
            $config['slidesPerView'] = (int) $itemsPerView->get('mobile', $itemsPerView->value());

            $breakpoints = [];

            if ($itemsPerView->has('tablet')) {
                $breakpoints['(min-width: 767px)'] = [
                    'slidesPerView' => (int) $itemsPerView->get('tablet'),
                ];
            }

            $breakpoints['(min-width: 1024px)'] = [
                'slidesPerView' => (int) $itemsPerView->value(),
            ];

            $config['breakpoints'] = $breakpoints;
        } else {
            $config['slidesPerView'] = (int) $itemsPerView->value();
        }

        $config['spaceBetween'] = $gap * 4;
        $config['loop'] = (bool) (($settings->loop ?? false) || ($settings->autoplay ?? false));

        if ($settings->autoplay ?? false) {
            $config['autoplay'] = [
                'delay' => (int) ($settings->autoplay_delay ?? 3000),
                'pauseOnHover' => true,
                'pauseOnFocus' => true,
            ];
        }

        return $config;
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
                    'new' => _t('sections.product-list.settings.new_label'),
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
                ->asSegment(),

            Range::make('columns', _t('sections.product-list.settings.columns_label'))
                ->min(1)->max(6)->step(1)
                ->default(['_default' => 4, 'mobile' => 2, 'tablet' => 3])
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

            Checkbox::make('loop', _t('sections.product-list.settings.loop_label'))
                ->default(false)
                ->asSwitch()
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Checkbox::make('autoplay', _t('sections.product-list.settings.autoplay_label'))
                ->default(false)
                ->asSwitch()
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Range::make('autoplay_delay', _t('sections.product-list.settings.autoplay_delay_label'))
                ->min(1000)->max(10000)->step(500)
                ->default(3000)
                ->info(_t('sections.product-list.settings.autoplay_delay_info'))
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')->whenTruthy('autoplay')),

            Select::make('nav_style', _t('sections.product-list.settings.nav_style_label'))
                ->options([
                    'arrow' => _t('sections.product-list.settings.nav_style_options.arrow'),
                    'dot' => _t('sections.product-list.settings.nav_style_options.dot'),
                    'both' => _t('sections.product-list.settings.nav_style_options.both'),
                    'none' => _t('sections.product-list.settings.nav_style_options.none'),
                ])
                ->default('arrow')
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Select::make('nav_shape', _t('sections.product-list.settings.nav_shape_label'))
                ->options([
                    'circle' => _t('sections.product-list.settings.nav_shape_options.circle'),
                    'square' => _t('sections.product-list.settings.nav_shape_options.square'),
                    'none' => _t('sections.product-list.settings.nav_shape_options.none'),
                ])
                ->default('circle')
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Select::make('nav_icon', _t('sections.product-list.settings.nav_icon_label'))
                ->options([
                    'arrow' => _t('sections.product-list.settings.nav_icon_options.arrow'),
                    'chevron' => _t('sections.product-list.settings.nav_icon_options.chevron'),
                ])
                ->default('chevron')
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Header::make(_t('blocks.common.spacing_header')),

            Spacing::make('padding', _t('blocks.common.padding_label'))
                ->responsive()
                ->min(0)
                ->max(24)
                ->default([
                    'top' => 8,
                    'right' => 0,
                    'bottom' => 8,
                    'left' => 0,
                ]),

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
                    PresetBlock::make(Heading::class)
                        ->settings([
                            'text' => 'Featured Products',
                            'heading_level' => 'h2',
                            'width' => 'fill',
                            'alignment' => 'center',
                            'padding' => [
                                'top' => 4,
                                'right' => 0,
                                'bottom' => 4,
                                'left' => 0,
                            ],
                            'typography' => 'heading-2',
                        ]),

                    ProductCardWithOverlay::asChild()
                        ->id('static-product-card')
                        ->static()
                        ->repeated(),
                ]),

            Preset::make('New Arrivals')
                ->category('Product')
                ->settings([
                    'product_type' => 'new',
                    'nb_products' => 8,
                ])
                ->blocks([
                    PresetBlock::make(Heading::class)
                        ->settings([
                            'text' => 'New Arrivals',
                            'heading_level' => 'h2',
                            'width' => 'fill',
                            'alignment' => 'center',
                        ]),

                    ProductCardWithOverlay::asChild()
                        ->id('static-product-card')
                        ->static()
                        ->repeated(),
                ]),
        ];
    }
}
