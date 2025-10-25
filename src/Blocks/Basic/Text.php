<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Color;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text as SettingsText;
use BagistoPlus\Visual\Support\Preset;

use function BagistoPlus\VisualDebut\_t;

class Text extends SimpleBlock
{
    protected static string $type = '@visual-debut/text';

    protected static string $view = 'visual-debut::blocks.basic.text';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 6.1H3"/><path d="M21 12.1H3"/><path d="M15.1 18H3"/></svg>';

    protected static string $category = 'Basic';

    public static function textSettings(): array
    {
        return [
            SettingsText::make('text', _t('blocks.text.settings.text_label'))
                ->default('Add your text here'),
        ];
    }

    public static function stylingSettings(): array
    {
        return [
            Header::make(_t('blocks.text.settings.layout_header')),

            Select::make('width', _t('blocks.text.settings.width_label'))
                ->options([
                    'fit-content' => _t('blocks.text.settings.width_options.fit'),
                    '100%' => _t('blocks.text.settings.width_options.fill'),
                ])
                ->asSegment()
                ->default('fit-content'),

            Select::make('max_width', _t('blocks.text.settings.max_width_label'))
                ->options([
                    'narrow' => _t('blocks.text.settings.max_width_options.narrow'),
                    'normal' => _t('blocks.text.settings.max_width_options.normal'),
                    'none' => _t('blocks.text.settings.max_width_options.none'),
                ])
                ->default('normal'),

            Select::make('alignment', _t('blocks.text.settings.alignment_label'))
                ->options([
                    'left' => _t('blocks.text.settings.alignment_options.left'),
                    'center' => _t('blocks.text.settings.alignment_options.center'),
                    'right' => _t('blocks.text.settings.alignment_options.right'),
                ])
                ->default('left')
                ->visibleWhen(fn($rule) => $rule->when('width', '100%')),

            Header::make(_t('blocks.text.settings.typography_header')),

            Select::make('type_preset', _t('blocks.text.settings.type_preset_label'))
                ->options([
                    'paragraph' => _t('blocks.text.settings.type_preset_options.paragraph'),
                    'h1' => _t('blocks.text.settings.type_preset_options.h1'),
                    'h2' => _t('blocks.text.settings.type_preset_options.h2'),
                    'h3' => _t('blocks.text.settings.type_preset_options.h3'),
                    'h4' => _t('blocks.text.settings.type_preset_options.h4'),
                    'h5' => _t('blocks.text.settings.type_preset_options.h5'),
                    'h6' => _t('blocks.text.settings.type_preset_options.h6'),
                    'custom' => _t('blocks.text.settings.type_preset_options.custom'),
                ])
                ->default('paragraph')
                ->info(_t('blocks.text.settings.type_preset_info')),

            Select::make('font', _t('blocks.text.settings.font_label'))
                ->options([
                    'font-body' => _t('blocks.text.settings.font_options.body'),
                    'font-subheading' => _t('blocks.text.settings.font_options.subheading'),
                    'font-heading' => _t('blocks.text.settings.font_options.heading'),
                    'font-accent' => _t('blocks.text.settings.font_options.accent'),
                ])
                ->default('font-body')
                ->visibleWhen(fn($rule) => $rule->when('type_preset', 'custom')),

            Select::make('font_size', _t('blocks.text.settings.font_size_label'))
                ->options([
                    '' => _t('blocks.text.settings.font_size_options.default'),
                    'text-xs' => '12px (xs)',
                    'text-sm' => '14px (sm)',
                    'text-base' => '16px (base)',
                    'text-lg' => '18px (lg)',
                    'text-xl' => '20px (xl)',
                    'text-2xl' => '24px (2xl)',
                    'text-3xl' => '30px (3xl)',
                    'text-4xl' => '36px (4xl)',
                    'text-5xl' => '48px (5xl)',
                    'text-6xl' => '60px (6xl)',
                    'text-7xl' => '72px (7xl)',
                    'text-8xl' => '96px (8xl)',
                    'text-9xl' => '128px (9xl)',
                ])
                ->default('')
                ->visibleWhen(fn($rule) => $rule->when('type_preset', 'custom')),

            Select::make('line_height', _t('blocks.text.settings.line_height_label'))
                ->options([
                    'tight' => _t('blocks.text.settings.line_height_options.tight'),
                    'normal' => _t('blocks.text.settings.line_height_options.normal'),
                    'loose' => _t('blocks.text.settings.line_height_options.loose'),
                ])
                ->default('normal')
                ->visibleWhen(fn($rule) => $rule->when('type_preset', 'custom')),

            Select::make('letter_spacing', _t('blocks.text.settings.letter_spacing_label'))
                ->options([
                    'tight' => _t('blocks.text.settings.letter_spacing_options.tight'),
                    'normal' => _t('blocks.text.settings.letter_spacing_options.normal'),
                    'loose' => _t('blocks.text.settings.letter_spacing_options.loose'),
                ])
                ->default('normal')
                ->visibleWhen(fn($rule) => $rule->when('type_preset', 'custom')),

            Select::make('case', _t('blocks.text.settings.case_label'))
                ->options([
                    'none' => _t('blocks.text.settings.case_options.none'),
                    'uppercase' => _t('blocks.text.settings.case_options.uppercase'),
                ])
                ->default('none')
                ->visibleWhen(fn($rule) => $rule->when('type_preset', 'custom')),

            Select::make('wrap', _t('blocks.text.settings.wrap_label'))
                ->options([
                    'pretty' => _t('blocks.text.settings.wrap_options.pretty'),
                    'balance' => _t('blocks.text.settings.wrap_options.balance'),
                    'nowrap' => _t('blocks.text.settings.wrap_options.nowrap'),
                ])
                ->default('pretty')
                ->visibleWhen(fn($rule) => $rule->when('type_preset', 'custom')),

            Header::make(_t('blocks.text.settings.appearance_header')),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            Select::make('color', _t('blocks.text.settings.color_label'))
                ->options([
                    'default' => _t('blocks.text.settings.color_options.default'),
                    'primary' => _t('blocks.text.settings.color_options.primary'),
                    'secondary' => _t('blocks.text.settings.color_options.secondary'),
                    'accent' => _t('blocks.text.settings.color_options.accent'),
                    'info' => _t('blocks.text.settings.color_options.info'),
                    'success' => _t('blocks.text.settings.color_options.success'),
                    'warning' => _t('blocks.text.settings.color_options.warning'),
                    'danger' => _t('blocks.text.settings.color_options.danger'),
                    'custom' => _t('blocks.text.settings.color_options.custom'),
                ])
                ->default('default'),

            Color::make('text_color', _t('blocks.text.settings.text_color_label'))
                ->default('#000000FF')
                ->visibleWhen(fn($rule) => $rule->when('color', 'custom')),

            Header::make(_t('blocks.text.settings.padding_header')),

            Range::make('padding_block_start', _t('blocks.text.settings.padding_top_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_block_end', _t('blocks.text.settings.padding_bottom_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_inline_start', _t('blocks.text.settings.padding_left_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_inline_end', _t('blocks.text.settings.padding_right_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),
        ];
    }

    public static function settings(): array
    {
        return array_merge(
            static::textSettings(),
            static::stylingSettings()
        );
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.text.presets.text.name'))
                ->category(_t('blocks.text.presets.text.category'))
                ->settings([
                    'text' => '<p>We make things that work better and last longer. Our products solve real problems with clean design and honest materials.</p>',
                ]),

            Preset::make(_t('blocks.text.presets.heading.name'))
                ->category(_t('blocks.text.presets.heading.category'))
                ->settings([
                    'text' => '<h2>New arrivals</h2>',
                ]),
        ];
    }
}
