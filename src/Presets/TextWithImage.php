<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\BasicBlocks\Blocks\Media\Image;
use BagistoPlus\BasicBlocks\Sections\FlexSection;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class TextWithImage extends Preset
{
    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.image_with_text.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => ['_default' => 'row', 'mobile' => 'column'],
                'flex_justify' => ['_default' => 'left'],
                'flex_align' => ['_default' => 'center'],
                'flex_gap' => ['_default' => 8],
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
                PresetBlock::make(Image::class)
                    ->settings([
                        'aspect_ratio' => 'square',
                        'object_fit' => 'cover',
                        'width' => 'fill',
                    ]),

                // Content Container
                PresetBlock::make(Group::class)
                    ->name(_t('sections.flex-section.presets.image_with_text.content'))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'flex_justify' => 'center',
                        'flex_align' => ['_default' => 'start', 'mobile' => 'center'],
                        'flex_gap' => ['_default' => 4],
                        'width' => 'full',
                    ])
                    ->blocks([
                        PresetBlock::make(Heading::class)
                            ->settings([
                                'text' => _t('sections.flex-section.presets.image_with_text.heading'),
                                'heading_level' => 'h2',
                                'typography' => 'heading-2',
                            ]),
                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => _t('sections.flex-section.presets.image_with_text.description'),
                                'width' => ['_default' => 'fit', 'mobile' => 'fill'],
                                'max_width' => 'narrow',
                                'alignment' => ['_default' => 'left', 'mobile' => 'center'],
                            ]),
                        PresetBlock::make(Button::class)
                            ->settings([
                                'text' => _t('sections.flex-section.presets.image_with_text.cta'),
                            ]),
                    ]),
            ]);
    }
}
