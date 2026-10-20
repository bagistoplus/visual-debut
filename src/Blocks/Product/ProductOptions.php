<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\VisualDebut\Support\BookingOptions;
use Webkul\Product\Helpers\ConfigurableOption;
use Webkul\Product\Helpers\ProductType;

use function BagistoPlus\VisualDebut\_t;

/**
 * The options a shopper picks before buying, for whatever type the product
 * is: one block, so a merchant cannot leave a product type without its picker.
 *
 * It replaces the variant picker and the grouped, bundle, downloadable and
 * customizable options blocks, which stay registered for saved templates.
 */
class ProductOptions extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.product.options';

    protected static string $type = '@visual-debut/product-options';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5"/><circle cx="17" cy="17" r="3"/><circle cx="7" cy="7" r="3"/></svg>';

    protected static string $category = 'Product';

    protected static int $limit = 1;

    protected static bool $private = true;

    public static function name(): string
    {
        return _t('blocks.product-options.name');
    }

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),
        ];
    }

    protected function getViewData(): array
    {
        $product = $this->block->settings->product ?? $this->context['product'] ?? null;

        $optionsType = $product ? static::optionsType($product) : null;

        return array_merge([
            'product' => $product,
            'optionsType' => $optionsType,
            'booking' => $optionsType === 'booking' ? BookingOptions::for($product) : null,
        ], static::variantData($product));
    }

    /**
     * Which options partial the product needs, or null when it has none.
     * A customizable product is simple or virtual, so it never has another.
     */
    public static function optionsType($product): ?string
    {
        return match (true) {
            ProductType::hasVariants($product->type) => 'configurable',
            in_array($product->type, ['grouped', 'bundle', 'downloadable'], true) => $product->type,
            $product->type === 'booking' => BookingOptions::for($product) ? 'booking' : null,
            (bool) $product->getTypeInstance()->isCustomizable() => 'customizable',
            default => null,
        };
    }

    /**
     * What the variant picker needs to switch variants without a request.
     */
    public static function variantData($product): array
    {
        if (! $product || ! ProductType::hasVariants($product->type)) {
            return [
                'hasVariants' => false,
                'variantAttributes' => [],
                'variantPrices' => [],
                'variantImages' => [],
                'variantVideos' => [],
            ];
        }

        $config = app(ConfigurableOption::class)->getConfigurationConfig($product);

        return [
            'hasVariants' => true,
            'variantAttributes' => $config['attributes'] ?? [],
            'variantPrices' => $config['variant_prices'] ?? [],
            'variantImages' => $config['variant_images'] ?? [],
            'variantVideos' => $config['variant_videos'] ?? [],
        ];
    }
}
