<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductVariantPicker extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.variant-picker';

    protected static string $type = '@visual-debut/product-variant-picker';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v6M12 17v6M4.2 4.2l4.2 4.2M15.6 15.6l4.2 4.2M1 12h6M17 12h6M4.2 19.8l4.2-4.2M15.6 8.4l4.2-4.2"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('position', _t('blocks.product-variant-picker.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-variant-picker.settings.position_right'),
                    'under_gallery' => _t('blocks.product-variant-picker.settings.position_under_gallery'),
                ])
                ->default('right'),
        ];
    }


    protected function getViewData(): array
    {
        $product = $this->block->settings->product ?? $this->context['product'] ?? null;

        return [
            'product' => $product,
            'hasVariants' => $product ? \Webkul\Product\Helpers\ProductType::hasVariants($product->type) : false,
        ];
    }
}
