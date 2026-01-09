<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Color;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Spacing;
use BagistoPlus\Visual\Settings\Text as SettingsText;
use BagistoPlus\Visual\Settings\Typography;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\VisualDebut\Tailwind;

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
                    'fill' => _t('blocks.text.settings.width_options.fill'),
                ])
                ->asSegment()
                ->default('fit-content')
                ->responsive(),

            Select::make('max_width', _t('blocks.text.settings.max_width_label'))
                ->options([
                    'narrow' => _t('blocks.text.settings.max_width_options.narrow'),
                    'normal' => _t('blocks.text.settings.max_width_options.normal'),
                    'none' => _t('blocks.text.settings.max_width_options.none'),
                ])
                ->default('none'),

            Select::make('alignment', _t('blocks.text.settings.alignment_label'))
                ->options([
                    'left' => _t('blocks.text.settings.alignment_options.left'),
                    'center' => _t('blocks.text.settings.alignment_options.center'),
                    'right' => _t('blocks.text.settings.alignment_options.right'),
                ])
                ->default('left')
                ->visibleWhen(fn($rule) => $rule->when('width', 'fill'))
                ->responsive(),

            Header::make(_t('blocks.text.settings.typography_header')),

            Typography::make('typography', _t('blocks.text.settings.typography_label'))
                ->info(_t('blocks.text.settings.typography_info')),

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

            Header::make(_t('blocks.common.padding_header')),

            Spacing::make('padding', _t('blocks.common.padding_label'))
                ->responsive()
                ->min(0)
                ->max(24),
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
                ->settings([
                    'text' => 'We make things that work better and last longer. Our products solve real problems with clean design and honest materials.',
                ]),
        ];
    }
}
