<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Select;
use Webkul\Product\Helpers\Review;

use function BagistoPlus\VisualDebut\_t;

class ProductRating extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.rating';

    protected static string $type = '@visual-debut/product-rating';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('position', _t('blocks.product-rating.settings.position_label'))
                ->options([
                    'right' => _t('blocks.product-rating.settings.position_right'),
                    'under_gallery' => _t('blocks.product-rating.settings.position_under_gallery'),
                ])
                ->default('right'),
        ];
    }


    protected function getViewData(): array
    {
        $reviewHelper = app(Review::class);
        $product = $this->block->settings->product ?? $this->context['product'] ?? null;

        return [
            'product' => $product,
            'totalReviews' => $product ? $reviewHelper->getTotalReviews($product) : 0,
            'averageRating' => $product ? $reviewHelper->getAverageRating($product) : 0
        ];
    }
}
