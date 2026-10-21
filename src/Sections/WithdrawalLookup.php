<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\SimpleSection;
use BagistoPlus\VisualDebut\Support\HasColorSchemeSetting;

use function BagistoPlus\VisualDebut\_t;

class WithdrawalLookup extends SimpleSection
{
    use HasColorSchemeSetting;

    protected static string $type = '@visual-debut/withdrawal-lookup';

    protected static array $enabledOn = [
        'templates' => ['withdrawal/lookup'],
        'regions' => ['main'],
    ];

    protected static string $view = 'shop::sections.withdrawal-lookup';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>';

    protected static string $category = 'Customer';

    public static function name(): string
    {
        return _t('sections.withdrawal-lookup.name');
    }

    public static function settings(): array
    {
        return [
            static::colorSchemeSetting(),
        ];
    }
}
