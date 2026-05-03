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
            Settings\TypographyPresets::make('typography_presets', 'Typography Presets')
                ->presets([
                    'body' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '400',
                        'fontSize' => 'base',
                        'fontStyle' => 'normal',
                        'lineHeight' => 'normal',
                        'letterSpacing' => 'normal',
                        'textTransform' => 'none',
                    ],
                    'heading-1' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '700',
                        'fontSize' => ['_default' => '5xl', 'mobile' => '4xl'],
                        'fontStyle' => 'normal',
                        'lineHeight' => 'tight',
                        'letterSpacing' => 'tight',
                        'textTransform' => 'none',
                    ],
                    'heading-2' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '600',
                        'fontSize' => ['_default' => '4xl', 'mobile' => '3xl'],
                        'fontStyle' => 'normal',
                        'lineHeight' => 'tight',
                        'letterSpacing' => 'normal',
                        'textTransform' => 'none',
                    ],
                    'heading-3' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '600',
                        'fontSize' => ['_default' => '3xl', 'mobile' => '2xl'],
                        'fontStyle' => 'normal',
                        'lineHeight' => 'snug',
                        'letterSpacing' => 'normal',
                        'textTransform' => 'none',
                    ],
                    'heading-4' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '500',
                        'fontSize' => ['_default' => '2xl', 'mobile' => 'xl'],
                        'fontStyle' => 'normal',
                        'lineHeight' => 'snug',
                        'letterSpacing' => 'normal',
                        'textTransform' => 'none',
                    ],
                    'heading-5' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '500',
                        'fontSize' => ['_default' => 'xl', 'mobile' => 'lg'],
                        'fontStyle' => 'normal',
                        'lineHeight' => 'normal',
                        'letterSpacing' => 'normal',
                        'textTransform' => 'none',
                    ],
                    'heading-6' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '500',
                        'fontSize' => 'base',
                        'fontStyle' => 'normal',
                        'lineHeight' => 'normal',
                        'letterSpacing' => 'normal',
                        'textTransform' => 'none',
                    ],
                    'body-sm' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '400',
                        'fontSize' => 'sm',
                        'fontStyle' => 'normal',
                        'lineHeight' => 'normal',
                        'letterSpacing' => 'normal',
                        'textTransform' => 'none',
                    ],
                    'body-xs' => [
                        'fontFamily' => 'poppins',
                        'fontWeight' => '400',
                        'fontSize' => 'xs',
                        'fontStyle' => 'normal',
                        'lineHeight' => 'normal',
                        'letterSpacing' => 'normal',
                        'textTransform' => 'none',
                    ],
                ]),
        ],
    ],

    \BagistoPlus\BasicBlocks\Settings\ButtonSettingsSchema::flat(),

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
