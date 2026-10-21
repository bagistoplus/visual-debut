<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\SimpleSection;
use BagistoPlus\VisualDebut\Support\HasColorSchemeSetting;

use function BagistoPlus\VisualDebut\_t;

class CustomerCreateRma extends SimpleSection
{
    use HasColorSchemeSetting;

    protected static string $type = '@visual-debut/customer-create-rma';

    protected static array $enabledOn = [
        'templates' => ['account/create-rma'],
        'regions' => ['main'],
    ];

    protected static string $view = 'shop::sections.customer-create-rma';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 14 4 9l5-5"/><path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11"/><path d="M17 3v6"/><path d="M14 6h6"/></svg>';

    protected static string $category = 'Customer';

    public static function name(): string
    {
        return _t('sections.customer-create-rma.name');
    }

    public static function settings(): array
    {
        return [
            static::colorSchemeSetting(),
        ];
    }
}
