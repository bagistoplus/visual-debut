<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductGroupedOptions extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.grouped-options';

    protected static string $type = '@visual-debut/product-grouped-options';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('position', _t('blocks.product-grouped-options.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-grouped-options.settings.position_right'),
                    'under_gallery' => _t('blocks.product-grouped-options.settings.position_under_gallery'),
                ])
                ->default('right'),
        ];
    }


    protected function getViewData(): array
    {
        return [
            'product' => $this->block->settings->product ?? $this->context['product'] ?? null
        ];
    }
}
