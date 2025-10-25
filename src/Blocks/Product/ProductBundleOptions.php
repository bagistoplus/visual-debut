<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductBundleOptions extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.bundle-options';

    protected static string $type = '@visual-debut/product-bundle-options';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('position', _t('blocks.product-bundle-options.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-bundle-options.settings.position_right'),
                    'under_gallery' => _t('blocks.product-bundle-options.settings.position_under_gallery'),
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
