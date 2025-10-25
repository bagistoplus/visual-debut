<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductQuantitySelector extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.quantity-selector';

    protected static string $type = '@visual-debut/product-quantity-selector';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" x2="19" y1="9" y2="9"/><line x1="5" x2="19" y1="15" y2="15"/><line x1="12" x2="12" y1="5" y2="13"/><line x1="12" x2="12" y1="15" y2="19"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('position', _t('blocks.product-quantity-selector.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-quantity-selector.settings.position_right'),
                    'under_gallery' => _t('blocks.product-quantity-selector.settings.position_under_gallery'),
                ])
                ->default('right'),
        ];
    }


    protected function getViewData(): array
    {
        $product = $this->block->settings->product ?? $this->context['product'] ?? null;

        return [
            'product' => $product,
            'showQuantitySelector' => $product ? $product->getTypeInstance()->showQuantityBox() : false,
        ];
    }
}
