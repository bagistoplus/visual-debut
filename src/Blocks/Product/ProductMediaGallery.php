<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductMediaGallery extends SimpleBlock
{
    protected static string $type = '@visual-debut/product-media-gallery';

    protected static string $view = 'visual-debut::blocks.product.media-gallery';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>';

    protected static string $category = 'Products';

    public static function name(): string
    {
        return _t('blocks.product-media-gallery.name');
    }

    protected function getViewData(): array
    {
        $product = $this->context['product'] ?? null;

        if (! $product) {
            return [
                'medias' => [],
                'images' => [],
                'videos' => [],
                'thumbnailPosition' => 'start',
                'productName' => '',
                ...$this->imageSize(),
            ];
        }

        $images = product_image()->getGalleryImages($product);
        $images = array_map(fn ($image) => array_merge($image, ['type' => 'image']), $images);

        $videos = product_video()->getVideos($product);

        // Get media position from parent section context
        $mediaPosition = $this->context['media_position'] ?? 'left';
        $thumbnailPosition = $mediaPosition === 'right' ? 'end' : 'start';

        return [
            'images' => $images,
            'videos' => $videos,
            'medias' => [...$images, ...$videos],
            'thumbnailPosition' => $thumbnailPosition,
            'productName' => (string) $product->name,
            ...$this->imageSize(),
        ];
    }

    /**
     * Bagisto crops large images to this size (Webkul\Shop\CacheFilters\Large), so the
     * main image's box is known before it loads.
     *
     * @return array{imageWidth: int, imageHeight: int}
     */
    protected function imageSize(): array
    {
        return [
            'imageWidth' => (int) (core()->getConfigData('catalog.products.cache_large_image.width') ?: 560),
            'imageHeight' => (int) (core()->getConfigData('catalog.products.cache_large_image.height') ?: 610),
        ];
    }

    public static function settings(): array
    {
        return [
            Header::make(_t('blocks.product-media-gallery.settings.image_settings_header')),

            Select::make('aspect_ratio', _t('blocks.product-media-gallery.settings.aspect_ratio_label'))
                ->options([
                    'adapt' => _t('blocks.product-media-gallery.settings.aspect_ratio_options.adapt'),
                    'square' => _t('blocks.product-media-gallery.settings.aspect_ratio_options.square'),
                    'portrait' => _t('blocks.product-media-gallery.settings.aspect_ratio_options.portrait'),
                    'landscape' => _t('blocks.product-media-gallery.settings.aspect_ratio_options.landscape'),
                ])
                ->default('adapt'),

            Checkbox::make('constrain_to_viewport', _t('blocks.product-media-gallery.settings.constrain_to_viewport_label'))
                ->default(true)
                ->info(_t('blocks.product-media-gallery.settings.constrain_to_viewport_info')),

            Select::make('media_fit', _t('blocks.product-media-gallery.settings.media_fit_label'))
                ->options([
                    'contain' => _t('blocks.product-media-gallery.settings.media_fit_options.contain'),
                    'cover' => _t('blocks.product-media-gallery.settings.media_fit_options.cover'),
                ])
                ->default('contain'),

            Checkbox::make('zoom', _t('blocks.product-media-gallery.settings.zoom_label'))
                ->default(true)
                ->info(_t('blocks.product-media-gallery.settings.zoom_info')),

            Header::make(_t('blocks.product-media-gallery.settings.layout_header')),

            Checkbox::make('sticky', _t('blocks.product-media-gallery.settings.sticky_label'))
                ->default(true)
                ->info(_t('blocks.product-media-gallery.settings.sticky_info')),
        ];
    }
}
