<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\Cart\AddProductToCart;
use BagistoPlus\Visual\Sections\LivewireSection;
use BagistoPlus\VisualDebut\Enums\Events;
use BagistoPlus\VisualDebut\Sections\Schemas\ProductDetailsSchema;
use Illuminate\Http\UploadedFile;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Webkul\Product\Helpers\ProductType;
use Webkul\Product\Helpers\Review;

use function BagistoPlus\VisualDebut\_t;

class ProductDetails extends LivewireSection
{
    use WithFileUploads;

    protected static array $enabledOn = ['product'];

    protected static string $view = 'shop::sections.product-details';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/product-details.png';

    public int $quantity = 1;

    public array $variantAttributes = [];

    public $selectedVariant;

    public array $groupedProductQuantities = [];

    public array $bundleProductOptions = [];

    public array $bundleProductQuantities = [];

    public array $customizableOptions = [];

    public array $links = [];

    public function boot(): void
    {
        $this->registerCustomizableOptionsValidationAttributes();
    }

    public function mount(): void
    {
        $this->initializeGroupedProductQuantities();
        $this->initializeBundleProductOptions();
        $this->initializeCustomizableOptions();
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
     * Register validation attribute translations for customizable options.
     */
    protected function registerCustomizableOptionsValidationAttributes(): void
    {
        $product = $this->context['product'] ?? null;

        if (! $product || ! $product->getTypeInstance()->isCustomizable()) {
            return;
        }

        $options = $product->customizable_options()->get();
        $validationAttributes = [];

        foreach ($options as $option) {
            $validationAttributes["validation.attributes.customizableOptions.{$option->id}"] = $option->label;
        }

        app('translator')->addLines($validationAttributes, app()->getLocale());
    }

    /**
     * Initialize customizable options with proper data types.
     */
    public function initializeCustomizableOptions(): void
    {
        $product = $this->context['product'];

        if (! $product->getTypeInstance()->isCustomizable()) {
            return;
        }

        $options = $product
            ->customizable_options()
            ->with(['customizable_option_prices'])
            ->get();

        foreach ($options as $option) {
            $isMultiValue = in_array($option->type, ['checkbox', 'multiselect']);
            $this->customizableOptions[$option->id] = $isMultiValue ? [] : null;
        }
    }

    /**
     * Validate required customizable options before adding to cart.
     */
    protected function validateRequiredCustomizableOptions(): void
    {
        $product = $this->context['product'];

        if (! $product->getTypeInstance()->isCustomizable()) {
            return;
        }

        $options = $product->customizable_options()->get();
        $rules = [];
        $messages = [];

        foreach ($options as $option) {
            if ($option->is_required) {
                $fieldName = "customizableOptions.{$option->id}";

                if (in_array($option->type, ['checkbox', 'multiselect'])) {
                    $rules[$fieldName] = ['required', 'array', 'min:1'];
                    $messages["{$fieldName}.required"] = trans('visual-debut::shop.product.option-required', ['option' => $option->label]);
                    $messages["{$fieldName}.min"] = trans('visual-debut::shop.product.option-required', ['option' => $option->label]);
                } else {
                    $rules[$fieldName] = ['required'];
                    $messages["{$fieldName}.required"] = trans('visual-debut::shop.product.option-required', ['option' => $option->label]);
                }
            }
        }

        if (! empty($rules)) {
            $this->validate($rules, $messages);
        }
    }

    /**
     * Validate customizable option when updated (real-time validation).
     */
    public function updatedCustomizableOptions($value, $key): void
    {
        if (! $value) {
            return;
        }

        $product = $this->context['product'];
        $option = $product->customizable_options()->find($key);

        if ($option && $option->type === 'file' && $option->supported_file_extensions) {
            $extensions = array_map('trim', explode(',', $option->supported_file_extensions));

            $this->validate([
                "customizableOptions.{$key}" => ['file', 'mimes:' . implode(',', $extensions)],
            ]);
        }
    }

    /**
     * Transform customizable options, converting Livewire temporary files to Laravel UploadedFile
     * and wrapping all values in arrays as expected by Bagisto.
     */
    protected function transformCustomizableOptions(array $options): array
    {
        return collect($options)->map(function ($value) {
            if ($value instanceof TemporaryUploadedFile) {
                $value = new UploadedFile(
                    $value->getRealPath(),
                    $value->getClientOriginalName(),
                    $value->getMimeType(),
                    $value->getError(),
                    true // Mark as test file to avoid validation issues
                );
            }

            return is_array($value) ? $value : [$value];
        })->toArray();
    }

    /**
     * Add the product to the cart.
     */
    public function addToCart(bool $buyNow = false): void
    {
        $product = $this->context['product'];

        $this->validateRequiredCustomizableOptions();

        $cartParams = [
            'product_id' => $product->id,
            'quantity' => $this->quantity,
            'is_buy_now' => $buyNow ? 1 : 0,
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

        // Add downloadable product links if present
        if (! empty($this->links)) {
            $cartParams = array_merge($cartParams, ['links' => $this->links]);
        }

        // Add customizable options if present
        if (! empty($this->customizableOptions)) {
            $transformedOptions = $this->transformCustomizableOptions($this->customizableOptions);
            $cartParams = array_merge($cartParams, ['customizable_options' => $transformedOptions]);
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
     *
     * @return mixed
     */
    public function getVideos()
    {
        return product_video()->getVideos($this->context['product']);
    }

    /**
     * Get blocks to display on the right side.
     */
    public function getBlocksOnRight(): array
    {
        return collect($this->section->blocks)
            ->reject(fn($block) => $block->settings->position === 'under_gallery')
            ->all();
    }

    /**
     * Get blocks to display below the gallery.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getBlocksOnBottom()
    {
        return collect($this->section->blocks)
            ->filter(fn($block) => $block->settings->position === 'under_gallery');
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
            'blocksOnRight' => $this->getBlocksOnRight(),
            'blocksOnBottom' => $this->getBlocksOnBottom(),
        ];
    }

    public static function name(): string
    {
        return _t('product-details.name');
    }

    public static function description(): string
    {
        return _t('product-details.description');
    }

    public static function settings(): array
    {
        return ProductDetailsSchema::settings();
    }

    public static function blocks(): array
    {
        return ProductDetailsSchema::blocks();
    }

    public static function default(): array
    {
        return ProductDetailsSchema::default();
    }
}
