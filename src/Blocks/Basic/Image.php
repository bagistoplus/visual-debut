<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Image as ImageSetting;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualDebut\_t;

class Image extends SimpleBlock
{
    protected static string $type = '@visual-debut/image';

    protected static string $view = 'visual-debut::blocks.basic.image';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>';

    protected static string $category = 'Basic';

    public static function settings(): array
    {
        return array_merge(
            static::imageSettings(),
            static::sizingSettings()
        );
    }

    protected static function imageSettings(): array
    {
        return [
            ImageSetting::make('image', _t('blocks.image.settings.image_label'))
                ->default(null),

            Text::make('alt', _t('blocks.image.settings.alt_label'))
                ->default('')
                ->info(_t('blocks.image.settings.alt_info')),
        ];
    }

    protected static function sizingSettings(): array
    {
        return [
            // Sizing Header
            Header::make(_t('blocks.image.settings.sizing_header')),

            Select::make('aspect_ratio', _t('blocks.image.settings.aspect_ratio_label'))
                ->options([
                    'adapt' => _t('blocks.image.settings.aspect_ratio_options.adapt'),
                    'square' => _t('blocks.image.settings.aspect_ratio_options.square'),
                    'portrait' => _t('blocks.image.settings.aspect_ratio_options.portrait'),
                    'landscape' => _t('blocks.image.settings.aspect_ratio_options.landscape'),
                ])
                ->default('adapt'),

            Select::make('object_fit', _t('blocks.image.settings.object_fit_label'))
                ->options([
                    'cover' => _t('blocks.image.settings.object_fit_options.cover'),
                    'contain' => _t('blocks.image.settings.object_fit_options.contain'),
                    'fill' => _t('blocks.image.settings.object_fit_options.fill'),
                ])
                ->default('cover'),

            Select::make('width', _t('blocks.image.settings.width_label'))
                ->options([
                    'fit-content' => _t('blocks.image.settings.width_options.fit_content'),
                    'fill' => _t('blocks.image.settings.width_options.fill'),
                    'custom' => _t('blocks.image.settings.width_options.custom'),
                ])
                ->default('fill')
                ->responsive(),

            Range::make('custom_width', _t('blocks.image.settings.custom_width_label'))
                ->min(0)->max(100)->step(1)
                ->default(100)
                ->unit('%')
                ->visibleWhen(fn($rule) => $rule->when('width', 'custom'))
                ->responsive(),

            Select::make('height', _t('blocks.image.settings.height_label'))
                ->options([
                    'fit' => _t('blocks.image.settings.height_options.fit'),
                    'fill' => _t('blocks.image.settings.height_options.fill'),
                ])
                ->default('fit')
                ->visibleWhen(fn($rule) => $rule->when('aspect_ratio', 'adapt')),

            Checkbox::make('hover_zoom', _t('blocks.image.settings.hover_zoom_label'))
                ->default(false)
                ->info(_t('blocks.image.settings.hover_zoom_info')),

            Select::make('hover_zoom_scale', _t('blocks.image.settings.hover_zoom_scale_label'))
                ->options([
                    '100' => '100%',
                    '105' => '105%',
                    '110' => '110%',
                    '125' => '125%',
                    '150' => '150%',
                ])
                ->default('105')
                ->asSegment()
                ->visibleWhen(fn($rule) => $rule->whenTruthy('hover_zoom')),

            // Borders Header
            Header::make(_t('blocks.image.settings.borders_header')),

            Checkbox::make('border', _t('blocks.image.settings.border_label'))
                ->default(false),

            Range::make('border_width', _t('blocks.image.settings.border_width_label'))
                ->min(0)->max(8)->step(1)
                ->default(1)
                ->visibleWhen(fn($rule) => $rule->whenTruthy('border')),

            Range::make('border_opacity', _t('blocks.image.settings.border_opacity_label'))
                ->min(0)->max(100)->step(5)
                ->default(100)
                ->unit('%')
                ->visibleWhen(fn($rule) => $rule->whenTruthy('border')),

            Select::make('border_radius', _t('blocks.image.settings.border_radius_label'))
                ->options([
                    'none' => _t('blocks.image.settings.border_radius_options.none'),
                    'sm' => 'SM',
                    'md' => 'MD',
                    'lg' => 'LG',
                    'xl' => 'XL',
                    '2xl' => '2XL',
                    '3xl' => '3XL',
                    'full' => _t('blocks.image.settings.border_radius_options.full'),
                ])
                ->default('none'),

            // Padding Header (using Tailwind scale 0-24)
            Header::make(_t('blocks.image.settings.padding_header')),

            Range::make('padding_block_start', _t('blocks.image.settings.padding_top_label'))
                ->min(0)->max(24)->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_block_end', _t('blocks.image.settings.padding_bottom_label'))
                ->min(0)->max(24)->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_inline_start', _t('blocks.image.settings.padding_left_label'))
                ->min(0)->max(24)->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_inline_end', _t('blocks.image.settings.padding_right_label'))
                ->min(0)->max(24)->step(1)
                ->default(0)
                ->responsive(),
        ];
    }
}
