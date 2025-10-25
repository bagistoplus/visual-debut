<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Support\Preset;

use function BagistoPlus\VisualDebut\_t;

class Button extends SimpleBlock
{
    protected static string $type = '@visual-debut/button';

    protected static string $view = 'visual-debut::blocks.basic.button';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="12" x="2" y="6" rx="2"/><circle cx="12" cy="12" r="2"/></svg>';

    protected static string $category = 'Basic';

    public static function settings(): array
    {
        return [
            Text::make('label', _t('blocks.button.settings.label_label'))
                ->default('Button')
                ->visibleWhen(fn($rule) => $rule->whenFalsy('circle')->whenFalsy('square')),

            Link::make('link', _t('blocks.button.settings.link_label'))
                ->default('/'),

            Checkbox::make('open_in_new_tab', _t('blocks.button.settings.open_in_new_tab_label'))
                ->default(false),

            Select::make('style_class', _t('blocks.button.settings.style_class_label'))
                ->options([
                    'button' => _t('blocks.button.settings.style_class_options.button'),
                    'outline' => _t('blocks.button.settings.style_class_options.outline'),
                    'link' => _t('blocks.button.settings.style_class_options.link'),
                ])
                ->default('button'),

            Select::make('size', _t('blocks.button.settings.size_label'))
                ->options([
                    'sm' => _t('blocks.button.settings.size_options.sm'),
                    'md' => _t('blocks.button.settings.size_options.md'),
                    'lg' => _t('blocks.button.settings.size_options.lg'),
                    'xl' => _t('blocks.button.settings.size_options.xl'),
                ])
                ->default('md'),

            Select::make('color', _t('blocks.button.settings.color_label'))
                ->options([
                    'primary' => _t('blocks.button.settings.color_options.primary'),
                    'secondary' => _t('blocks.button.settings.color_options.secondary'),
                    'success' => _t('blocks.button.settings.color_options.success'),
                    'danger' => _t('blocks.button.settings.color_options.danger'),
                    'warning' => _t('blocks.button.settings.color_options.warning'),
                    'info' => _t('blocks.button.settings.color_options.info'),
                ])
                ->default('primary'),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            Icon::make('icon', _t('blocks.button.settings.icon_label'))
                ->info(_t('blocks.button.settings.icon_info')),

            Checkbox::make('circle', _t('blocks.button.settings.circle_label'))
                ->info(_t('blocks.button.settings.circle_info'))
                ->default(false),

            Checkbox::make('square', _t('blocks.button.settings.square_label'))
                ->info(_t('blocks.button.settings.square_info'))
                ->default(false),

            Checkbox::make('block', _t('blocks.button.settings.block_label'))
                ->info(_t('blocks.button.settings.block_info'))
                ->default(false),

            Select::make('width', _t('blocks.button.settings.width_label'))
                ->options([
                    'fit-content' => _t('blocks.button.settings.width_options.fit_content'),
                    'custom' => _t('blocks.button.settings.width_options.custom'),
                ])
                ->default('fit-content')
                ->visibleWhen(fn($rule) => $rule->whenFalsy('block')->whenFalsy('circle')->whenFalsy('square')),

            Range::make('custom_width', _t('blocks.button.settings.custom_width_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(100)
                ->unit('%')
                ->visibleWhen(fn($rule) => $rule->when('width', 'custom')->whenFalsy('block')->whenFalsy('circle')->whenFalsy('square')),

            Select::make('width_mobile', _t('blocks.button.settings.width_mobile_label'))
                ->options([
                    'fit-content' => _t('blocks.button.settings.width_mobile_options.fit_content'),
                    'custom' => _t('blocks.button.settings.width_mobile_options.custom'),
                ])
                ->default('fit-content')
                ->visibleWhen(fn($rule) => $rule->whenFalsy('block')->whenFalsy('circle')->whenFalsy('square')),

            Range::make('custom_width_mobile', _t('blocks.button.settings.custom_width_mobile_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(100)
                ->unit('%')
                ->visibleWhen(fn($rule) => $rule->when('width_mobile', 'custom')->whenFalsy('block')->whenFalsy('circle')->whenFalsy('square')),
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.button.presets.button.name'))
                ->category(_t('blocks.button.presets.button.category'))
                ->settings([
                    'label' => 'Shop now',
                    'link' => '/collections/all',
                    'style_class' => 'button',
                ]),
        ];
    }
}
