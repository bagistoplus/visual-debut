<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductDownloadableOptions extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.downloadable-options';

    protected static string $type = '@visual-debut/product-downloadable-options';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('position', _t('blocks.product-downloadable-options.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-downloadable-options.settings.position_right'),
                    'under_gallery' => _t('blocks.product-downloadable-options.settings.position_under_gallery'),
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
