<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Icon;

use function BagistoPlus\VisualDebut\_t;

class Search extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.header.search';

    protected static string $type = '@visual-debut/header-search';

    protected static int $limit = 1;

    protected static bool $private = true;

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>';

    protected static string $category = 'Header';

    public static function name(): string
    {
        return _t('blocks.header-search.name');
    }

    public static function description(): string
    {
        return _t('blocks.header-search.description');
    }

    public static function settings(): array
    {
        return [
            Icon::make('search_icon', _t('blocks.header-search.settings.search_icon_label'))
                ->default('lucide-search'),

            Icon::make('image_search_icon', _t('blocks.header-search.settings.image_search_icon_label'))
                ->default('lucide-camera'),
        ];
    }

}
