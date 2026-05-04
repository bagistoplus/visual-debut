<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Product;
use BagistoPlus\VisualDebut\Blocks\ProductCardGroup;
use BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay;

use function BagistoPlus\VisualDebut\_t;

class ProductCard extends SimpleBlock
{
    protected static string $type = '@visual-debut/product-card';

    protected static string $view = 'shop::blocks.products.product-card';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/></svg>';

    protected static string $category = 'Product';

    protected static array $accepts = [
        ProductCardGroup::class,
        '@visual-debut/product-*',
    ];

    public static function settings(): array
    {
        return [
            Product::make('product', _t('blocks.common.product_label')),
            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->default('inherit'),
        ];
    }

    public function share(): array
    {
        return [
            'product' => $this->block->settings->product ?? $this->context['product'] ?? null,
        ];
    }

    protected function getViewData(): array
    {
        return [
            'product' => $this->block->settings->product,
        ];
    }

    public static function presets(): array
    {
        return [
            ProductCardWithOverlay::class,
        ];
    }
}
