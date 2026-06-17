<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Spacing;
use BagistoPlus\Visual\Settings\Typography;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Tailwind;

use function BagistoPlus\VisualDebut\_t;

class Accordion extends BladeBlock
{
    protected static string $type = '@visual-debut/accordion';

    protected static string $view = 'visual-debut::blocks.accordion';

    protected static array $accepts = [AccordionRow::class];

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="7" x="3" y="3" rx="1"/><path d="M9 10h6"/><rect width="18" height="7" x="3" y="14" rx="1"/><path d="M9 17h6"/></svg>';

    protected static string $category = 'Layout';

    public static function name(): string
    {
        return _t('blocks.accordion.name');
    }

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

            Typography::make('typography', _t('blocks.accordion.settings.typography_label'))
                ->info(_t('blocks.accordion.settings.typography_info')),

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

            Header::make(_t('blocks.common.padding_header')),

            Spacing::make('padding', _t('blocks.common.padding_label'))
                ->responsive()
                ->min(0)
                ->max(24),
        ];
    }

    public function share(): array
    {
        return [
            'accordionIconType' => $this->block->settings->icon ?? 'caret',
        ];
    }

    protected function getViewData(): array
    {
        $paddingClasses = '';
        if ($this->block->settings->has('padding')) {
            $paddingClasses = Tailwind::responsive(
                $this->block->settings->padding,
                fn ($v) => Tailwind::buildSpacingClasses($v, 'p')
            );
        }

        return [
            'paddingClasses' => $paddingClasses,
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.accordion.presets.accordion.name'))
                ->category('Layout')
                ->blocks([
                    PresetBlock::make(AccordionRow::class)
                        ->id('row-1')
                        ->settings([
                            'open_by_default' => true,
                            'heading' => 'Return policy',
                        ])
                        ->blocks([
                            PresetBlock::make(Text::class)
                                ->id('text-1')
                                ->settings([
                                    'text' => '<p>Our goal is for every customer to be totally satisfied with their purchase. If this isn\'t the case, let us know and we\'ll do our best to work with you to make it right.</p>',
                                    'width' => 'fill',
                                ]),
                        ]),

                    PresetBlock::make(AccordionRow::class)
                        ->id('row-2')
                        ->settings([
                            'heading' => 'Shipping',
                        ])
                        ->blocks([
                            PresetBlock::make(Text::class)
                                ->id('text-1')
                                ->settings([
                                    'text' => '<p>We will work quickly to ship your order as soon as possible. Once your order has shipped, you will receive an email with further information. Delivery times vary depending on your location.</p>',
                                    'width' => 'fill',
                                ]),
                        ]),

                    PresetBlock::make(AccordionRow::class)
                        ->id('row-3')
                        ->settings([
                            'heading' => 'Manufacturing',
                        ])
                        ->blocks([
                            PresetBlock::make(Text::class)
                                ->id('text-1')
                                ->settings([
                                    'text' => '<p>Our products are manufactured both locally and globally. We carefully select our manufacturing partners to ensure our products are high quality and a fair value.</p>',
                                    'width' => 'fill',
                                ]),
                        ]),
                ]),
        ];
    }
}
