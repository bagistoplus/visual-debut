<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class CustomerReviews extends BladeSection
{
    protected static string $type = '@visual-debut/customer-reviews';

    protected static array $enabledOn = [
        'templates' => ['account/reviews'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.customer-reviews';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>';

    protected static string $category = 'Customer';
}
