<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Presets\ProductCardWithOverlay;
use Illuminate\Support\Collection;

use function BagistoPlus\VisualDebut\_t;

/**
 * The page product's related products or up-sells, in the layouts of the product list.
 */
class ProductRecommendations extends ProductList
{
    protected static string $type = '@visual-debut/product-recommendations';

    protected static array $enabledOn = [
        'templates' => ['product'],
        'regions' => ['main'],
    ];

    protected static array $disabledOn = [];

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><path d="M3 14h7v7H3z"/></svg>';

    public static function name(): string
    {
        return _t('sections.product-recommendations.name');
    }

    public static function description(): string
    {
        return _t('sections.product-recommendations.description');
    }

    /**
     * @return Collection<int, mixed>
     */
    public function getProducts(): Collection
    {
        $product = $this->context('product');

        if (! $product) {
            return collect();
        }

        $relation = $this->section->settings->source === 'up_sells'
            ? $product->up_sells()
            : $product->related_products();

        // Bagisto keeps the links when a product is disabled or hidden, so only list the ones a shopper can open
        return $relation
            ->whereHas('product_flats', fn ($query) => $query
                ->where('status', 1)
                ->where('visible_individually', 1)
                ->where('channel', core()->getCurrentChannelCode())
                ->where('locale', app()->getLocale()))
            ->take($this->limit())
            ->get();
    }

    public static function settings(): array
    {
        $settings = array_filter(
            parent::settings(),
            fn ($setting) => ! in_array($setting->id ?? null, ['parent_category', 'product_type'], true),
        );

        return [
            Select::make('source', _t('sections.product-recommendations.settings.source_label'))
                ->options([
                    'related' => _t('sections.product-recommendations.settings.source_options.related'),
                    'up_sells' => _t('sections.product-recommendations.settings.source_options.up_sells'),
                ])
                ->default('related')
                ->info(_t('sections.product-recommendations.settings.source_info')),

            ...array_values($settings),
        ];
    }

    public static function presets(): array
    {
        return [
            static::recommendationsPreset('related', _t('sections.product-recommendations.presets.related.name'), trans('shop::app.products.view.related-product-title')),
            static::recommendationsPreset('up_sells', _t('sections.product-recommendations.presets.up_sells.name'), trans('shop::app.products.view.up-sell-title')),
        ];
    }

    protected static function recommendationsPreset(string $source, string $name, string $heading): Preset
    {
        return Preset::make($name)
            ->category('Product')
            ->settings([
                'source' => $source,
                'nb_products' => 8,
                'layout_type' => 'carousel',
            ])
            ->blocks([
                PresetBlock::make(Heading::class)
                    ->settings([
                        'text' => $heading,
                        'heading_level' => 'h2',
                        'width' => 'fill',
                        'alignment' => 'center',
                        'typography' => 'heading-2',
                        'padding' => [
                            'top' => 4,
                            'right' => 0,
                            'bottom' => 4,
                            'left' => 0,
                        ],
                    ]),

                ProductCardWithOverlay::asChild()
                    ->id('static-product-card')
                    ->static()
                    ->repeated(),
            ]);
    }
}
