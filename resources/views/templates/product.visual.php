<?php

use BagistoPlus\BasicBlocks\Blocks\Basic\Divider;
use BagistoPlus\BasicBlocks\Blocks\Product\ProductDescription;
use BagistoPlus\BasicBlocks\Blocks\Product\ProductShortDescription;
use BagistoPlus\BasicBlocks\Blocks\Product\ProductTitle;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Blocks\Accordion;
use BagistoPlus\VisualDebut\Blocks\AccordionRow;
use BagistoPlus\VisualDebut\Blocks\Product\ProductBundleOptions;
use BagistoPlus\VisualDebut\Blocks\Product\ProductBuyButtons;
use BagistoPlus\VisualDebut\Blocks\Product\ProductCustomizableOptions;
use BagistoPlus\VisualDebut\Blocks\Product\ProductDetails;
use BagistoPlus\VisualDebut\Blocks\Product\ProductDownloadableOptions;
use BagistoPlus\VisualDebut\Blocks\Product\ProductGroupedOptions;
use BagistoPlus\VisualDebut\Blocks\Product\ProductMediaGallery;
use BagistoPlus\VisualDebut\Blocks\Product\ProductPrice;
use BagistoPlus\VisualDebut\Blocks\Product\ProductQuantitySelector;
use BagistoPlus\VisualDebut\Blocks\Product\ProductRating;
use BagistoPlus\VisualDebut\Blocks\Product\ProductVariantPicker;
use BagistoPlus\VisualDebut\Sections\Breadcrumbs;
use BagistoPlus\VisualDebut\Sections\ProductInformation;
use BagistoPlus\VisualDebut\Sections\ProductReviews;

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
                    'media_presentation' => 'carousel',
                    'aspect_ratio' => 'adapt',
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
                            'typography' => 'heading-1',
                        ]),
                    PresetBlock::make(ProductPrice::class)
                        ->id('price')
                        ->settings([
                            'show_compare_price' => true,
                        ]),
                    PresetBlock::make(ProductRating::class)->id('rating'),
                    PresetBlock::make(Divider::class)->id('separator-1'),
                    PresetBlock::make(ProductShortDescription::class)->id('short-description'),
                    PresetBlock::make(ProductVariantPicker::class)->id('variants'),
                    PresetBlock::make(ProductGroupedOptions::class)->id('grouped-options'),
                    PresetBlock::make(ProductBundleOptions::class)->id('bundle-options'),
                    PresetBlock::make(ProductDownloadableOptions::class)->id('downloadable-options'),
                    PresetBlock::make(ProductCustomizableOptions::class)->id('customizable-options'),
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
                                    'open' => true,
                                ])
                                ->blocks([
                                    PresetBlock::make(ProductDescription::class)
                                        ->id('description-content'),
                                ]),
                        ]),
                ]),
        ]))
    ->section('product-reviews', ProductReviews::class)
    ->order(['breadcrumbs', 'product-information', 'product-reviews']);
