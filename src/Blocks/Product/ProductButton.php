<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductButton extends SimpleBlock
{
    protected static string $type = '@visual-debut/product-button';

    protected static string $view = 'visual-debut::blocks.product.button';

    protected static string $category = 'Product';

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('action', _t('blocks.product-button.settings.action_label'))
                ->options([
                    'cart' => _t('blocks.product-button.settings.action_options.cart'),
                    'wishlist' => _t('blocks.product-button.settings.action_options.wishlist'),
                    'compare' => _t('blocks.product-button.settings.action_options.compare'),
                ])
                ->default('cart'),

            Select::make('variant', _t('blocks.product-button.settings.variant_label'))
                ->options([
                    'solid' => _t('blocks.product-button.settings.variant_options.solid'),
                    'outline' => _t('blocks.product-button.settings.variant_options.outline'),
                    'soft' => _t('blocks.product-button.settings.variant_options.soft'),
                    'link' => _t('blocks.product-button.settings.variant_options.link'),
                ])
                ->default('solid'),

            Select::make('size', _t('blocks.product-button.settings.size_label'))
                ->options([
                    'sm' => _t('blocks.product-button.settings.size_options.sm'),
                    'md' => _t('blocks.product-button.settings.size_options.md'),
                    'lg' => _t('blocks.product-button.settings.size_options.lg'),
                    'xl' => _t('blocks.product-button.settings.size_options.xl'),
                ])
                ->default('md'),

            Select::make('color', _t('blocks.product-button.settings.color_label'))
                ->options([
                    'primary' => _t('blocks.product-button.settings.color_options.primary'),
                    'secondary' => _t('blocks.product-button.settings.color_options.secondary'),
                    'success' => _t('blocks.product-button.settings.color_options.success'),
                    'danger' => _t('blocks.product-button.settings.color_options.danger'),
                    'warning' => _t('blocks.product-button.settings.color_options.warning'),
                    'info' => _t('blocks.product-button.settings.color_options.info'),
                ])
                ->default('primary'),

            Icon::make('icon', _t('blocks.product-button.settings.icon_label'))
                ->info(_t('blocks.product-button.settings.icon_info')),

            Checkbox::make('circle', _t('blocks.product-button.settings.circle_label'))
                ->info(_t('blocks.product-button.settings.circle_info'))
                ->default(false),

            Checkbox::make('square', _t('blocks.product-button.settings.square_label'))
                ->info(_t('blocks.product-button.settings.square_info'))
                ->default(false),

            Checkbox::make('block', _t('blocks.product-button.settings.block_label'))
                ->info(_t('blocks.product-button.settings.block_info'))
                ->default(false),
        ];
    }

    protected function getViewData(): array
    {
        $product = $this->block->settings->product ?? $this->context['product'] ?? null;

        if (!$product) {
            return [
                'product' => null,
                'productResource' => null,
                'canShowWishlist' => false,
                'canShowCompare' => false,
            ];
        }

        $productResource = (new \Webkul\Shop\Http\Resources\ProductResource($product))->resolve();

        return [
            'product' => $product,
            'productResource' => $productResource,
            'canShowWishlist' => auth('customer')->check() && core()->getConfigData('customer.settings.wishlist.wishlist_option'),
            'canShowCompare' => core()->getConfigData('catalog.products.settings.compare_option'),
        ];
    }
}
