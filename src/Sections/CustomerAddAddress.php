<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class CustomerAddAddress extends BladeSection
{
    protected static string $type = '@visual-debut/customer-add-address';

    protected static array $enabledOn = [
        'templates' => ['account/add-address'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.customer-add-address';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="10" x2="14" y1="10" y2="10"/></svg>';

    protected static string $category = 'Customer';
}
