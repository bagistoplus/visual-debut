<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class FeatureIcon extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/container';
    }

    protected function build(): void
    {
        $this
            ->name(_t('blocks.container.presets.feature_icon.name'))
            ->category('Content')
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'column',
                'align_items' => 'center',
                'flex_gap' => ['_default' => 4],
            ])
            ->blocks([
                // Icon Container (circular border)
                PresetBlock::make('@visual-debut/container')
                    ->settings([
                        'layout_type' => 'flex',
                        'justify_content' => 'center',
                        'align_items' => 'center',
                        'width' => '56px',
                        'height' => '56px',
                        'border' => true,
                        'border_width' => 1,
                        'border_opacity' => 70,
                        'border_radius' => 'full',
                        'padding_top' => ['_default' => 3],
                        'padding_bottom' => ['_default' => 3],
                        'padding_left' => ['_default' => 3],
                        'padding_right' => ['_default' => 3],
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/icon')
                            ->settings([
                                'icon' => 'lucide-tag',
                                'size' => ['_default' => '5'],
                            ])
                    ]),

                // Content Container
                PresetBlock::make('@visual-debut/container')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'align_items' => 'center',
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/heading')
                            ->settings([
                                'text' => 'Feature Title',
                                'tag' => 'h3',
                                'width' => '100%',
                                'alignment' => 'center',
                                'type_preset' => 'custom',
                                'font_size' => 16,
                                'font_weight' => '600',
                            ]),

                        PresetBlock::make('@visual-debut/text')
                            ->settings([
                                'text' => 'Feature description goes here',
                                'width' => '100%',
                                'alignment' => 'center',
                                'type_preset' => 'custom',
                                'font_size' => 12,
                            ]),
                    ])
            ]);
    }
}
