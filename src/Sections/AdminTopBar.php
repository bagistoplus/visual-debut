<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Settings\Link;

use function BagistoPlus\VisualDebut\_t;

class AdminTopBar extends BladeSection
{
    protected static string $type = '@visual-debut/admin-top-bar';

    protected static string $view = 'shop::sections.admin-topbar';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M2 12h20"/></svg>';

    protected static string $category = 'Layout';

    protected static array $disabledOn = [
        'templates' => ['*']
    ];

    public static function name(): string
    {
        return _t('sections.admin-topbar.name');
    }

    public static function description(): string
    {
        return _t('sections.admin-topbar.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('text', _t('sections.admin-topbar.settings.text_label'))
                ->default('Go to Admin Panel'),

            Link::make('url', _t('sections.admin-topbar.settings.url_label'))
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
