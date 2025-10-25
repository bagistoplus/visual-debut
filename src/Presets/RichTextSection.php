<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class RichTextSection extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/flex-section';
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.rich_text.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => 'column',
                'justify_content' => 'start',
                'align_items' => 'center',
                'flex_gap' => 6,
                'section_width' => 'container',
                'section_height' => 'sm',
                'padding_top' => 12,
                'padding_bottom' => 12,
                'padding_left' => 0,
                'padding_right' => 0,
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/text')
                    ->id('heading')
                    ->settings([
                        'text' => 'New arrivals',
                        'width' => 'fit-content',
                        'max_width' => 'normal',
                        'alignment' => 'left',
                    ]),

                PresetBlock::make('@visual-debut/text')
                    ->id('text')
                    ->settings([
                        'text' => 'We make things that work better and last longer. Our products solve real problems with clean design and honest materials.',
                        'width' => 'fit-content',
                        'max_width' => 'normal',
                        'alignment' => 'left',
                    ]),

                PresetBlock::make('@visual-debut/button')
                    ->id('button')
                    ->settings([
                        'label' => 'Shop now',
                        'link' => '/collections/all',
                        'width' => 'fit-content',
                    ]),
            ]);
    }
}
