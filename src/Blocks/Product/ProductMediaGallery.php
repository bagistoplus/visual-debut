<?php

namespace BagistoPlus\VisualDebut\Blocks\Product;

use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class ProductMediaGallery extends BladeBlock
{
    protected static string $type = '@visual-debut/product-media-gallery';

    protected static string $view = 'visual-debut::blocks.product.media-gallery';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>';

    protected static string $category = 'Products';

    protected function getViewData(): array
    {
        $product = $this->context['product'] ?? null;

        if (!$product) {
            return [
                'medias' => [],
                'images' => [],
                'videos' => [],
                'thumbnailPosition' => 'start',
            ];
        }

        $images = product_image()->getGalleryImages($product);
        $images = array_map(fn($image) => array_merge($image, ['type' => 'image']), $images);

        $videos = product_video()->getVideos($product);

        // Get media position from parent section context
        $mediaPosition = $this->context['media_position'] ?? 'left';
        $thumbnailPosition = $mediaPosition === 'right' ? 'end' : 'start';

        return [
            'images' => $images,
            'videos' => $videos,
            'medias' => [...$images, ...$videos],
            'thumbnailPosition' => $thumbnailPosition,
        ];
    }

    public static function settings(): array
    {
        return [
            Header::make(_t('blocks.product-media-gallery.settings.presentation_header')),

            Select::make('media_presentation', _t('blocks.product-media-gallery.settings.media_presentation_label'))
                ->options([
                    'carousel' => _t('blocks.product-media-gallery.settings.media_presentation_options.carousel'),
                    'grid' => _t('blocks.product-media-gallery.settings.media_presentation_options.grid'),
                ])
                ->default('carousel'),

            Select::make('grid_columns', _t('blocks.product-media-gallery.settings.grid_columns_label'))
                ->options([
                    '1' => '1',
                    '2' => '2',
                ])
                ->default('1')
                ->visibleWhen(fn($rule) => $rule->when('media_presentation', 'grid')),

            Range::make('image_gap', _t('blocks.product-media-gallery.settings.image_gap_label'))
                ->min(0)
                ->max(24)
                ->step(4)
                ->default(8)
                ->unit('px')
                ->visibleWhen(fn($rule) => $rule->when('media_presentation', 'grid')),

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

            Range::make('media_radius', _t('blocks.product-media-gallery.settings.media_radius_label'))
                ->min(0)
                ->max(24)
                ->step(4)
                ->default(0)
                ->unit('px'),

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
