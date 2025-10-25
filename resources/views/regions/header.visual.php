<?php

use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\Visual\Support\TemplateBuilder;

return TemplateBuilder::make()
    ->id('header')
    ->name('header')

    // Announcement Bar Section
    ->section('announcement-bar', '@visual-debut/announcement-bar')

    // Main Header Section
    ->section(
        'main-header',
        '@visual-debut/header',
        fn($section) => $section
            ->properties([
                'content_width' => 'container',
            ])
            ->blocks([
                // Logo Container
                PresetBlock::make('@visual-debut/container')
                    ->id('container-logo')
                    ->name('Logo')
                    ->settings([
                        'layout_type' => 'flex',
                        'gap' => ['_default' => 4],
                        'width' => 'auto',
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/logo')
                            ->name('Logo'),
                    ]),

                // Navigation Container
                PresetBlock::make('@visual-debut/container')
                    ->id('container-nav')
                    ->name('Navigation')
                    ->settings([
                        'layout_type' => 'flex',
                        'justify_content' => 'start',
                        'gap' => ['_default' => 4],
                        'width' => 'full',
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/header-nav')
                            ->id('navigation')
                            ->name('Navigation'),
                    ]),

                // Actions Container
                PresetBlock::make('@visual-debut/container')
                    ->id('container-actions')
                    ->name('Actions')
                    ->settings([
                        'layout_type' => 'flex',
                        'justify_content' => 'end',
                        'gap' => ['_default' => 2],
                        'width' => 'auto',
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/header-currency')
                            ->id('currency-selector')
                            ->name('Currency Selector'),

                        PresetBlock::make('@visual-debut/header-locale')
                            ->id('locale-selector')
                            ->name('Language Selector')
                            ->settings([
                                'icon' => 'lucide-globe',
                            ]),

                        PresetBlock::make('@visual-debut/header-search')
                            ->id('search')
                            ->name('Search Form')
                            ->settings([
                                'search_icon' => 'lucide-search',
                                'image_search_icon' => 'lucide-camera',
                            ]),

                        PresetBlock::make('@visual-debut/header-compare')
                            ->id('compare')
                            ->name('Compare')
                            ->settings([
                                'icon' => 'lucide-arrow-left-right',
                            ]),

                        PresetBlock::make('@visual-debut/header-user')
                            ->id('user')
                            ->name('User Menu')
                            ->settings([
                                'icon' => 'lucide-user',
                                'guest_heading' => 'Welcome Guest',
                                'guest_description' => 'Manage Cart, Orders & Wishlist',
                            ]),

                        PresetBlock::make('@visual-debut/header-cart')
                            ->id('cart')
                            ->name('Cart Preview')
                            ->settings([
                                'heading' => 'Shopping Cart',
                                'description' => 'Get Up To 30% OFF on your 1st order',
                            ]),
                    ]),
            ])
    )

    ->order(['announcement-bar', 'main-header']);
