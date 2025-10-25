<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\VisualDebut\Blocks\Basic\Image;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductImage extends Image
{
    protected static string $type = '@visual-debut/product-image';

    protected static string $view = 'visual-debut::blocks.product.image';

    protected static string $category = 'Product';

    public static function settings(): array
    {
        return array_merge(
            [
                ProductSetting::make('product', _t('blocks.common.product_label')),

                Select::make('size', _t('blocks.product-image.settings.size_label'))
                    ->options([
                        'small' => _t('blocks.product-image.settings.size_options.small'),
                        'medium' => _t('blocks.product-image.settings.size_options.medium'),
                        'large' => _t('blocks.product-image.settings.size_options.large'),
                        'original' => _t('blocks.product-image.settings.size_options.original'),
                    ])
                    ->default('medium')
                    ->info(_t('blocks.product-image.settings.size_info')),
            ],
            parent::sizingSettings()
        );
    }

    protected function getViewData(): array
    {
        $product = $this->block->settings->product ?? $this->context['product'] ?? null;

        if (!$product) {
            return ['image' => null, 'alt' => ''];
        }

        $productResource = (new \Webkul\Shop\Http\Resources\ProductResource($product))->resolve();

        $imageUrl = match ($this->block->settings->size) {
            'small' => $productResource['base_image']['small_image_url'],
            'medium' => $productResource['base_image']['medium_image_url'],
            'large' => $productResource['base_image']['large_image_url'],
            'original' => $productResource['base_image']['original_image_url'],
            default => $productResource['base_image']['medium_image_url'],
        };

        return [
            'image' => $imageUrl,
            'alt' => $productResource['name']
        ];
    }
}
