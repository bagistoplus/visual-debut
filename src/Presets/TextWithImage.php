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

class TextWithImage extends Preset
{
    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $this
            ->name('Text with Image')
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
                    ->name('Content')
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
                                'text' => 'Image with text',
                                'heading_level' => 'h2',
                                'typography' => 'heading-2',
                            ]),
                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => 'Pair text with an image to focus on your chosen product, collection, or blog post. Add details on availability, style, or even provide a review.',
                                'width' => ['_default' => 'fit', 'mobile' => 'fill'],
                                'max_width' => 'narrow',
                                'alignment' => ['_default' => 'left', 'mobile' => 'center'],
                            ]),
                        PresetBlock::make(Button::class)
                            ->settings([
                                'text' => 'Shop now',
                            ]),
                    ])
            ]);
    }
}
