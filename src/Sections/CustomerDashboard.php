<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\SimpleSection;
use BagistoPlus\VisualDebut\Support\HasColorSchemeSetting;

use function BagistoPlus\VisualDebut\_t;

class CustomerDashboard extends SimpleSection
{
    use HasColorSchemeSetting;

    protected static string $type = '@visual-debut/customer-dashboard';

    protected static array $enabledOn = [
        'templates' => ['account/index'],
        'regions' => ['main'],
    ];

    protected static string $view = 'shop::sections.customer-dashboard';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>';

    protected static string $category = 'Customer';

    public static function name(): string
    {
        return _t('sections.customer-dashboard.name');
    }

    public static function settings(): array
    {
        return [
            static::colorSchemeSetting(),
        ];
    }
}
