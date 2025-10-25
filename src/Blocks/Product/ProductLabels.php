<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Product as ProductSetting;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductLabels extends SimpleBlock
{
    protected static string $type = '@visual-debut/product-labels';

    protected static string $view = 'visual-debut::blocks.product.labels';

    protected static string $category = 'Product';

    public static function settings(): array
    {
        return [
            ProductSetting::make('product', _t('blocks.common.product_label')),

            Select::make('layout', _t('blocks.product-labels.settings.layout_label'))
                ->options([
                    'inline' => _t('blocks.product-labels.settings.layout_options.inline'),
                    'stack' => _t('blocks.product-labels.settings.layout_options.stack'),
                ])
                ->default('inline'),

            Range::make('gap', _t('blocks.product-labels.settings.gap_label'))
                ->min(0)
                ->max(8)
                ->step(1)
                ->default(2),

            Select::make('alignment', _t('blocks.product-labels.settings.alignment_label'))
                ->options([
                    'start' => _t('blocks.product-labels.settings.alignment_options.start'),
                    'center' => _t('blocks.product-labels.settings.alignment_options.center'),
                    'end' => _t('blocks.product-labels.settings.alignment_options.end'),
                ])
                ->default('start'),

            Select::make('size', _t('blocks.product-labels.settings.size_label'))
                ->options([
                    'xs' => _t('blocks.product-labels.settings.size_options.xs'),
                    'sm' => _t('blocks.product-labels.settings.size_options.sm'),
                    'md' => _t('blocks.product-labels.settings.size_options.md'),
                    'lg' => _t('blocks.product-labels.settings.size_options.lg'),
                ])
                ->default('sm'),

            Select::make('variant', _t('blocks.product-labels.settings.variant_label'))
                ->options([
                    'solid' => _t('blocks.product-labels.settings.variant_options.solid'),
                    'outline' => _t('blocks.product-labels.settings.variant_options.outline'),
                    'soft' => _t('blocks.product-labels.settings.variant_options.soft'),
                ])
                ->default('solid'),

            Select::make('corner_radius', _t('blocks.product-labels.settings.corner_radius_label'))
                ->options([
                    'none' => _t('blocks.product-labels.settings.corner_radius_options.none'),
                    'sm' => _t('blocks.product-labels.settings.corner_radius_options.sm'),
                    'md' => _t('blocks.product-labels.settings.corner_radius_options.md'),
                    'lg' => _t('blocks.product-labels.settings.corner_radius_options.lg'),
                    'full' => _t('blocks.product-labels.settings.corner_radius_options.full'),
                ])
                ->default('md'),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),
        ];
    }

    protected function getViewData(): array
    {
        $product = $this->block->settings->product ?? $this->context['product'] ?? null;

        if (!$product) {
            return ['labels' => []];
        }

        $productResource = (new \Webkul\Shop\Http\Resources\ProductResource($product))->resolve();

        $labels = [];

        // Add "Sale" label if product is on sale
        if ($productResource['on_sale']) {
            $labels[] = [
                'type' => 'sale',
                'text' => trans('shop::app.components.products.card.sale'),
                'color' => 'danger',
            ];
        }

        // Add "New" label if product is new
        if ($productResource['is_new']) {
            $labels[] = [
                'type' => 'new',
                'text' => trans('shop::app.components.products.card.new'),
                'color' => 'primary',
            ];
        }

        return [
            'labels' => $labels,
        ];
    }
}
