<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductPrice extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.price';

    protected static string $type = '@visual-debut/product-price';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('position', _t('blocks.product-price.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-price.settings.position_right'),
                    'under_gallery' => _t('blocks.product-price.settings.position_under_gallery'),
                ])
                ->default('right'),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'product' => $this->block->settings->product
        ];
    }
}
