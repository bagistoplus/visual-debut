<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;

class ProfileForm extends BladeSection
{
    protected static string $type = '@visual-debut/profile-form';

    protected static array $enabledOn = [
        'templates' => ['account/edit-profile'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.profile-form';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>';

    protected static string $category = 'Customer';
}
