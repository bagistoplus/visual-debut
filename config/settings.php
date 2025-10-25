<?php

use BagistoPlus\Visual\Settings;
use BagistoPlus\VisualDebut\Settings\Radius;

return [
    [
        'name' => 'visual-debut::shop.settings.logo-favicon',
        'settings' => [
            Settings\Image::make('logo_desktop', 'Logo (Desktop)'),
            Settings\Image::make('logo_mobile', 'Logo (Mobile)'),
            Settings\Image::make('favicon', 'Favicon')
                ->info('Recommended size: 32x32 or 16x16 pixels'),
        ]
    ],

    [
        'name' => 'visual-debut::shop.settings.colors',
        'settings' => [
            Settings\ColorScheme::make('default_scheme', 'Default Scheme')
                ->default('default'),

            Settings\ColorSchemeGroup::make('color_schemes', 'Color Schemes')
                ->schemes(collect(glob(__DIR__ . '/schemes/*.php'))
                    ->mapWithKeys(fn($path) => [basename($path, '.php') => require $path])
                    ->all())
        ]
    ],

    [
        'name' => 'visual-debut::shop.settings.typography',
        'settings' => [
            Settings\Font::make('default_font', 'Default font')->default('roboto')
                ->info('visual-debut::shop.settings.typography_info'),
            Settings\Font::make('heading_font', 'Heading font')->default('roboto'),
            Settings\Font::make('subheading_font', 'Subheading font')->default('roboto'),

            // Paragraph Preset
            Settings\Header::make('Paragraph'),
            Settings\Select::make('paragraph_font', 'Font')
                ->options([
                    'default' => 'Default',
                    'heading' => 'Heading',
                    'subheading' => 'Subheading',
                ])
                ->default('default'),
            Settings\Select::make('paragraph_size', 'Size')
                ->options([
                    'xs' => 'Extra Small',
                    'sm' => 'Small',
                    'base' => 'Base',
                    'lg' => 'Large',
                    'xl' => 'Extra Large',
                    '2xl' => '2XL',
                    '3xl' => '3XL',
                ])
                ->responsive()
                ->default('base'),

            Settings\Select::make('paragraph_line_height', 'Line Height')
                ->options([
                    'none' => 'None (1)',
                    'tight' => 'Tight (1.25)',
                    'snug' => 'Snug (1.375)',
                    'normal' => 'Normal (1.5)',
                    'relaxed' => 'Relaxed (1.625)',
                    'loose' => 'Loose (2)',
                ])
                ->responsive()
                ->default('normal'),
            Settings\Select::make('paragraph_letter_spacing', 'Letter Spacing')
                ->options([
                    'tighter' => 'Tighter',
                    'tight' => 'Tight',
                    'normal' => 'Normal',
                    'wide' => 'Wide',
                    'wider' => 'Wider',
                    'widest' => 'Widest',
                ])
                ->default('normal'),
            Settings\Select::make('paragraph_case', 'Text Case')
                ->options([
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ])
                ->default('normal'),

            // Heading 1 Preset
            Settings\Header::make('Heading 1'),
            Settings\Select::make('h1_font', 'Font')
                ->options([
                    'default' => 'Default',
                    'heading' => 'Heading',
                    'subheading' => 'Subheading',
                ])
                ->default('heading'),

            Settings\Select::make('h1_size', 'Size')
                ->options([
                    'xl' => 'Extra Large',
                    '2xl' => '2XL',
                    '3xl' => '3XL',
                    '4xl' => '4XL',
                    '5xl' => '5XL',
                    '6xl' => '6XL',
                    '7xl' => '7XL',
                    '8xl' => '8XL',
                    '9xl' => '9XL',
                ])
                ->responsive()
                ->default([
                    '_default' => '5xl',
                    'mobile' => '4xl'
                ]),

            Settings\Select::make('h1_line_height', 'Line Height')
                ->options([
                    'none' => 'None (1)',
                    'tight' => 'Tight (1.25)',
                    'snug' => 'Snug (1.375)',
                    'normal' => 'Normal (1.5)',
                    'relaxed' => 'Relaxed (1.625)',
                    'loose' => 'Loose (2)',
                ])
                ->responsive()
                ->default('tight'),

            Settings\Select::make('h1_letter_spacing', 'Letter Spacing')
                ->options([
                    'tighter' => 'Tighter',
                    'tight' => 'Tight',
                    'normal' => 'Normal',
                    'wide' => 'Wide',
                    'wider' => 'Wider',
                    'widest' => 'Widest',
                ])
                ->default('tight'),
            Settings\Select::make('h1_case', 'Text Case')
                ->options([
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ])
                ->default('normal'),

            // Heading 2 Preset
            Settings\Header::make('Heading 2'),
            Settings\Select::make('h2_font', 'Font')
                ->options([
                    'default' => 'Default',
                    'heading' => 'Heading',
                    'subheading' => 'Subheading',
                ])
                ->default('heading'),
            Settings\Select::make('h2_size', 'Size')
                ->options([
                    'xl' => 'Extra Large',
                    '2xl' => '2XL',
                    '3xl' => '3XL',
                    '4xl' => '4XL',
                    '5xl' => '5XL',
                    '6xl' => '6XL',
                    '7xl' => '7XL',
                ])
                ->responsive()
                ->default([
                    '_default' => '4xl',
                    'mobile' => '3xl'
                ]),

            Settings\Select::make('h2_line_height', 'Line Height')
                ->options([
                    'none' => 'None (1)',
                    'tight' => 'Tight (1.25)',
                    'snug' => 'Snug (1.375)',
                    'normal' => 'Normal (1.5)',
                    'relaxed' => 'Relaxed (1.625)',
                    'loose' => 'Loose (2)',
                ])
                ->default('tight')
                ->responsive(),
            Settings\Select::make('h2_letter_spacing', 'Letter Spacing')
                ->options([
                    'tighter' => 'Tighter',
                    'tight' => 'Tight',
                    'normal' => 'Normal',
                    'wide' => 'Wide',
                    'wider' => 'Wider',
                    'widest' => 'Widest',
                ])
                ->default('normal'),
            Settings\Select::make('h2_case', 'Text Case')
                ->options([
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ])
                ->default('normal'),

            // Heading 3 Preset
            Settings\Header::make('Heading 3'),
            Settings\Select::make('h3_font', 'Font')
                ->options([
                    'default' => 'Default',
                    'heading' => 'Heading',
                    'subheading' => 'Subheading',
                ])
                ->default('heading'),
            Settings\Select::make('h3_size', 'Size')
                ->options([
                    'lg' => 'Large',
                    'xl' => 'Extra Large',
                    '2xl' => '2XL',
                    '3xl' => '3XL',
                    '4xl' => '4XL',
                    '5xl' => '5XL',
                ])
                ->responsive()
                ->default([
                    '_default' => '3xl',
                    'mobile' => '2xl'
                ]),
            Settings\Select::make('h3_line_height', 'Line Height')
                ->options([
                    'none' => 'None (1)',
                    'tight' => 'Tight (1.25)',
                    'snug' => 'Snug (1.375)',
                    'normal' => 'Normal (1.5)',
                    'relaxed' => 'Relaxed (1.625)',
                    'loose' => 'Loose (2)',
                ])
                ->default('snug')
                ->responsive(),
            Settings\Select::make('h3_letter_spacing', 'Letter Spacing')
                ->options([
                    'tighter' => 'Tighter',
                    'tight' => 'Tight',
                    'normal' => 'Normal',
                    'wide' => 'Wide',
                    'wider' => 'Wider',
                    'widest' => 'Widest',
                ])
                ->default('normal'),
            Settings\Select::make('h3_case', 'Text Case')
                ->options([
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ])
                ->default('normal'),

            // Heading 4 Preset
            Settings\Header::make('Heading 4'),
            Settings\Select::make('h4_font', 'Font')
                ->options([
                    'default' => 'Default',
                    'heading' => 'Heading',
                    'subheading' => 'Subheading',
                ])
                ->default('heading'),
            Settings\Select::make('h4_size', 'Size')
                ->options([
                    'base' => 'Base',
                    'lg' => 'Large',
                    'xl' => 'Extra Large',
                    '2xl' => '2XL',
                    '3xl' => '3XL',
                    '4xl' => '4XL',
                ])
                ->responsive()
                ->default([
                    '_default' => '2xl',
                    'mobile' => 'xl'
                ]),
            Settings\Select::make('h4_line_height', 'Line Height')
                ->options([
                    'none' => 'None (1)',
                    'tight' => 'Tight (1.25)',
                    'snug' => 'Snug (1.375)',
                    'normal' => 'Normal (1.5)',
                    'relaxed' => 'Relaxed (1.625)',
                    'loose' => 'Loose (2)',
                ])
                ->default('snug')
                ->responsive(),
            Settings\Select::make('h4_letter_spacing', 'Letter Spacing')
                ->options([
                    'tighter' => 'Tighter',
                    'tight' => 'Tight',
                    'normal' => 'Normal',
                    'wide' => 'Wide',
                    'wider' => 'Wider',
                    'widest' => 'Widest',
                ])
                ->default('normal'),
            Settings\Select::make('h4_case', 'Text Case')
                ->options([
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ])
                ->default('normal'),

            // Heading 5 Preset
            Settings\Header::make('Heading 5'),
            Settings\Select::make('h5_font', 'Font')
                ->options([
                    'default' => 'Default',
                    'heading' => 'Heading',
                    'subheading' => 'Subheading',
                ])
                ->default('heading'),
            Settings\Select::make('h5_size', 'Size')
                ->options([
                    'sm' => 'Small',
                    'base' => 'Base',
                    'lg' => 'Large',
                    'xl' => 'Extra Large',
                    '2xl' => '2XL',
                    '3xl' => '3XL',
                ])
                ->responsive()
                ->default([
                    '_default' => 'xl',
                    'mobile' => 'lg'
                ]),
            Settings\Select::make('h5_line_height', 'Line Height')
                ->options([
                    'none' => 'None (1)',
                    'tight' => 'Tight (1.25)',
                    'snug' => 'Snug (1.375)',
                    'normal' => 'Normal (1.5)',
                    'relaxed' => 'Relaxed (1.625)',
                    'loose' => 'Loose (2)',
                ])
                ->default('normal')
                ->responsive(),
            Settings\Select::make('h5_letter_spacing', 'Letter Spacing')
                ->options([
                    'tighter' => 'Tighter',
                    'tight' => 'Tight',
                    'normal' => 'Normal',
                    'wide' => 'Wide',
                    'wider' => 'Wider',
                    'widest' => 'Widest',
                ])
                ->default('normal'),
            Settings\Select::make('h5_case', 'Text Case')
                ->options([
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ])
                ->default('normal'),

            // Heading 6 Preset
            Settings\Header::make('Heading 6'),
            Settings\Select::make('h6_font', 'Font')
                ->options([
                    'default' => 'Default',
                    'heading' => 'Heading',
                    'subheading' => 'Subheading',
                ])
                ->default('heading'),
            Settings\Select::make('h6_size', 'Size')
                ->options([
                    'xs' => 'Extra Small',
                    'sm' => 'Small',
                    'base' => 'Base',
                    'lg' => 'Large',
                    'xl' => 'Extra Large',
                    '2xl' => '2XL',
                ])
                ->default('base')
                ->responsive(),
            Settings\Select::make('h6_line_height', 'Line Height')
                ->options([
                    'none' => 'None (1)',
                    'tight' => 'Tight (1.25)',
                    'snug' => 'Snug (1.375)',
                    'normal' => 'Normal (1.5)',
                    'relaxed' => 'Relaxed (1.625)',
                    'loose' => 'Loose (2)',
                ])
                ->default('normal')
                ->responsive(),
            Settings\Select::make('h6_letter_spacing', 'Letter Spacing')
                ->options([
                    'tighter' => 'Tighter',
                    'tight' => 'Tight',
                    'normal' => 'Normal',
                    'wide' => 'Wide',
                    'wider' => 'Wider',
                    'widest' => 'Widest',
                ])
                ->default('normal'),
            Settings\Select::make('h6_case', 'Text Case')
                ->options([
                    'normal' => 'Normal',
                    'uppercase' => 'Uppercase',
                    'lowercase' => 'Lowercase',
                    'capitalize' => 'Capitalize',
                ])
                ->default('normal'),
        ],
    ],

    [
        'name' => 'visual-debut::shop.settings.buttons',
        'settings' => [
            // Settings\Header::make('Borders'),
            Settings\Range::make('button_border_width', 'Border width')->min(0)->max(4)->step(0.5)->unit('px')->default(0),
            Radius::make('button_border_radius', 'Border radius')
        ]
    ],

    [
        'name' => 'visual-debut::shop.settings.inputs',
        'settings' => [
            // Settings\Header::make('Borders'),
            Settings\Range::make('input_height', 'Height')->min(8)->max(24)->step(2)->unit('px')->default(10),
            Settings\Range::make('input_border_width', 'Border width')->min(0)->max(4)->step(0.5)->unit('px')->default(1),
            Radius::make('input_border_radius', 'Border radius')
        ]
    ],

    [
        'name' => 'visual-debut::shop.settings.boxes',
        'settings' => [
            // Settings\Header::make('Borders'),
            Settings\Range::make('box_border_width', 'Border width')->min(0)->max(4)->step(0.5)->unit('px')->default(1),
            Radius::make('box_border_radius', 'Border radius')
        ]
    ],

    [
        'name' => 'visual-debut::shop.settings.social-links',
        'settings' => [
            Settings\Text::make('facebook_url', 'Facebook URL')->default('https://www.facebook.com'),
            Settings\Text::make('instagram_url', 'Instagram URL')->default('https://www.instagram.com'),
            Settings\Text::make('youtube_url', 'Youtube URL')->default('https://www.youtube.com'),
            Settings\Text::make('tiktok_url', 'Tiktok URL')->default('https://www.tiktok.com'),
            Settings\Text::make('twitter_url', 'X/Twitter URL')->default('https://www.x.com'),
            Settings\Text::make('snapchat_url', 'Snapchat')->default('https://www.snapchat.com'),
        ],
    ],
    [
        'name' => 'visual-debut::shop.settings.general',
        'settings' => [
            Settings\Checkbox::make('enable_admin_bar', 'Enable Admin Bar')
                ->default(false)
        ]
    ]
];
