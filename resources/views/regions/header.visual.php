<?php

use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Blocks\Basic\Logo;
use BagistoPlus\VisualDebut\Blocks\Header\Cart;
use BagistoPlus\VisualDebut\Blocks\Header\Compare;
use BagistoPlus\VisualDebut\Blocks\Header\Currency;
use BagistoPlus\VisualDebut\Blocks\Header\HeaderGroup;
use BagistoPlus\VisualDebut\Blocks\Header\Locale;
use BagistoPlus\VisualDebut\Blocks\Header\Nav;
use BagistoPlus\VisualDebut\Blocks\Header\Search;
use BagistoPlus\VisualDebut\Blocks\Header\User;
use BagistoPlus\VisualDebut\Sections\AnnouncementBar;
use BagistoPlus\VisualDebut\Sections\Header;

return TemplateBuilder::make()
    ->id('header')
    ->name('header')

    // Announcement Bar Section
    ->section('announcement-bar', AnnouncementBar::class)

    // Main Header Section
    ->section(
        'main-header',
        Header::class,
        fn ($section) => $section
            ->properties([
                'content_width' => 'container',
            ])
            ->blocks([
                // Logo Container
                PresetBlock::make(HeaderGroup::class)
                    ->id('container-logo')
                    ->name('Logo')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_gap' => ['_default' => 4],
                        'width' => 'auto',
                    ])
                    ->blocks([
                        PresetBlock::make(Logo::class)
                            ->name('Logo'),
                    ]),

                // Navigation Container
                PresetBlock::make(HeaderGroup::class)
                    ->id('container-nav')
                    ->name('Navigation')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_justify' => 'start',
                        'flex_gap' => ['_default' => 4],
                        'width' => 'full',
                    ])
                    ->blocks([
                        PresetBlock::make(Nav::class)
                            ->id('navigation')
                            ->name('Navigation'),
                    ]),

                // Actions Container
                PresetBlock::make(HeaderGroup::class)
                    ->id('container-actions')
                    ->name('Actions')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_justify' => 'end',
                        'flex_gap' => ['_default' => 2],
                        'width' => 'auto',
                    ])
                    ->blocks([
                        PresetBlock::make(Currency::class)
                            ->id('currency-selector')
                            ->name('Currency Selector'),

                        PresetBlock::make(Locale::class)
                            ->id('locale-selector')
                            ->name('Language Selector')
                            ->settings([
                                'icon' => 'lucide-globe',
                            ]),

                        PresetBlock::make(Search::class)
                            ->id('search')
                            ->name('Search Form')
                            ->settings([
                                'search_icon' => 'lucide-search',
                                'image_search_icon' => 'lucide-camera',
                            ]),

                        PresetBlock::make(Compare::class)
                            ->id('compare')
                            ->name('Compare')
                            ->settings([
                                'icon' => 'lucide-arrow-left-right',
                            ]),

                        PresetBlock::make(User::class)
                            ->id('user')
                            ->name('User Menu')
                            ->settings([
                                'icon' => 'lucide-user',
                                'guest_heading' => 'Welcome Guest',
                                'guest_description' => 'Manage Cart, Orders & Wishlist',
                            ]),

                        PresetBlock::make(Cart::class)
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
