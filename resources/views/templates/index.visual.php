<?php

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Presets\CategoryTiles;
use BagistoPlus\VisualDebut\Presets\FeatureIcons;
use BagistoPlus\VisualDebut\Presets\HeroBanner;
use BagistoPlus\VisualDebut\Presets\OurStory;
use BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay;
use BagistoPlus\VisualDebut\Presets\Testimonials;
use BagistoPlus\VisualDebut\Sections\Newsletter;
use BagistoPlus\VisualDebut\Sections\ProductList;

use function BagistoPlus\VisualDebut\_t;

return TemplateBuilder::make()
    ->section('hero-banner', HeroBanner::class)
    ->section('category-list', CategoryTiles::class)
    ->section(
        'new-arrivals',
        ProductList::class,
        fn ($section) => $section
            ->properties([
                'product_type' => 'new',
                'nb_products' => 8,
                'columns' => ['_default' => 4, 'mobile' => 2, 'tablet' => 3],
                'gap' => ['_default' => 6, 'mobile' => 3],
                'padding' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 14,
                    'left' => 0,
                ],
            ])
            ->blocks([
                PresetBlock::make(Heading::class)
                    ->settings([
                        'text' => _t('sections.product-list.presets.new.heading'),
                        'heading_level' => 'h2',
                        'width' => 'fill',
                        'alignment' => 'center',
                        'typography' => 'heading-2',
                        'padding' => [
                            'top' => 0,
                            'right' => 0,
                            'bottom' => 8,
                            'left' => 0,
                        ],
                    ]),
                ProductCardWithOverlay::asChild()
                    ->id('static-product-card')
                    ->static()
                    ->repeated(),
            ])
    )
    ->section('our-story', OurStory::class)
    ->section('testimonials', Testimonials::class)
    ->section('feature-icons', FeatureIcons::class)
    ->section('newsletter', Newsletter::class)
    ->order([
        'hero-banner',
        'category-list',
        'new-arrivals',
        'our-story',
        'testimonials',
        'feature-icons',
        'newsletter',
    ]);
