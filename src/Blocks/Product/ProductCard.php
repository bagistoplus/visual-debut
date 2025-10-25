<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay;

use function BagistoPlus\VisualDebut\_t;

class ProductCard extends SimpleBlock
{
    protected static string $type = '@visual-debut/product-card';

    protected static array $accepts = ['@visual-debut/container', '@visual-debut/product-*'];

    protected static string $view = 'shop::blocks.products.product-card';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/></svg>';

    protected static string $category = 'Product';

    public static function settings(): array
    {
        return [Product::make('product', _t('blocks.common.product_label'))];
    }

    public function share(): array
    {
        return [
            'product' => $this->block->settings->product ?? $this->context['product'] ?? null
        ];
    }

    protected function getViewData(): array
    {
        return [
            'product' => $this->block->settings->product
        ];
    }

    public static function presets(): array
    {
        return [
            // Vertical Product Card
            // Preset::make(_t('blocks.product-card.presets.vertical.name'))
            //     ->category(_t('blocks.product-card.presets.vertical.category'))
            //     ->blocks([
            //         PresetBlock::make('@visual-debut/container')
            //             ->properties([
            //                 'layout_type' => 'flex',
            //                 'flex_direction' => ['_default' => 'column'],
            //                 'flex_gap' => 0,
            //                 'border' => true,
            //                 'border_width' => 1,
            //                 'border_style' => 'solid',
            //                 'border_color' => '#E5E7EBFF',
            //                 'border_radius' => 'lg',
            //                 'background_color' => 'transparent',
            //             ])
            //             ->children([
            //                 PresetBlock::make('@visual-debut/product-image')
            //                     ->properties([
            //                         'size' => 'medium',
            //                         'aspect_ratio' => 'square',
            //                         'object_fit' => 'cover',
            //                     ]),
            //                 PresetBlock::make('@visual-debut/container')
            //                     ->properties([
            //                         'layout_type' => 'flex',
            //                         'flex_direction' => ['_default' => 'column'],
            //                         'flex_gap' => 2,
            //                         'padding_top' => ['_default' => 4],
            //                         'padding_bottom' => ['_default' => 4],
            //                         'padding_left' => ['_default' => 4],
            //                         'padding_right' => ['_default' => 4],
            //                     ])
            //                     ->children([
            //                         PresetBlock::make('@visual-debut/product-title')
            //                             ->properties([
            //                                 'tag' => 'h3',
            //                                 'size' => 100,
            //                             ]),
            //                         PresetBlock::make('@visual-debut/product-price'),
            //                     ]),
            //             ]),
            //     ]),

            // // Horizontal Product Card
            // Preset::make(_t('blocks.product-card.presets.horizontal.name'))
            //     ->category(_t('blocks.product-card.presets.horizontal.category'))
            //     ->blocks([
            //         PresetBlock::make('@visual-debut/container')
            //             ->properties([
            //                 'layout_type' => 'flex',
            //                 'flex_direction' => ['_default' => 'row', 'mobile' => 'column'],
            //                 'flex_gap' => ['_default' => 4],
            //                 'border' => true,
            //                 'border_width' => 1,
            //                 'border_style' => 'solid',
            //                 'border_color' => '#E5E7EBFF',
            //                 'border_radius' => 'lg',
            //                 'background_color' => 'transparent',
            //             ])
            //             ->children([
            //                 PresetBlock::make('@visual-debut/container')
            //                     ->properties([
            //                         'layout_type' => 'block',
            //                         'width' => ['_default' => 'custom'],
            //                         'custom_width' => 300,
            //                     ])
            //                     ->children([
            //                         PresetBlock::make('@visual-debut/product-image')
            //                             ->properties([
            //                                 'size' => 'medium',
            //                                 'aspect_ratio' => 'square',
            //                                 'object_fit' => 'cover',
            //                             ]),
            //                     ]),
            //                 PresetBlock::make('@visual-debut/container')
            //                     ->properties([
            //                         'layout_type' => 'flex',
            //                         'flex_direction' => ['_default' => 'column'],
            //                         'flex_gap' => 3,
            //                         'padding_top' => ['_default' => 4],
            //                         'padding_bottom' => ['_default' => 4],
            //                         'padding_left' => ['_default' => 4],
            //                         'padding_right' => ['_default' => 4],
            //                         'justify_content' => 'center',
            //                     ])
            //                     ->children([
            //                         PresetBlock::make('@visual-debut/product-title')
            //                             ->properties([
            //                                 'tag' => 'h3',
            //                                 'size' => 120,
            //                             ]),
            //                         PresetBlock::make('@visual-debut/product-short-description'),
            //                         PresetBlock::make('@visual-debut/product-price'),
            //                     ]),
            //             ]),
            //     ]),

            // Card with Hover Overlay
            ProductCardWithOverlay::class,
        ];
    }
}
