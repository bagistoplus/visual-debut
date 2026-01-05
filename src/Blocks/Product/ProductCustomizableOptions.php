<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;

use function BagistoPlus\VisualDebut\_t;

class ProductCustomizableOptions extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.customizable-options';

    protected static string $type = '@visual-debut/product-customizable-options';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v6m0 6v6"/><path d="m4.2 4.2 4.2 4.2m5.6 5.6 4.2 4.2"/><path d="M1 12h6m6 0h6"/><path d="m4.2 19.8 4.2-4.2m5.6-5.6 4.2-4.2"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),
        ];
    }


    protected function getViewData(): array
    {
        return [
            'product' => $this->block->settings->product ?? $this->context('product')
        ];
    }
}
