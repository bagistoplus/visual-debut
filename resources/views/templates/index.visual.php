<?php

use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Presets\CategoryGrid;
use BagistoPlus\VisualDebut\Presets\HeroBanner;

return TemplateBuilder::make()
    ->section('hero-banner', HeroBanner::class)
    ->section('category-list', CategoryGrid::class)
    ->section(
        'featured-products',
        '@visual-debut/product-list',
        fn($section) => $section
            ->properties(['nb_products' => 4])
            ->blocks([
                \BagistoPlus\Visual\Support\PresetBlock::make('@visual-debut/heading')
                    ->settings([
                        'text' => 'Featured Products',
                        'tag' => 'h2',
                        'width' => 'fill',
                        'alignment' => 'center',
                        'typography' => 'heading-2',
                        'padding' => [
                            'top' => 0,
                            'right' => 4,
                            'bottom' => 4,
                            'left' => 0,
                        ],
                    ]),

                \BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay::asChild()
                    ->id('static-product-card')
                    ->static()
                    ->repeated(),
            ])
    )
    ->section('newsletter', '@visual-debut/newsletter')
    ->order(['hero-banner', 'category-list', 'featured-products', 'newsletter']);
