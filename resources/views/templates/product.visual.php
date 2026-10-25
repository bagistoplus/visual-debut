<?php

use BagistoPlus\BasicBlocks\Blocks\Basic\Divider;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Product\ProductDescription;
use BagistoPlus\BasicBlocks\Blocks\Product\ProductShortDescription;
use BagistoPlus\BasicBlocks\Blocks\Product\ProductTitle;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Blocks\Accordion;
use BagistoPlus\VisualDebut\Blocks\AccordionRow;
use BagistoPlus\VisualDebut\Blocks\Product\ProductBuyButtons;
use BagistoPlus\VisualDebut\Blocks\Product\ProductDetails;
use BagistoPlus\VisualDebut\Blocks\Product\ProductMediaGallery;
use BagistoPlus\VisualDebut\Blocks\Product\ProductOptions;
use BagistoPlus\VisualDebut\Blocks\Product\ProductPrice;
use BagistoPlus\VisualDebut\Blocks\Product\ProductQuantitySelector;
use BagistoPlus\VisualDebut\Blocks\Product\ProductRating;
use BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay;
use BagistoPlus\VisualDebut\Sections\Breadcrumbs;
use BagistoPlus\VisualDebut\Sections\ProductInformation;
use BagistoPlus\VisualDebut\Sections\ProductRecommendations;
use BagistoPlus\VisualDebut\Sections\ProductReviews;

use function BagistoPlus\VisualDebut\_t;

return TemplateBuilder::make()
    ->section('breadcrumbs', Breadcrumbs::class)
    ->section('product-information', ProductInformation::class, fn ($section) => $section
        ->properties([
            'section_width' => 'container',
            'media_position' => 'left',
            'equal_columns' => true,
            'gap' => 8,
            'padding' => [
                'top' => 4,
                'right' => 0,
                'bottom' => 4,
                'left' => 0,
            ],
        ])
        ->blocks([
            PresetBlock::make(ProductMediaGallery::class)
                ->id('static-product-media')
                ->static()
                ->settings([
                    'aspect_ratio' => 'square',
                    'media_fit' => 'cover',
                    'zoom' => true,
                    'sticky' => true,
                ]),
            PresetBlock::make(ProductDetails::class)
                ->id('static-product-details')
                ->static()
                ->settings([
                    'gap' => 3,
                    'sticky' => false,
                ])
                ->blocks([
                    PresetBlock::make(ProductTitle::class)
                        ->id('title')
                        ->settings([
                            'heading_level' => 'h1',
                            'typography' => 'heading-2',
                        ]),
                    PresetBlock::make(ProductPrice::class)
                        ->id('price')
                        ->settings([
                            'show_compare_price' => true,
                        ]),
                    PresetBlock::make(ProductRating::class)->id('rating'),
                    PresetBlock::make(Divider::class)->id('separator-1'),
                    PresetBlock::make(ProductShortDescription::class)->id('short-description'),
                    PresetBlock::make(ProductOptions::class)->id('options'),
                    PresetBlock::make(ProductQuantitySelector::class)->id('quantity-selector'),
                    PresetBlock::make(ProductBuyButtons::class)->id('buy-buttons'),
                    PresetBlock::make(Divider::class)->id('separator-2'),
                    PresetBlock::make(Accordion::class)
                        ->id('description-accordion')
                        ->blocks([
                            PresetBlock::make(AccordionRow::class)
                                ->id('description-row')
                                ->settings([
                                    'heading' => 'Description',
                                    'open_by_default' => true,
                                ])
                                ->blocks([
                                    PresetBlock::make(ProductDescription::class)
                                        ->id('description-content'),
                                ]),
                        ]),
                ]),
        ]))
    ->section('product-reviews', ProductReviews::class)
    ->section('related-products', ProductRecommendations::class, fn ($section) => $section
        ->name(_t('sections.product-recommendations.presets.related.name'))
        ->properties([
            'source' => 'related',
            'nb_products' => 8,
            'layout_type' => 'carousel',
        ])
        ->blocks([
            PresetBlock::make(Heading::class)
                ->settings([
                    'text' => trans('shop::app.products.view.related-product-title'),
                    'heading_level' => 'h2',
                    'width' => 'fill',
                    'alignment' => 'center',
                    'typography' => 'heading-2',
                    'padding' => [
                        'top' => 4,
                        'right' => 0,
                        'bottom' => 4,
                        'left' => 0,
                    ],
                ]),
            ProductCardWithOverlay::asChild()
                ->id('static-product-card')
                ->static()
                ->repeated(),
        ]))
    ->section('up-sells', ProductRecommendations::class, fn ($section) => $section
        ->name(_t('sections.product-recommendations.presets.up_sells.name'))
        ->properties([
            'source' => 'up_sells',
            'nb_products' => 8,
            'layout_type' => 'carousel',
        ])
        ->blocks([
            PresetBlock::make(Heading::class)
                ->settings([
                    'text' => trans('shop::app.products.view.up-sell-title'),
                    'heading_level' => 'h2',
                    'width' => 'fill',
                    'alignment' => 'center',
                    'typography' => 'heading-2',
                    'padding' => [
                        'top' => 4,
                        'right' => 0,
                        'bottom' => 4,
                        'left' => 0,
                    ],
                ]),
            ProductCardWithOverlay::asChild()
                ->id('static-product-card')
                ->static()
                ->repeated(),
        ]))
    ->order(['breadcrumbs', 'product-information', 'product-reviews', 'related-products', 'up-sells']);
