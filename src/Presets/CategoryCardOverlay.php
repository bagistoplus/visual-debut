<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class CategoryCardOverlay extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/category-card';
    }

    protected function build(): void
    {
        $this
            ->name(_t('blocks.category-card.presets.overlay.name'))
            ->category('Category')
            ->blocks([
                // Category Image
                PresetBlock::make('@visual-debut/category-image')
                    ->settings([
                        'image_source' => 'logo',
                        'aspect_ratio' => 'square',
                        'object_fit' => 'cover',
                        'hover_zoom' => true,
                        'hover_zoom_scale' => 105,
                    ]),

                // Overlay Container with Category Name
                PresetBlock::make('@visual-debut/container')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'row',
                        'flex_wrap' => 'nowrap',
                        'justify_content' => 'center',
                        'align_items' => 'center',
                        'flex_gap' => ['_default' => 4],
                        'is_overlay' => true,
                        'overlay_visibility' => 'always',
                        'background_type' => 'color',
                        'background_color' => 'rgba(0, 0, 0, 0.35)',
                        'z_index' => 10,
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/category-name')
                            ->settings([
                                'width' => 'fit-content',
                                'max_width' => 'normal',
                                'alignment' => 'center',
                                'type_preset' => 'h3',
                                'wrap' => 'pretty',
                                'color' => 'custom',
                                'text_color' => '#FFFFFFFF',
                                'tag' => 'h3',
                            ]),
                    ]),
            ]);
    }
}
