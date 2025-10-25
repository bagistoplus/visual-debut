<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Category as CategorySetting;

use function BagistoPlus\VisualDebut\_t;

class Category extends BladeBlock
{
    protected static string $type = '@visual-debut/category';

    protected static string $view = 'visual-debut::blocks.category';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7V5a2 2 0 0 1 2-2h2"/><path d="M17 3h2a2 2 0 0 1 2 2v2"/><path d="M21 17v2a2 2 0 0 1-2 2h-2"/><path d="M7 21H5a2 2 0 0 1-2-2v-2"/><rect width="7" height="5" x="7" y="7" rx="1"/><rect width="7" height="5" x="10" y="12" rx="1"/></svg>';

    protected static string $category = 'Category';

    protected static bool $private = true;

    public static function settings(): array
    {
        return [
            CategorySetting::make('category', _t('blocks.category.settings.category_label'))
                ->default(null),
        ];
    }
}
