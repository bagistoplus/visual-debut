<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\SimpleSection;
use BagistoPlus\VisualDebut\Support\HasColorSchemeSetting;

use function BagistoPlus\VisualDebut\_t;

class WithdrawalReceipt extends SimpleSection
{
    use HasColorSchemeSetting;

    protected static string $type = '@visual-debut/withdrawal-receipt';

    protected static array $enabledOn = [
        'templates' => ['withdrawal/confirmation', 'account/withdrawal'],
        'regions' => ['main'],
    ];

    protected static string $view = 'shop::sections.withdrawal-receipt';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z"/><path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8"/><path d="M12 17.5v-11"/></svg>';

    protected static string $category = 'Customer';

    public static function name(): string
    {
        return _t('sections.withdrawal-receipt.name');
    }

    public static function settings(): array
    {
        return [
            static::colorSchemeSetting(),
        ];
    }
}
