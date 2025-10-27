<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Category;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualDebut\_t;

class CategoryList extends BladeSection
{
    protected static string $view = 'shop::sections.category-list';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/category-list.png';

    public function getCategories()
    {
        return collect($this->section->blocks)
            ->map(fn($block) => $block->settings->category)
            ->filter();
    }

    public static function name(): string
    {
        return _t('category-list.name');
    }

    public static function description(): string
    {
        return _t('category-list.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('heading', _t('category-list.settings.heading_label'))
                ->default(_t('category-list.settings.heading_default')),

            Select::make('heading_size', _t('category-list.settings.heading_size_label'))
                ->options([
                    'small' => _t('category-list.settings.size_small_label'),
                    'medium' => _t('category-list.settings.size_medium_label'),
                    'large' => _t('category-list.settings.size_large_label'),
                ])
                ->default('medium'),

            Range::make('columns_desktop', _t('category-list.settings.columns_desktop_label'))
                ->min(2)->max(6)->step(1)->default(4),

            Range::make('columns_mobile', _t('category-list.settings.columns_mobile_label'))
                ->min(1)->max(2)->step(1)->default(2),
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('category', _t('category-list.blocks.category.name'))
                ->limit(15)
                ->settings([
                    Category::make('category', _t('category-list.blocks.category.settings.category_label'))
                        ->default(null),
                ]),
        ];
    }
}
