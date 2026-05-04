<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Icon;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class FeatureIcon extends Preset
{
    public static function getType(): string
    {
        return Group::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('blocks.feature-icon.name'))
            ->category('Content')
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'column',
                'flex_align' => 'center',
                'flex_gap' => ['_default' => 4],
            ])
            ->blocks([
                // Icon Container (circular border)
                PresetBlock::make(Group::class)
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_justify' => 'center',
                        'flex_align' => 'center',
                        'width' => '56px',
                        'height' => '56px',
                        'border' => true,
                        'border_width' => 1,
                        'border_opacity' => 70,
                        'border_radius' => 'full',
                        'padding' => [
                            'top' => 3,
                            'right' => 3,
                            'bottom' => 3,
                            'left' => 3,
                        ],
                    ])
                    ->blocks([
                        PresetBlock::make(Icon::class)
                            ->settings([
                                'icon' => 'lucide-tag',
                                'size' => ['_default' => '5'],
                            ])
                    ]),

                // Content Container
                PresetBlock::make(Group::class)
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'flex_align' => 'center',
                    ])
                    ->blocks([
                        PresetBlock::make(Heading::class)
                            ->settings([
                                'text' => 'Feature Title',
                                'heading_level' => 'h3',
                                'width' => 'fill',
                                'alignment' => 'center',
                            ]),

                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => 'Feature description goes here',
                                'width' => 'fill',
                                'alignment' => 'center',
                            ]),
                    ])
            ]);
    }
}
