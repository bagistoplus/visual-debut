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

use function BagistoPlus\VisualDebut\_t;

return TemplateBuilder::make()
    ->id('header')
    ->name('Header')

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
                    ->name(_t('sections.header.region.logo_group'))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_gap' => ['_default' => 4],
                        'width' => 'auto',
                    ])
                    ->blocks([
                        PresetBlock::make(Logo::class)
                            ->name(_t('blocks.logo.name')),
                    ]),

                // Navigation Container
                PresetBlock::make(HeaderGroup::class)
                    ->id('container-nav')
                    ->name(_t('blocks.header-nav.name'))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_justify' => 'start',
                        'flex_gap' => ['_default' => 4],
                        'width' => 'full',
                    ])
                    ->blocks([
                        PresetBlock::make(Nav::class)
                            ->id('navigation')
                            ->name(_t('blocks.header-nav.name')),
                    ]),

                // Actions Container
                PresetBlock::make(HeaderGroup::class)
                    ->id('container-actions')
                    ->name(_t('sections.header.region.actions_group'))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_justify' => 'end',
                        'flex_gap' => ['_default' => 2],
                        'width' => 'auto',
                    ])
                    ->blocks([
                        PresetBlock::make(Currency::class)
                            ->id('currency-selector')
                            ->name(_t('blocks.header-currency.name')),

                        PresetBlock::make(Locale::class)
                            ->id('locale-selector')
                            ->name(_t('blocks.header-locale.name'))
                            ->settings([
                                'icon' => 'lucide-globe',
                            ]),

                        PresetBlock::make(Search::class)
                            ->id('search')
                            ->name(_t('blocks.header-search.name'))
                            ->settings([
                                'search_icon' => 'lucide-search',
                                'image_search_icon' => 'lucide-camera',
                            ]),

                        PresetBlock::make(Compare::class)
                            ->id('compare')
                            ->name(_t('blocks.header-compare.name'))
                            ->settings([
                                'icon' => 'lucide-arrow-left-right',
                            ]),

                        PresetBlock::make(User::class)
                            ->id('user')
                            ->name(_t('blocks.header-user.name'))
                            ->settings([
                                'icon' => 'lucide-user',
                                'guest_heading' => _t('blocks.header-user.settings.guest_heading_default'),
                                'guest_description' => _t('blocks.header-user.settings.guest_description_default'),
                            ]),

                        PresetBlock::make(Cart::class)
                            ->id('cart')
                            ->name(_t('blocks.header-cart.name'))
                            ->settings([
                                'heading' => _t('blocks.header-cart.settings.heading_default'),
                                'description' => _t('blocks.header-cart.settings.description_default'),
                            ]),
                    ]),
            ])
    )

    ->order(['announcement-bar', 'main-header']);
