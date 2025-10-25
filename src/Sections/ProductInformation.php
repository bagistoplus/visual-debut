<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\Cart\AddProductToCart;
use BagistoPlus\Visual\Blocks\LivewireSection;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\VisualDebut\Blocks\Product\ProductMediaGallery;
use BagistoPlus\VisualDebut\Blocks\Product\ProductDetails;
use BagistoPlus\VisualDebut\Enums\Events;
use Webkul\Product\Helpers\ProductType;
use Webkul\Product\Helpers\Review;

use function BagistoPlus\VisualDebut\_t;

class ProductInformation extends LivewireSection
{
    protected static string $type = '@visual-debut/product-information';

    protected static array $enabledOn = [
        'templates' => ['product'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.product-information';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>';

    protected static string $category = 'Products';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/product-details.png';

    protected static array $accepts = [
        ProductMediaGallery::class,
        ProductDetails::class,
    ];

    public int $quantity = 1;

    public array $variantAttributes = [];

    public $selectedVariant;

    public array $groupedProductQuantities = [];

    public array $bundleProductOptions = [];

    public array $bundleProductQuantities = [];

    public array $links = [];

    public static function name(): string
    {
        return _t('sections.product-information.name');
    }

    public static function description(): string
    {
        return _t('sections.product-information.description');
    }

    public static function settings(): array
    {
        return [
            Header::make(_t('sections.product-information.settings.layout_header')),

            Select::make('section_width', _t('sections.product-information.settings.section_width_label'))
                ->options([
                    'container' => _t('sections.product-information.settings.section_width_options.container'),
                    'full-width' => _t('sections.product-information.settings.section_width_options.full_width'),
                ])
                ->default('container'),

            Select::make('media_position', _t('sections.product-information.settings.media_position_label'))
                ->options([
                    'left' => _t('sections.product-information.settings.media_position_options.left'),
                    'right' => _t('sections.product-information.settings.media_position_options.right'),
                ])
                ->default('left'),

            Checkbox::make('equal_columns', _t('sections.product-information.settings.equal_columns_label'))
                ->default(false)
                ->info(_t('sections.product-information.settings.equal_columns_info')),

            Range::make('gap', _t('sections.product-information.settings.gap_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(12)
                ->info(_t('sections.product-information.settings.gap_info')),

            Header::make(_t('sections.product-information.settings.appearance_header')),

            ColorScheme::make('color_scheme', _t('sections.common.color_scheme_label'))
                ->info(_t('sections.common.color_scheme_info')),

            Header::make(_t('sections.product-information.settings.padding_header')),

            Range::make('padding_top', _t('sections.product-information.settings.padding_top_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(8),

            Range::make('padding_bottom', _t('sections.product-information.settings.padding_bottom_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(8),
        ];
    }

    public function mount(): void
    {
        $this->initializeGroupedProductQuantities();
        $this->initializeBundleProductOptions();
    }

    /**
     * Initialize quantities for grouped products.
     */
    public function initializeGroupedProductQuantities(): void
    {
        $product = $this->context['product'];
        if ($product->type !== 'grouped') {
            return;
        }

        $this->groupedProductQuantities = $product->grouped_products
            ->mapWithKeys(fn($groupedProduct) => [$groupedProduct->associated_product->id => $groupedProduct->qty])
            ->all();
    }

    /**
     * Initialize bundle product options and their default quantities.
     */
    public function initializeBundleProductOptions(): void
    {
        $product = $this->context['product'];
        if ($product->type !== 'bundle') {
            return;
        }

        $bundleConfig = app('Webkul\Product\Helpers\BundleOption')->getBundleConfig($product);

        $this->bundleProductOptions = collect($bundleConfig['options'])
            ->mapWithKeys(fn($bundleOption) => [
                $bundleOption['id'] => collect($bundleOption['products'])
                    ->filter(fn($p) => $p['is_default'])
                    ->map(fn($p) => $p['id'])
                    ->all(),
            ])
            ->all();

        $this->bundleProductQuantities = collect($bundleConfig['options'])
            ->filter(fn($bundleOption) => in_array($bundleOption['type'], ['select', 'radio']))
            ->mapWithKeys(fn($bundleOption) => [
                $bundleOption['id'] => collect($bundleOption['products'])
                    ->filter(fn($p) => $p['is_default'])
                    ->map(fn($p) => $p['qty'])
                    ->first(),
            ])
            ->all();
    }

    /**
     * Add the product to the cart.
     */
    public function addToCart(bool $buyNow = false): void
    {
        $product = $this->context['product'];

        // Build the basic cart parameters
        $cartParams = [
            'product_id' => $product->id,
            'quantity' => $this->quantity,
            'is_buy_now' => $buyNow,
        ];

        // Add configurable options if present
        if (! empty($this->variantAttributes)) {
            $cartParams = array_merge($cartParams, [
                'super_attributes' => $this->variantAttributes,
                'selected_configurable_option' => $this->selectedVariant,
            ]);
        }

        // Add grouped product quantities if present
        if (! empty($this->groupedProductQuantities)) {
            $cartParams = array_merge($cartParams, ['qty' => $this->groupedProductQuantities]);
        }

        // Add bundle product options and quantities if present
        if (! empty($this->bundleProductOptions) && ! empty($this->bundleProductQuantities)) {
            $cartParams = array_merge($cartParams, [
                'bundle_options' => collect($this->bundleProductOptions)->filter()->all(),
                'bundle_option_qty' => $this->bundleProductQuantities,
            ]);
        }

        // Add downloadable links if present
        if (! empty($this->links)) {
            $cartParams = array_merge($cartParams, ['links' => $this->links]);
        }

        $result = app(AddProductToCart::class)->execute($cartParams);

        if ($result['success']) {
            session()->flash('success', $result['message']);
            $this->dispatch(Events::CART_UPDATED);

            if (! empty($result['redirect_url'])) {
                $this->redirect($result['redirect_url']);
            }
        } else {
            session()->flash('error', $result['message']);
            $this->redirect($result['redirect_url']);
        }
    }

    /**
     * Shortcut to add the product to cart as buy now.
     */
    public function buyNow(): void
    {
        $this->addToCart(buyNow: true);
    }

    /**
     * Get gallery images for the product.
     */
    public function getImages(): array
    {
        $images = product_image()->getGalleryImages($this->context['product']);

        return array_map(fn($image) => array_merge($image, ['type' => 'image']), $images);
    }

    /**
     * Get videos for the product.
     */
    public function getVideos()
    {
        return product_video()->getVideos($this->context['product']);
    }

    /**
     * Share data with child blocks.
     */
    public function share(): array
    {
        return [
            'media_position' => $this->section->settings->media_position ?? 'left',
        ];
    }

    /**
     * Prepare data to pass to the view.
     */
    public function getViewData(): array
    {
        $product = $this->context['product'];
        $images = $this->getImages();
        $videos = $this->getVideos();
        $reviewHelper = app(Review::class);

        return [
            'images' => $images,
            'videos' => $videos,
            'medias' => [...$images, ...$videos],
            'totalReviews' => $reviewHelper->getTotalReviews($product),
            'averageRating' => $reviewHelper->getAverageRating($product),
            'hasVariants' => ProductType::hasVariants($product->type),
            'showQuantitySelector' => $product->getTypeInstance()->showQuantityBox(),
        ];
    }

    public static function default(): array
    {
        return [
            'settings' => [
                'section_width' => 'container',
                'media_position' => 'left',
                'equal_columns' => false,
                'gap' => 12,
                'padding_top' => 8,
                'padding_bottom' => 8,
            ],
        ];
    }
}
