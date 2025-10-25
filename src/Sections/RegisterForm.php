<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class RegisterForm extends BladeSection
{
    protected static string $type = '@visual-debut/register-form';

    protected static array $enabledOn = [
        'templates' => ['auth/register'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.register-form';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>';

    protected static string $category = 'Customer';
}
