<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Divider;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Icon;
use BagistoPlus\BasicBlocks\Blocks\Basic\Link;
use BagistoPlus\BasicBlocks\Blocks\Basic\RichText;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\BasicBlocks\Blocks\Media\Image;
use BagistoPlus\BasicBlocks\Tailwind;
use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings\Category;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Spacing;

use function BagistoPlus\VisualDebut\_t;

class CategoryList extends BladeSection
{
    protected static string $type = '@visual-debut/category-list';

    protected static string $view = 'shop::sections.category-list';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>';

    protected static string $category = 'Category';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/category-list.png';

    protected static array $accepts = [
        Button::class,
        Divider::class,
        Group::class,
        Heading::class,
        Icon::class,
        Image::class,
        Link::class,
        RichText::class,
        Text::class,
    ];

    protected static array $enabledOn = [
        'regions' => ['main'],
    ];

    public static function name(): string
    {
        return _t('sections.category-list.name');
    }

    public static function description(): string
    {
        return _t('sections.category-list.description');
    }

    protected function getViewData(): array
    {
        $navStyle = $this->section->settings->nav_style ?? 'none';

        return [
            'categoryItems' => $this->getCategories(),
            'widthClass' => $this->computeWidthClass(),
            'columnClasses' => $this->computeColumnClasses(),
            'gapClass' => $this->computeGapClass(),
            'isCarousel' => $this->section->settings->layout_type === 'carousel',
            'showArrowNavigation' => in_array($navStyle, ['arrow', 'chevron', 'both']),
            'showDotNavigation' => in_array($navStyle, ['dot', 'both']),
            'navShapeClass' => $this->computeNavShapeClass(),
            'useArrowIcon' => ($this->section->settings->nav_icon ?? $navStyle) === 'arrow',
            'paddingClasses' => $this->computePaddingClasses(),
            'carouselConfig' => $this->buildCarouselConfig(),
        ];
    }

    protected function computeWidthClass(): string
    {
        return $this->section->settings->content_width === 'container'
            ? 'container mx-auto'
            : '';
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

    protected function getCategories()
    {
        // If parent category is selected, return its children
        if ($parentCategory = $this->section->settings->parent_category) {
            return $parentCategory->children()
                ->where('status', 1)
                ->orderBy('position')
                ->get();
        }

        // Otherwise, return manually added category blocks
        return collect($this->section->children())
            ->filter(fn ($child) => $child->type === '@visual-debut/category')
            ->map(fn ($child) => $child->settings->category)
            ->filter(); // Remove null values
    }

    public static function settings(): array
    {
        return [
            Category::make('parent_category', _t('sections.category-list.settings.parent_category_label'))
                ->info(_t('sections.category-list.settings.parent_category_info')),

            Header::make(_t('sections.category-list.settings.layout_header')),

            Select::make('layout_type', _t('sections.category-list.settings.layout_type_label'))
                ->options([
                    'grid' => _t('sections.category-list.settings.layout_type_options.grid'),
                    'carousel' => _t('sections.category-list.settings.layout_type_options.carousel'),
                ])
                ->default('grid')
                ->asSegment(),

            Range::make('columns', _t('sections.category-list.settings.columns_label'))
                ->min(1)->max(6)->step(1)
                ->default(['_default' => 4, 'mobile' => 2])
                ->responsive(),

            Range::make('gap', _t('sections.category-list.settings.gap_label'))
                ->min(0)->max(24)->step(1)
                ->default(4)
                ->info(_t('sections.category-list.settings.gap_info')),

            Select::make('content_width', _t('sections.category-list.settings.content_width_label'))
                ->options([
                    'container' => _t('sections.category-list.settings.content_width_options.container'),
                    'full' => _t('sections.category-list.settings.content_width_options.full'),
                ])
                ->default('container')
                ->asSegment(),

            Header::make(_t('sections.category-list.settings.carousel_nav_header')),

            Checkbox::make('loop', _t('sections.category-list.settings.loop_label'))
                ->default(false)
                ->asSwitch()
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Checkbox::make('autoplay', _t('sections.category-list.settings.autoplay_label'))
                ->default(false)
                ->asSwitch()
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Range::make('autoplay_delay', _t('sections.category-list.settings.autoplay_delay_label'))
                ->min(1000)->max(10000)->step(500)
                ->default(3000)
                ->info(_t('sections.category-list.settings.autoplay_delay_info'))
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')->whenTruthy('autoplay')),

            Select::make('nav_style', _t('sections.category-list.settings.nav_style_label'))
                ->options([
                    'arrow' => _t('sections.category-list.settings.nav_style_options.arrow'),
                    'dot' => _t('sections.category-list.settings.nav_style_options.dot'),
                    'both' => _t('sections.category-list.settings.nav_style_options.both'),
                    'none' => _t('sections.category-list.settings.nav_style_options.none'),
                ])
                ->default('arrow')
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Select::make('nav_shape', _t('sections.category-list.settings.nav_shape_label'))
                ->options([
                    'none' => _t('sections.category-list.settings.nav_shape_options.none'),
                    'circle' => _t('sections.category-list.settings.nav_shape_options.circle'),
                    'square' => _t('sections.category-list.settings.nav_shape_options.square'),
                ])
                ->default('none')
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Select::make('nav_icon', _t('sections.category-list.settings.nav_icon_label'))
                ->options([
                    'arrow' => _t('sections.category-list.settings.nav_icon_options.arrow'),
                    'chevron' => _t('sections.category-list.settings.nav_icon_options.chevron'),
                ])
                ->default('chevron')
                ->visibleWhen(fn ($rule) => $rule->when('layout_type', 'carousel')),

            Header::make(_t('sections.category-list.settings.appearance_header')),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            Header::make(_t('blocks.common.padding_header')),

            Spacing::make('padding', _t('blocks.common.padding_label'))
                ->responsive()
                ->min(0)
                ->max(24)
                ->default([
                    'top' => 12,
                    'right' => 0,
                    'bottom' => 12,
                    'left' => 0,
                ]),
        ];
    }
}
