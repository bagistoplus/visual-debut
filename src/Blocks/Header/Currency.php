<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\Visual\Blocks\SimpleBlock;

use function BagistoPlus\VisualDebut\_t;

class Currency extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.header.currency';

    protected static string $type = '@visual-debut/header-currency';

    protected static int $limit = 1;

    protected static bool $private = true;

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 18V6"/></svg>';

    protected static string $category = 'Header';

    public static function name(): string
    {
        return _t('blocks.header-currency.name');
    }

    public static function description(): string
    {
        return _t('blocks.header-currency.description');
    }

    public static function settings(): array
    {
        return [];
    }

}
