<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class LoginForm extends BladeSection
{
    protected static string $type = '@visual-debut/login-form';

    protected static array $enabledOn = [
        'templates' => ['auth/login'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.login-form';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg>';

    protected static string $category = 'Customer';
}
