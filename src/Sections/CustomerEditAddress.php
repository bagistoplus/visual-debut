<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class CustomerEditAddress extends BladeSection
{
    protected static string $type = '@visual-debut/customer-edit-address';

    protected static array $enabledOn = [
        'templates' => ['account/edit-address'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.customer-edit-address';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><path d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/><path d="m9 14 1.5 1.5L14 12"/></svg>';

    protected static string $category = 'Customer';
}
