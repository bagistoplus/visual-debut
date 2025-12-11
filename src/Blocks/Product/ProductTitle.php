<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Settings\Product;
use BagistoPlus\VisualDebut\Blocks\Basic\Heading;

use function BagistoPlus\VisualDebut\_t;

class ProductTitle extends Heading
{
    protected static string $view = 'visual-debut::blocks.product.title';

    protected static string $type = '@visual-debut/product-title';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h12"/><path d="M6 20V4"/><path d="M18 20V4"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        // Get parent settings and filter out the 'text' setting
        $parentSettings = array_filter(
            parent::settings(),
            fn($setting) => !isset($setting->id) || $setting->id !== 'text'
        );

        return array_merge(
            [
                Product::make('product', _t('blocks.common.product_label')),
            ],
            $parentSettings
        );
    }

    protected function getViewData(): array
    {
        return [
            'product' => $this->block->settings->product ?? $this->context['product'] ?? null
        ];
    }
}
