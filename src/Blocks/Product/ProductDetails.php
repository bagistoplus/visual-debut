<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\VisualDebut\Blocks;

use function BagistoPlus\VisualDebut\_t;

class ProductDetails extends BladeBlock
{
    protected static string $type = '@visual-debut/product-details';

    protected static string $view = 'visual-debut::blocks.product.product-details';

    protected static array $accepts = [
        // Product-specific blocks
        Blocks\Product\ProductTitle::class,
        Blocks\Product\ProductPrice::class,
        Blocks\Product\ProductRating::class,
        Blocks\Product\ProductShortDescription::class,
        Blocks\Product\ProductQuantitySelector::class,
        Blocks\Product\ProductBuyButtons::class,
        Blocks\Product\ProductDescription::class,
        Blocks\Product\ProductVariantPicker::class,
        Blocks\Product\ProductGroupedOptions::class,
        Blocks\Product\ProductBundleOptions::class,
        Blocks\Product\ProductDownloadableOptions::class,

        // Generic layout blocks
        Blocks\Container::class,
        Blocks\Accordion::class,
        Blocks\AccordionRow::class,
        Blocks\Basic\Divider::class,
        Blocks\Basic\Heading::class,
        Blocks\Basic\Text::class,
        Blocks\Basic\RichText::class,
        Blocks\Basic\Button::class,
        Blocks\Basic\Icon::class,
    ];

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>';

    protected static string $category = 'Products';

    public static function settings(): array
    {
        return [
            Header::make(_t('blocks.product-details.settings.layout_header')),

            Range::make('gap', _t('blocks.product-details.settings.gap_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(6)
                ->info(_t('blocks.product-details.settings.gap_info')),

            Checkbox::make('sticky', _t('blocks.product-details.settings.sticky_label'))
                ->default(false)
                ->info(_t('blocks.product-details.settings.sticky_info')),

            Header::make(_t('blocks.product-details.settings.spacing_header')),

            Range::make('padding_top', _t('blocks.product-details.settings.padding_top_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0),

            Range::make('padding_bottom', _t('blocks.product-details.settings.padding_bottom_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0),

            Range::make('padding_left', _t('blocks.product-details.settings.padding_left_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0),

            Range::make('padding_right', _t('blocks.product-details.settings.padding_right_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0),
        ];
    }
}
