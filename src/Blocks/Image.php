<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Image as ImageSetting;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Support\Preset;

use function BagistoPlus\VisualDebut\_t;

class Image extends BladeBlock
{
    protected static string $type = '@visual-debut/image';

    protected static string $view = 'visual-debut::blocks.image';
    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>';
    protected static string $category = 'Media';

    public static function settings(): array
    {
        return [
            ImageSetting::make('image', _t('blocks.image.settings.image_label')),

            Link::make('link', _t('blocks.image.settings.link_label')),

            Header::make(_t('blocks.image.settings.size_header')),

            Select::make('image_ratio', _t('blocks.image.settings.image_ratio_label'))
                ->options([
                    'adapt' => _t('blocks.image.settings.image_ratio_options.adapt'),
                    'portrait' => _t('blocks.image.settings.image_ratio_options.portrait'),
                    'square' => _t('blocks.image.settings.image_ratio_options.square'),
                    'landscape' => _t('blocks.image.settings.image_ratio_options.landscape'),
                ])
                ->default('adapt'),

            Select::make('width', _t('blocks.image.settings.width_label'))
                ->options([
                    'fit-content' => _t('blocks.image.settings.width_options.fit_content'),
                    'fill' => _t('blocks.image.settings.width_options.fill'),
                    'custom' => _t('blocks.image.settings.width_options.custom'),
                ])
                ->default('fill'),

            Range::make('custom_width', _t('blocks.image.settings.custom_width_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(100)
                ->unit('%'),

            Select::make('width_mobile', _t('blocks.image.settings.width_mobile_label'))
                ->options([
                    'fit-content' => _t('blocks.image.settings.width_mobile_options.fit_content'),
                    'fill' => _t('blocks.image.settings.width_mobile_options.fill'),
                    'custom' => _t('blocks.image.settings.width_mobile_options.custom'),
                ])
                ->default('fill'),

            Range::make('custom_width_mobile', _t('blocks.image.settings.custom_width_mobile_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(100)
                ->unit('%'),

            Select::make('height', _t('blocks.image.settings.height_label'))
                ->options([
                    'fit' => _t('blocks.image.settings.height_options.fit'),
                    'fill' => _t('blocks.image.settings.height_options.fill'),
                ])
                ->default('fit'),

            Header::make(_t('blocks.image.settings.borders_header')),

            Select::make('border', _t('blocks.image.settings.border_label'))
                ->options([
                    'none' => _t('blocks.image.settings.border_options.none'),
                    'solid' => _t('blocks.image.settings.border_options.solid'),
                ])
                ->default('none'),

            Range::make('border_width', _t('blocks.image.settings.border_width_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(1)
                ->unit('px'),

            Range::make('border_opacity', _t('blocks.image.settings.border_opacity_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(100)
                ->unit('%'),

            Range::make('border_radius', _t('blocks.image.settings.border_radius_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),

            Header::make(_t('blocks.image.settings.padding_header')),

            Range::make('padding_block_start', _t('blocks.image.settings.padding_top_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),

            Range::make('padding_block_end', _t('blocks.image.settings.padding_bottom_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),

            Range::make('padding_inline_start', _t('blocks.image.settings.padding_left_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),

            Range::make('padding_inline_end', _t('blocks.image.settings.padding_right_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.image.presets.image.name'))
                ->category(_t('blocks.image.presets.image.category'))
                ->settings([
                    'image_ratio' => 'adapt',
                ]),
        ];
    }

}
