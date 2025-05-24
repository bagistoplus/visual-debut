<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Settings\Link;

use function BagistoPlus\VisualDebut\_t;

class AdminTopBar extends BladeSection
{
    protected static string $view = 'shop::sections.admin-topbar';

    public static function name(): string
    {
        return _t('admin-topbar.name');
    }

    public static function description(): string
    {
        return _t('admin-topbar.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('text', _t('admin-topbar.settings.text_label'))
                ->default('Go to Admin Panel'),

            Link::make('url', _t('admin-topbar.settings.url_label'))
                ->default('/admin/visual/themes'),
        ];
    }

    protected static array $default = [
        'settings' => [
            'text' => 'Go to Admin Panel',
            'url'  => '/admin',
        ],
    ];
}
