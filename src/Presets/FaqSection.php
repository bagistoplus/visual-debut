<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Sections\FlexSection;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Blocks\Accordion;
use BagistoPlus\VisualDebut\Blocks\AccordionRow;

use function BagistoPlus\VisualDebut\_t;

class FaqSection extends Preset
{
    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.faq.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => 'column',
                'flex_justify' => 'start',
                'flex_align' => 'center',
                'flex_gap' => 8,
                'section_width' => 'container',
                'section_height' => 'auto',
                'padding' => [
                    'top' => 12,
                    'right' => 0,
                    'bottom' => 12,
                    'left' => 0,
                ],
            ])
            ->blocks([
                PresetBlock::make(Text::class)
                    ->id('heading')
                    ->settings([
                        'text' => _t('sections.flex-section.presets.faq.heading'),
                        'width' => 'fit',
                        'max_width' => 'narrow',
                        'alignment' => 'left',
                    ]),

                PresetBlock::make(Accordion::class)
                    ->id('accordion')
                    ->settings([
                        'icon' => 'caret',
                        'dividers' => true,
                        'inherit_color_scheme' => true,
                    ])
                    ->blocks([
                        PresetBlock::make(AccordionRow::class)
                            ->id('row-1')
                            ->settings(['heading' => _t('sections.flex-section.presets.faq.items.return_policy.question')])
                            ->blocks([
                                PresetBlock::make(Text::class)
                                    ->settings([
                                        'text' => _t('sections.flex-section.presets.faq.items.return_policy.answer'),
                                        'width' => 'fill',
                                        'max_width' => 'normal',
                                        'alignment' => 'left',
                                    ]),
                            ]),

                        PresetBlock::make(AccordionRow::class)
                            ->id('row-2')
                            ->settings(['heading' => _t('sections.flex-section.presets.faq.items.final_sale.question')])
                            ->blocks([
                                PresetBlock::make(Text::class)
                                    ->settings([
                                        'text' => _t('sections.flex-section.presets.faq.items.final_sale.answer'),
                                        'width' => 'fill',
                                    ]),
                            ]),

                        PresetBlock::make(AccordionRow::class)
                            ->id('row-3')
                            ->settings(['heading' => _t('sections.flex-section.presets.faq.items.order_delivery.question')])
                            ->blocks([
                                PresetBlock::make(Text::class)
                                    ->settings([
                                        'text' => _t('sections.flex-section.presets.faq.items.order_delivery.answer'),
                                        'width' => 'fill',
                                    ]),
                            ]),

                        PresetBlock::make(AccordionRow::class)
                            ->id('row-4')
                            ->settings(['heading' => _t('sections.flex-section.presets.faq.items.manufacturing.question')])
                            ->blocks([
                                PresetBlock::make(Text::class)
                                    ->settings([
                                        'text' => _t('sections.flex-section.presets.faq.items.manufacturing.answer'),
                                        'width' => 'fill',
                                    ]),
                            ]),

                        PresetBlock::make(AccordionRow::class)
                            ->id('row-5')
                            ->settings(['heading' => _t('sections.flex-section.presets.faq.items.shipping_cost.question')])
                            ->blocks([
                                PresetBlock::make(Text::class)
                                    ->settings([
                                        'text' => _t('sections.flex-section.presets.faq.items.shipping_cost.answer'),
                                        'width' => 'fill',
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
