<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Link as LinkSetting;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text as TextSetting;
use BagistoPlus\Visual\Support\Preset;

use function BagistoPlus\VisualDebut\_t;

class Link extends SimpleBlock
{
    protected static string $type = '@visual-debut/link';

    protected static string $view = 'visual-debut::blocks.basic.link';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>';

    protected static string $category = 'Basic';

    public static function settings(): array
    {
        return [
            TextSetting::make('text', _t('blocks.link.settings.text_label'))
                ->default('Link'),

            LinkSetting::make('url', _t('blocks.link.settings.url_label'))
                ->default('/'),

            Checkbox::make('open_in_new_tab', _t('blocks.link.settings.open_in_new_tab_label'))
                ->default(false),

            Header::make(_t('blocks.link.settings.typography_header')),

            Select::make('type_preset', _t('blocks.link.settings.type_preset_label'))
                ->options([
                    'paragraph' => _t('blocks.link.settings.type_preset_options.paragraph'),
                    'h1' => _t('blocks.link.settings.type_preset_options.h1'),
                    'h2' => _t('blocks.link.settings.type_preset_options.h2'),
                    'h3' => _t('blocks.link.settings.type_preset_options.h3'),
                    'h4' => _t('blocks.link.settings.type_preset_options.h4'),
                    'h5' => _t('blocks.link.settings.type_preset_options.h5'),
                    'h6' => _t('blocks.link.settings.type_preset_options.h6'),
                    'custom' => _t('blocks.link.settings.type_preset_options.custom'),
                ])
                ->default('paragraph')
                ->info(_t('blocks.link.settings.type_preset_info')),

            Select::make('font_size', _t('blocks.link.settings.font_size_label'))
                ->options([
                    'text-xs' => '12px (xs)',
                    'text-sm' => '14px (sm)',
                    'text-base' => '16px (base)',
                    'text-lg' => '18px (lg)',
                    'text-xl' => '20px (xl)',
                ])
                ->default('text-base')
                ->visibleWhen(fn($rule) => $rule->when('type_preset', 'custom')),

            Select::make('font_weight', _t('blocks.link.settings.font_weight_label'))
                ->options([
                    'font-normal' => _t('blocks.link.settings.font_weight_options.normal'),
                    'font-medium' => _t('blocks.link.settings.font_weight_options.medium'),
                    'font-semibold' => _t('blocks.link.settings.font_weight_options.semibold'),
                    'font-bold' => _t('blocks.link.settings.font_weight_options.bold'),
                ])
                ->default('font-normal')
                ->visibleWhen(fn($rule) => $rule->when('type_preset', 'custom')),

            Header::make(_t('blocks.link.settings.appearance_header')),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            Select::make('underline', _t('blocks.link.settings.underline_label'))
                ->options([
                    'none' => _t('blocks.link.settings.underline_options.none'),
                    'hover' => _t('blocks.link.settings.underline_options.hover'),
                    'always' => _t('blocks.link.settings.underline_options.always'),
                ])
                ->default('hover'),

            Header::make(_t('blocks.link.settings.spacing_header')),

            Range::make('padding_block_start', _t('blocks.link.settings.padding_top_label'))
                ->min(0)->max(24)->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_block_end', _t('blocks.link.settings.padding_bottom_label'))
                ->min(0)->max(24)->step(1)
                ->default(0)
                ->responsive(),
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.link.presets.link.name'))
                ->category(_t('blocks.link.presets.link.category'))
                ->settings([
                    'text' => 'Link',
                    'url' => '/',
                ]),
        ];
    }
}
