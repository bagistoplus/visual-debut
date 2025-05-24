<?php

use BagistoPlus\Visual\Settings;
use BagistoPlus\VisualDebut\Settings\Radius;

return [
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
