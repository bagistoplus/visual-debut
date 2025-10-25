<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class CustomerAddresses extends BladeSection
{
    protected static string $type = '@visual-debut/customer-addresses';

    protected static array $enabledOn = [
        'templates' => ['account/addresses'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.customer-addresses';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>';

    protected static string $category = 'Customer';
}
