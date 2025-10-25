<?php

namespace BagistoPlus\VisualDebut\Blocks\Category;

use BagistoPlus\Visual\Settings\Category as CategorySetting;
use BagistoPlus\VisualDebut\Blocks\Basic\Text;

use function BagistoPlus\VisualDebut\_t;

class CategoryName extends Text
{
    protected static string $type = '@visual-debut/category-name';

    protected static string $view = 'visual-debut::blocks.category.name';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>';

    protected static string $category = 'Category';

    public static function settings(): array
    {
        return array_merge(
            [
                CategorySetting::make('category', _t('blocks.category-name.settings.category_label')),
            ],
            Text::stylingSettings()
        );
    }

    public function share(): array
    {
        return [
            'category' => $this->block->settings->category ?? $this->context['category'] ?? null
        ];
    }
}
