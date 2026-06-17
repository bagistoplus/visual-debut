<?php

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Presets\CategoryGrid;
use BagistoPlus\VisualDebut\Presets\HeroBanner;
use BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay;
use BagistoPlus\VisualDebut\Sections\Newsletter;
use BagistoPlus\VisualDebut\Sections\ProductList;

use function BagistoPlus\VisualDebut\_t;

return TemplateBuilder::make()
    ->section('hero-banner', HeroBanner::class)
    ->section('category-list', CategoryGrid::class)
    ->section(
        'featured-products',
        ProductList::class,
        fn ($section) => $section
            ->properties(['nb_products' => 4])
            ->blocks([
                PresetBlock::make(Heading::class)
                    ->settings([
                        'text' => _t('sections.product-list.settings.featured_label'),
                        'heading_level' => 'h2',
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

                ProductCardWithOverlay::asChild()
                    ->id('static-product-card')
                    ->static()
                    ->repeated(),
            ])
    )
    ->section('newsletter', Newsletter::class)
    ->order(['hero-banner', 'category-list', 'featured-products', 'newsletter']);
