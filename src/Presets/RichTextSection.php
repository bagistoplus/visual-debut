<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Sections\FlexSection;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class RichTextSection extends Preset
{
    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.rich_text.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => 'column',
                'flex_justify' => 'center',
                'flex_align' => 'center',
                'flex_gap' => 6,
                'section_width' => 'container',
                'section_height' => 'sm',
                'padding' => [
                    'top' => 12,
                    'right' => 0,
                    'bottom' => 12,
                    'left' => 0,
                ],
            ])
            ->blocks([
                PresetBlock::make(Heading::class)
                    ->id('heading')
                    ->settings([
                        'text' => 'New arrivals',
                        'width' => 'fit',
                        'max_width' => 'normal',
                        'alignment' => 'left',
                        'typography' => 'heading-2',
                    ]),

                PresetBlock::make(Text::class)
                    ->id('text')
                    ->settings([
                        'text' => 'We make things that work better and last longer. Our products solve real problems with clean design and honest materials.',
                        'width' => 'fit',
                        'max_width' => 'normal',
                        'alignment' => 'center',
                    ]),

                PresetBlock::make(Button::class)
                    ->id('button')
                    ->settings([
                        'text' => 'Shop now',
                        'url' => '/collections/all',
                    ]),
            ]);
    }
}
