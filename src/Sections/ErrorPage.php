<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

use function BagistoPlus\VisualDebut\_t;

class ErrorPage extends BladeSection
{
    protected static string $type = '@visual-debut/error-page';

    protected static array $enabledOn = [
        'templates' => ['error'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.error-page';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>';

    protected static string $category = 'Content';

    public static function name(): string
    {
        return _t('sections.error-page.name');
    }

    public static function description(): string
    {
        return _t('sections.error-page.description');
    }
}
