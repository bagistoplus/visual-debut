<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

use function BagistoPlus\VisualDebut\_t;

class CmsPage extends BladeSection
{
    protected static string $type = '@visual-debut/cms-page';

    protected static array $enabledOn = [
        'templates' => ['page'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.cms-page';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>';

    protected static string $category = 'Content';

    public static function name(): string
    {
        return _t('sections.cms-page.name');
    }

    public static function description(): string
    {
        return _t('sections.cms-page.description');
    }
}
