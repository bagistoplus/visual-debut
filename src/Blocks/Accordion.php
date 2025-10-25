<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class Accordion extends BladeBlock
{
    protected static string $type = '@visual-debut/accordion';

    protected static string $view = 'visual-debut::blocks.accordion';
    protected static array $accepts = ['@visual-debut/accordion-row'];
    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="7" x="3" y="3" rx="1"/><path d="M9 10h6"/><rect width="18" height="7" x="3" y="14" rx="1"/><path d="M9 17h6"/></svg>';
    protected static string $category = 'Layout';

    public static function settings(): array
    {
        return [
            Select::make('icon', _t('blocks.accordion.settings.icon_label'))
                ->options([
                    'caret' => _t('blocks.accordion.settings.icon_options.caret'),
                    'plus' => _t('blocks.accordion.settings.icon_options.plus'),
                ])
                ->default('caret'),

            Checkbox::make('dividers', _t('blocks.accordion.settings.dividers_label'))
                ->default(true),

            Select::make('type_preset', _t('blocks.accordion.settings.type_preset_label'))
                ->options([
                    '' => _t('blocks.accordion.settings.type_preset_options.default'),
                    'paragraph' => _t('blocks.accordion.settings.type_preset_options.paragraph'),
                    'h1' => _t('blocks.accordion.settings.type_preset_options.h1'),
                    'h2' => _t('blocks.accordion.settings.type_preset_options.h2'),
                    'h3' => _t('blocks.accordion.settings.type_preset_options.h3'),
                    'h4' => _t('blocks.accordion.settings.type_preset_options.h4'),
                    'h5' => _t('blocks.accordion.settings.type_preset_options.h5'),
                    'h6' => _t('blocks.accordion.settings.type_preset_options.h6'),
                ])
                ->default('h5')
                ->info(_t('blocks.accordion.settings.type_preset_info')),

            Checkbox::make('inherit_color_scheme', _t('blocks.accordion.settings.inherit_color_scheme_label'))
                ->default(true),

            // ColorScheme::make('color_scheme', _t('blocks.accordion.settings.color_scheme_label'))
            //     ->default('default'),

            Header::make(_t('blocks.accordion.settings.borders_header')),

            Select::make('border', _t('blocks.accordion.settings.border_label'))
                ->options([
                    'none' => _t('blocks.accordion.settings.border_options.none'),
                    'solid' => _t('blocks.accordion.settings.border_options.solid'),
                ])
                ->default('none'),

            Range::make('border_width', _t('blocks.accordion.settings.border_width_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(1)
                ->unit('px'),

            Range::make('border_opacity', _t('blocks.accordion.settings.border_opacity_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(100)
                ->unit('%'),

            Range::make('border_radius', _t('blocks.accordion.settings.border_radius_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),

            Header::make(_t('blocks.accordion.settings.padding_header')),

            Range::make('padding_block_start', _t('blocks.accordion.settings.padding_top_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),

            Range::make('padding_block_end', _t('blocks.accordion.settings.padding_bottom_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),

            Range::make('padding_inline_start', _t('blocks.accordion.settings.padding_left_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),

            Range::make('padding_inline_end', _t('blocks.accordion.settings.padding_right_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(0)
                ->unit('px'),
        ];
    }

    public function share(): array
    {
        return [
            'accordionIconType' => $this->block->settings->icon ?? 'caret',
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.accordion.presets.accordion.name'))
                ->category(_t('blocks.accordion.presets.accordion.category'))
                ->blocks([
                    PresetBlock::make('@visual-debut/accordion-row')
                        ->id('row-1')
                        ->settings([
                            'open_by_default' => true,
                            'heading' => 'Return policy',
                        ])
                        ->blocks([
                            PresetBlock::make('@visual-debut/text')
                                ->id('text-1')
                                ->settings([
                                    'text' => '<p>Our goal is for every customer to be totally satisfied with their purchase. If this isn\'t the case, let us know and we\'ll do our best to work with you to make it right.</p>',
                                    'width' => '100%',
                                ]),
                        ]),

                    PresetBlock::make('@visual-debut/accordion-row')
                        ->id('row-2')
                        ->settings([
                            'heading' => 'Shipping',
                        ])
                        ->blocks([
                            PresetBlock::make('@visual-debut/text')
                                ->id('text-1')
                                ->settings([
                                    'text' => '<p>We will work quickly to ship your order as soon as possible. Once your order has shipped, you will receive an email with further information. Delivery times vary depending on your location.</p>',
                                    'width' => '100%',
                                ]),
                        ]),

                    PresetBlock::make('@visual-debut/accordion-row')
                        ->id('row-3')
                        ->settings([
                            'heading' => 'Manufacturing',
                        ])
                        ->blocks([
                            PresetBlock::make('@visual-debut/text')
                                ->id('text-1')
                                ->settings([
                                    'text' => '<p>Our products are manufactured both locally and globally. We carefully select our manufacturing partners to ensure our products are high quality and a fair value.</p>',
                                    'width' => '100%',
                                ]),
                        ]),
                ]),
        ];
    }
}
