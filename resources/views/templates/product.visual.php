<?php

use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\Visual\Support\TemplateBuilder;

return TemplateBuilder::make()
    ->section('breadcrumbs', '@visual-debut/breadcrumbs')
    ->section('product-information', '@visual-debut/product-information', fn($section) => $section
        ->properties([
            'section_width' => 'container',
            'media_position' => 'left',
            'equal_columns' => true,
            'gap' => 8,
            'padding_top' => 4,
            'padding_bottom' => 4,
        ])
        ->blocks([
            PresetBlock::make('@visual-debut/product-media-gallery')
                ->id('static-product-media')
                ->static()
                ->settings([
                    'media_presentation' => 'carousel',
                    'aspect_ratio' => 'adapt',
                    'zoom' => true,
                    'sticky' => true,
                ]),
            PresetBlock::make('@visual-debut/product-details')
                ->id('static-product-details')
                ->static()
                ->settings([
                    'gap' => 3,
                    'sticky' => false,
                ])
                ->blocks([
                    PresetBlock::make('@visual-debut/product-title')
                        ->id('title')
                        ->settings([
                            'tag' => 'h1',
                            'size' => ['_default' => '2xl'],
                        ]),
                    PresetBlock::make('@visual-debut/product-price')
                        ->id('price')
                        ->settings([
                            'show_compare_price' => true,
                        ]),
                    PresetBlock::make('@visual-debut/product-rating')->id('rating'),
                    PresetBlock::make('@visual-debut/divider')->id('separator-1'),
                    PresetBlock::make('@visual-debut/product-short-description')->id('short-description'),
                    PresetBlock::make('@visual-debut/product-variant-picker')->id('variants'),
                    PresetBlock::make('@visual-debut/product-quantity-selector')->id('quantity-selector'),
                    PresetBlock::make('@visual-debut/product-buy-buttons')->id('buy-buttons'),
                    PresetBlock::make('@visual-debut/divider')->id('separator-2'),
                    PresetBlock::make('@visual-debut/accordion')
                        ->id('description-accordion')
                        ->blocks([
                            PresetBlock::make('@visual-debut/accordion-row')
                                ->id('description-row')
                                ->settings([
                                    'heading' => 'Description',
                                    'open' => true,
                                ])
                                ->blocks([
                                    PresetBlock::make('@visual-debut/product-description')
                                        ->id('description-content'),
                                ]),
                        ]),
                ]),
        ]))
    ->section('product-reviews', '@visual-debut/product-reviews')
    ->order(['breadcrumbs', 'product-information', 'product-reviews']);
