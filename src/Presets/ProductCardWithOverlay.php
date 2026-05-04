<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Product\ProductImage;
use BagistoPlus\BasicBlocks\Blocks\Product\ProductLabels;
use BagistoPlus\BasicBlocks\Blocks\Product\ProductTitle;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Blocks\Product\ProductButton;
use BagistoPlus\VisualDebut\Blocks\Product\ProductCard;
use BagistoPlus\VisualDebut\Blocks\Product\ProductPrice;
use BagistoPlus\VisualDebut\Blocks\ProductCardGroup;

class ProductCardWithOverlay extends Preset
{
    public static function getType(): string
    {
        return ProductCard::class;
    }

    protected function build(): void
    {
        $this
            ->name('Product Card')
            ->category('Product')
            ->properties(['product' => null])
            ->blocks([
                // Image Container + Overlay
                PresetBlock::make(ProductCardGroup::class)
                    ->name('Container')
                    ->properties([
                        'layout_type' => 'block',
                        'position' => 'relative',
                        'background_type' => 'none',
                    ])
                    ->blocks([
                        // Product Image
                        PresetBlock::make(ProductImage::class)
                            ->name('Product Image')
                            ->properties([
                                'size' => 'medium',
                                'aspect_ratio' => 'adapt',
                                'object_fit' => 'cover',
                                'width' => 'fill',
                                'height' => 'fit',
                                'hover_zoom' => true,
                                'hover_zoom_scale' => 105,
                                'border_radius' => 'none',
                            ]),

                        // Overlay Container with Action Buttons
                        PresetBlock::make(ProductCardGroup::class)
                            ->name('Buttons')
                            ->properties([
                                'layout_type' => 'flex',
                                'flex_direction' => 'row',
                                'flex_wrap' => 'wrap',
                                'flex_justify' => 'center',
                                'flex_align' => 'center',
                                'flex_gap' => ['_default' => '2'],
                                'background_type' => 'color',
                                'background_color' => '#0000004D',
                                'is_overlay' => true,
                                'overlay_visibility' => 'hover',
                                'overlay_hover_target' => 'group/product-card',
                                'z_index' => 10,
                            ])
                            ->blocks([
                                // Add to Cart Button
                                PresetBlock::make(ProductButton::class)
                                    ->name('Add to cart')
                                    ->properties([
                                        'action' => 'cart',
                                        'variant' => 'solid',
                                        'size' => 'xl',
                                        'color' => 'primary',
                                        'circle' => true,
                                    ]),

                                // Add to Wishlist Button
                                PresetBlock::make(ProductButton::class)
                                    ->name('Add to wishlist')
                                    ->properties([
                                        'action' => 'wishlist',
                                        'variant' => 'solid',
                                        'size' => 'xl',
                                        'color' => 'secondary',
                                        'circle' => true,
                                    ]),

                                // Add to Compare Button
                                PresetBlock::make(ProductButton::class)
                                    ->name('Add to compare')
                                    ->properties([
                                        'action' => 'compare',
                                        'variant' => 'soft',
                                        'size' => 'xl',
                                        'color' => 'primary',
                                        'circle' => true,
                                    ]),
                            ]),
                    ]),

                // Product Info Container
                PresetBlock::make(ProductCardGroup::class)
                    ->name('Informations')
                    ->properties([
                        'layout_type' => 'block',
                        'padding' => [
                            'top' => 3,
                            'right' => 4,
                            'bottom' => 3,
                            'left' => 4,
                        ],
                    ])
                    ->addBlocks([
                        // Product Title
                        PresetBlock::make(ProductTitle::class)
                            ->name('Product Title')
                            ->properties([
                                'heading_level' => 'h3',
                                'width' => 'fit',
                                'alignment' => 'left',
                                'typography' => 'body',
                            ]),

                        // Price and Labels Container
                        PresetBlock::make(ProductCardGroup::class)
                            ->name('Price & Labels')
                            ->properties([
                                'layout_type' => 'flex',
                                'flex_direction' => 'row',
                                'flex_justify' => 'between',
                                'flex_gap' => 4,
                                'margin' => [
                                    'top' => 2,
                                    'right' => 0,
                                    'bottom' => 0,
                                    'left' => 0,
                                ],
                            ])
                            ->addBlocks([
                                // Product Price
                                PresetBlock::make(ProductPrice::class)
                                    ->name('Price'),

                                // Product Labels
                                PresetBlock::make(ProductLabels::class)
                                    ->name('Labels')
                                    ->properties([
                                        'layout' => 'inline',
                                        'gap' => 2,
                                        'alignment' => 'start',
                                        'size' => 'sm',
                                        'variant' => 'solid',
                                        'corner_radius' => 'md',
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
