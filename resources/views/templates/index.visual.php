<?php

use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Blocks\Basic\Heading;
use BagistoPlus\VisualDebut\Presets\CategoryGrid;
use BagistoPlus\VisualDebut\Presets\HeroBanner;
use BagistoPlus\VisualDebut\Sections\Newsletter;
use BagistoPlus\VisualDebut\Sections\ProductList;

return TemplateBuilder::make()
    ->section('hero-banner', HeroBanner::class)
    ->section('category-list', CategoryGrid::class)
    ->section(
        'featured-products',
        ProductList::class,
        fn($section) => $section
            ->properties(['nb_products' => 4])
            ->blocks([
                \BagistoPlus\Visual\Support\PresetBlock::make(Heading::class)
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
    ->section('newsletter', Newsletter::class)
    ->order(['hero-banner', 'category-list', 'featured-products', 'newsletter']);
