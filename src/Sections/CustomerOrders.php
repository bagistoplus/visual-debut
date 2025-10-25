<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class CustomerOrders extends BladeSection
{
    protected static string $type = '@visual-debut/customer-orders';

    protected static array $enabledOn = [
        'templates' => ['account/orders'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.customer-orders';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>';

    protected static string $category = 'Customer';
}
