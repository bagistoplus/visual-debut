<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Icon;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\BasicBlocks\Sections\FlexSection;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class FeatureIcons extends Preset
{
    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.feature_icons.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => ['_default' => 'column'],
                'flex_justify' => ['_default' => 'start'],
                'flex_align' => ['_default' => 'start'],
                'flex_gap' => ['_default' => 6],
                'section_width' => 'container',
                'section_height' => 'auto',
                'padding' => [
                    'top' => 16,
                    'right' => 0,
                    'bottom' => 16,
                    'left' => 0,
                ],
            ])
            ->blocks([
                // Section Heading
                PresetBlock::make(Heading::class)
                    ->settings([
                        'text' => 'Why Shop With Us?',
                        'heading_level' => 'h2',
                        'typography' => 'heading-2',
                        'width' => 'fill',
                        'alignment' => 'center',
                    ]),

                // Section Description
                PresetBlock::make(Text::class)
                    ->settings([
                        'text' => 'Explore our customer-focused features',
                        'width' => 'fill',
                        'alignment' => 'center',
                    ]),

                // Grid Container for Features
                PresetBlock::make(Group::class)
                    ->name('Features Grid')
                    ->settings([
                        'layout_type' => 'grid',
                        'grid_columns' => ['_default' => 4, 'mobile' => 1],
                        'grid_gap' => ['_default' => 6],
                        'width' => 'full',
                    ])
                    ->blocks([
                        // Feature Item 1
                        $this->createFeatureItem('Free Shipping', 'Free shipping on orders over $50', 'lucide-truck'),
                        $this->createFeatureItem('24/7 Support', 'Contact us anytime, anywhere', 'lucide-headphones'),
                        $this->createFeatureItem('Secure Payment', '100% secure payment guaranteed', 'lucide-shield-check'),
                        $this->createFeatureItem('Easy Returns', '30-day return policy', 'lucide-package-check'),
                    ])
            ]);
    }

    protected function createFeatureItem(string $title, string $description, string $icon): PresetBlock
    {
        return PresetBlock::make(Group::class)
            ->name('Feature')
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'column',
                'flex_align' => 'center',
                'flex_gap' => ['_default' => 2],
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
                                'icon' => $icon,
                                'size' => ['_default' => '5'],
                            ])
                    ]),

                // Content
                PresetBlock::make(Group::class)
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'flex_align' => 'center',
                        'flex_gap' => ['_default' => 2]
                    ])
                    ->blocks([
                        PresetBlock::make(Heading::class)
                            ->settings([
                                'text' => $title,
                                'heading_level' => 'h3',
                                'width' => 'fill',
                                'alignment' => 'center',
                                'typography' => 'heading-6'
                            ]),

                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => $description,
                                'width' => 'fill',
                                'alignment' => 'center',
                            ]),
                    ])
            ]);
    }
}
