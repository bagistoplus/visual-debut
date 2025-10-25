<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

class ProductCardWithOverlay extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/product-card';
    }

    protected function build(): void
    {
        $this
            ->name('Product Card')
            ->category('Product')
            ->properties(['product' => null])
            ->blocks([
                // Image Container + Overlay
                PresetBlock::make('@visual-debut/container')
                    ->name('Container')
                    ->properties([
                        'layout_type' => 'block',
                        'position' => 'relative',
                        'background_type' => 'none',
                    ])
                    ->blocks([
                        // Product Image
                        PresetBlock::make('@visual-debut/product-image')
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
                        PresetBlock::make('@visual-debut/container')
                            ->name('Buttons')
                            ->properties([
                                'layout_type' => 'flex',
                                'flex_direction' => 'row',
                                'flex_wrap' => 'wrap',
                                'justify_content' => 'center',
                                'align_items' => 'center',
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
                                PresetBlock::make('@visual-debut/product-button')
                                    ->name('Add to cart')
                                    ->properties([
                                        'action' => 'cart',
                                        'variant' => 'solid',
                                        'size' => 'xl',
                                        'color' => 'primary',
                                        'circle' => true
                                    ]),

                                // Add to Wishlist Button
                                PresetBlock::make('@visual-debut/product-button')
                                    ->name('Add to wishlist')
                                    ->properties([
                                        'action' => 'wishlist',
                                        'variant' => 'solid',
                                        'size' => 'xl',
                                        'color' => 'secondary',
                                        'circle' => true
                                    ]),

                                // Add to Compare Button
                                PresetBlock::make('@visual-debut/product-button')
                                    ->name('Add to compare')
                                    ->properties([
                                        'action' => 'compare',
                                        'variant' => 'soft',
                                        'size' => 'xl',
                                        'color' => 'primary',
                                        'circle' => true
                                    ]),
                            ]),
                    ]),

                // Product Info Container
                PresetBlock::make('@visual-debut/container')
                    ->name('Informations')
                    ->properties([
                        'layout_type' => 'block',
                        'padding_top' => ['_default' => '3'],
                        'padding_bottom' => ['_default' => '3'],
                        'padding_left' => ['_default' => '4'],
                        'padding_right' => ['_default' => '4']
                    ])
                    ->addBlocks([
                        // Product Title
                        PresetBlock::make('@visual-debut/product-title')
                            ->name('Product Title')
                            ->properties([
                                'product' => null,
                                'heading_level' => 'h3',
                                'width' => 'fit-content',
                                'alignment' => 'left',
                                'type_preset' => 'paragraph'
                            ]),

                        // Price and Labels Container
                        PresetBlock::make('@visual-debut/container')
                            ->name('Price & Labels')
                            ->properties([
                                'layout_type' => 'flex',
                                'flex_direction' => 'row',
                                'justify_content' => 'between',
                                'align_items' => 'stretch',
                                'flex_gap' => 4,
                                'margin_top' => ['_default' => '2']
                            ])
                            ->addBlocks([
                                // Product Price
                                PresetBlock::make('@visual-debut/product-price')
                                    ->name('Price'),

                                // Product Labels
                                PresetBlock::make('@visual-debut/product-labels')
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
