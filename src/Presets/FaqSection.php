<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class FaqSection extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/flex-section';
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.faq.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => 'column',
                'justify_content' => 'start',
                'align_items' => 'center',
                'flex_gap' => 8,
                'section_width' => 'container',
                'section_height' => 'auto',
                'padding_top' => 12,
                'padding_bottom' => 12,
                'padding_left' => 0,
                'padding_right' => 0,
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/text')
                    ->id('heading')
                    ->settings([
                        'text' => 'Frequently asked questions',
                        'width' => 'fit-content',
                        'max_width' => 'narrow',
                        'alignment' => 'left',
                    ]),

                PresetBlock::make('@visual-debut/accordion')
                    ->id('accordion')
                    ->settings([
                        'icon' => 'caret',
                        'dividers' => true,
                        'type_preset' => 'h5',
                        'inherit_color_scheme' => true,
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/accordion-row')
                            ->id('row-1')
                            ->settings(['heading' => 'What is the return policy?'])
                            ->blocks([
                                PresetBlock::make('@visual-debut/text')
                                    ->settings([
                                        'text' => 'Our goal is for every customer to be totally satisfied with their purchase. If this isn\'t the case, let us know and we\'ll do our best to work with you to make it right.',
                                        'width' => '100%',
                                        'max_width' => 'normal',
                                        'alignment' => 'left',
                                    ]),
                            ]),

                        PresetBlock::make('@visual-debut/accordion-row')
                            ->id('row-2')
                            ->settings(['heading' => 'Are any purchases final sale?'])
                            ->blocks([
                                PresetBlock::make('@visual-debut/text')
                                    ->settings([
                                        'text' => 'We are unable to accept returns on certain items. These will be carefully marked before purchase.',
                                        'width' => '100%',
                                    ]),
                            ]),

                        PresetBlock::make('@visual-debut/accordion-row')
                            ->id('row-3')
                            ->settings(['heading' => 'When will I get my order?'])
                            ->blocks([
                                PresetBlock::make('@visual-debut/text')
                                    ->settings([
                                        'text' => 'We will work quickly to ship your order as soon as possible. Once your order has shipped, you will receive an email with further information. Delivery times vary depending on your location.',
                                        'width' => '100%',
                                    ]),
                            ]),

                        PresetBlock::make('@visual-debut/accordion-row')
                            ->id('row-4')
                            ->settings(['heading' => 'Where are your products manufactured?'])
                            ->blocks([
                                PresetBlock::make('@visual-debut/text')
                                    ->settings([
                                        'text' => 'Our products are manufactured both locally and globally. We carefully select our manufacturing partners to ensure our products are high quality and a fair value.',
                                        'width' => '100%',
                                    ]),
                            ]),

                        PresetBlock::make('@visual-debut/accordion-row')
                            ->id('row-5')
                            ->settings(['heading' => 'How much does shipping cost?'])
                            ->blocks([
                                PresetBlock::make('@visual-debut/text')
                                    ->settings([
                                        'text' => 'Shipping is calculated based on your location and the items in your order. You will always know the shipping price before you purchase.',
                                        'width' => '100%',
                                    ]),
                            ]),
                    ])
            ]);
    }
}
