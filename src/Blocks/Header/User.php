<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\RichText;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualDebut\_t;

class User extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.header.user';

    protected static string $type = '@visual-debut/header-user';

    protected static int $limit = 1;

    protected static bool $private = true;

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>';

    protected static string $category = 'Header';

    public static function name(): string
    {
        return _t('blocks.header-user.name');
    }

    public static function description(): string
    {
        return _t('blocks.header-user.description');
    }

    public static function settings(): array
    {
        return [
            Icon::make('icon', _t('blocks.header-user.settings.icon_label'))
                ->default('lucide-user'),

            Text::make('guest_heading', _t('blocks.header-user.settings.guest_heading_label'))
                ->default(_t('blocks.header-user.settings.guest_heading_default')),

            RichText::make('guest_description', _t('blocks.header-user.settings.guest_description_label'))
                ->default(_t('blocks.header-user.settings.guest_description_default')),
        ];
    }

}
