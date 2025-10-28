<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductDescription extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.description';

    protected static string $type = '@visual-debut/product-description';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 2;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),
            Checkbox::make('show_in_panel', _t('blocks.product-description.settings.show_in_panel_label'))
                ->default(false),

            Checkbox::make('should_open_panel', _t('blocks.product-description.settings.should_open_panel_label'))
                ->default(true),

            Select::make('position', _t('blocks.product-description.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-description.settings.position_right'),
                    'under_gallery' => _t('blocks.product-description.settings.position_under_gallery'),
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
