<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductBuyButtons extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.buy-buttons';

    protected static string $type = '@visual-debut/product-buy-buttons';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 2;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('position', _t('blocks.product-buy-buttons.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-buy-buttons.settings.position_right'),
                    'under_gallery' => _t('blocks.product-buy-buttons.settings.position_under_gallery'),
                ])
                ->default('right'),

            Checkbox::make('enable_buy_now', _t('blocks.product-buy-buttons.settings.enable_buy_now_label'))
                ->info(_t('blocks.product-buy-buttons.settings.enable_buy_now_info'))
                ->default(true),
        ];
    }


    protected function getViewData(): array
    {
        return [
            'product' => $this->block->settings->product ?? $this->context['product'] ?? null
        ];
    }
}
