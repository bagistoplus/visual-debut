<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

class TextWithImage extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/flex-section';
    }

    protected function build(): void
    {
        $this
            ->name('Text with Image')
            ->category('Content')
            ->settings([
                'flex_direction' => ['_default' => 'row', 'mobile' => 'column'],
                'justify_content' => 'between',
                'align_items' => 'center',
                'flex_gap' => ['_default' => 8],
                'section_width' => 'container',
                'section_height' => 'auto',
                'padding_top' => ['_default' => 12],
                'padding_bottom' => ['_default' => 12],
            ])
            ->blocks([
                // Image Container
                PresetBlock::make('@visual-debut/container')
                    ->name('Image')
                    ->settings([
                        'layout_type' => 'block',
                        'width' => ['_default' => '50%', 'mobile' => '100%'],
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/image')
                            ->settings([
                                'aspect_ratio' => 'adapt',
                                'object_fit' => 'cover',
                                'width' => 'fill',
                            ])
                    ]),

                // Content Container
                PresetBlock::make('@visual-debut/container')
                    ->name('Content')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'justify_content' => 'center',
                        'align_items' => 'start',
                        'flex_gap' => ['_default' => 4],
                        'width' => ['_default' => '50%', 'mobile' => '100%'],
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/heading')
                            ->settings([
                                'text' => 'Image with text',
                                'tag' => 'h2',
                            ]),
                        PresetBlock::make('@visual-debut/text')
                            ->settings([
                                'text' => 'Pair text with an image to focus on your chosen product, collection, or blog post. Add details on availability, style, or even provide a review.',
                            ]),
                        PresetBlock::make('@visual-debut/button')
                            ->settings([
                                'label' => 'Shop now',
                                'width' => 'fit-content',
                            ]),
                    ])
            ]);
    }
}
