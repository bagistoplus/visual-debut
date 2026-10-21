<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\SimpleSection;
use BagistoPlus\VisualDebut\Support\HasColorSchemeSetting;

use function BagistoPlus\VisualDebut\_t;

class CustomerRmaDetails extends SimpleSection
{
    use HasColorSchemeSetting;

    protected static string $type = '@visual-debut/customer-rma-details';

    protected static array $enabledOn = [
        'templates' => ['account/rma-details'],
        'regions' => ['main'],
    ];

    protected static string $view = 'shop::sections.customer-rma-details';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M9 11 7 9l2-2"/><path d="M7 9h6a3 3 0 0 1 0 6h-1"/></svg>';

    protected static string $category = 'Customer';

    public static function name(): string
    {
        return _t('sections.customer-rma-details.name');
    }

    public static function settings(): array
    {
        return [
            static::colorSchemeSetting(),
        ];
    }
}
