<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;

use function BagistoPlus\VisualDebut\_t;

class Product extends SimpleBlock
{
    protected static string $type = '@visual-debut/product';

    protected static string $view = 'visual-debut::blocks.product';

    protected static string $category = 'Product';

    protected static bool $private = true;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label'))
                ->info(_t('blocks.product.settings.product_info')),
        ];
    }

    public function share(): array
    {
        return [
            'product' => $this->block->settings->product ?? $this->context['product'] ?? null
        ];
    }
}
