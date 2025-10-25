<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Icon;

use function BagistoPlus\VisualDebut\_t;

class Compare extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.header.compare';

    protected static string $type = '@visual-debut/header-compare';

    protected static int $limit = 1;

    protected static bool $private = true;

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3 4 7l4 4"/><path d="M4 7h16"/><path d="m16 21 4-4-4-4"/><path d="M20 17H4"/></svg>';

    protected static string $category = 'Header';

    public static function name(): string
    {
        return _t('blocks.header-compare.name');
    }

    public static function description(): string
    {
        return _t('blocks.header-compare.description');
    }

    public static function settings(): array
    {
        return [
            Icon::make('icon', _t('blocks.header-compare.settings.icon_label'))
                ->default('lucide-arrow-left-right'),
        ];
    }

}
