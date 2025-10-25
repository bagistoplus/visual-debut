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
use BagistoPlus\VisualDebut\Blocks\Category as CategoryBlock;
use BagistoPlus\VisualDebut\Blocks\Basic\Heading;
use BagistoPlus\VisualDebut\Presets\CategoryGrid;

use function BagistoPlus\VisualDebut\_t;

class CategoryList extends BladeSection
{
    protected static string $type = '@visual-debut/category-list';

    protected static string $view = 'shop::sections.category-list';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>';

    protected static string $category = 'Category';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/category-list.png';

    protected static array $accepts = [
        Heading::class,
        CategoryBlock::class
    ];

    protected static array $enabledOn = [
        'regions' => ['main']
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
        return [
            'categoryItems' => $this->getCategories()
        ];
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
            ->filter(fn($child) => $child->type === '@visual-debut/category')
            ->map(fn($child) => $child->settings->category)
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
                ->responsive(),

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

            Select::make('nav_style', _t('sections.category-list.settings.nav_style_label'))
                ->options([
                    'arrow' => _t('sections.category-list.settings.nav_style_options.arrow'),
                    'chevron' => _t('sections.category-list.settings.nav_style_options.chevron'),
                    'none' => _t('sections.category-list.settings.nav_style_options.none'),
                ])
                ->default('arrow'),

            Select::make('nav_shape', _t('sections.category-list.settings.nav_shape_label'))
                ->options([
                    'none' => _t('sections.category-list.settings.nav_shape_options.none'),
                    'circle' => _t('sections.category-list.settings.nav_shape_options.circle'),
                    'square' => _t('sections.category-list.settings.nav_shape_options.square'),
                ])
                ->default('none'),

            Header::make(_t('sections.category-list.settings.appearance_header')),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            Header::make(_t('sections.category-list.settings.padding_header')),

            Range::make('padding_top', _t('sections.category-list.settings.padding_top_label'))
                ->min(0)->max(24)->step(1)
                ->default(['_default' => 12])
                ->responsive(),

            Range::make('padding_bottom', _t('sections.category-list.settings.padding_bottom_label'))
                ->min(0)->max(24)->step(1)
                ->default(['_default' => 12])
                ->responsive(),
        ];
    }

    public static function presets(): array
    {
        return [
            CategoryGrid::class,
        ];
    }
}
