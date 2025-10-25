<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Icon;

use function BagistoPlus\VisualDebut\_t;

class Locale extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.header.locale';

    protected static string $type = '@visual-debut/header-locale';

    protected static int $limit = 1;

    protected static bool $private = true;

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>';

    protected static string $category = 'Header';

    public static function name(): string
    {
        return _t('blocks.header-locale.name');
    }

    public static function description(): string
    {
        return _t('blocks.header-locale.description');
    }

    public static function settings(): array
    {
        return [
            Icon::make('icon', _t('blocks.header-locale.settings.icon_label'))
                ->default('lucide-globe'),
        ];
    }

}
