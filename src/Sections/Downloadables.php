<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class Downloadables extends BladeSection
{
    protected static string $type = '@visual-debut/downloadables';

    protected static array $enabledOn = [
        'templates' => ['account/downloadables'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.downloadables';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>';

    protected static string $category = 'Customer';
}
