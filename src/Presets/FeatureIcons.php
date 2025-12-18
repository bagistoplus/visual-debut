<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class FeatureIcons extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/flex-section';
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.feature_icons.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => ['_default' => 'column'],
                'vertical_justify_content' => ['_default' => 'start'],
                'vertical_align_items' => ['_default' => 'start'],
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
                PresetBlock::make('@visual-debut/heading')
                    ->settings([
                        'text' => 'Why Shop With Us?',
                        'tag' => 'h2',
                        'type_preset' => 'h2',
                        'width' => '100%',
                        'alignment' => 'center',
                    ]),

                // Section Description
                PresetBlock::make('@visual-debut/text')
                    ->settings([
                        'text' => 'Explore our customer-focused features',
                        'width' => '100%',
                        'alignment' => 'center',
                    ]),

                // Grid Container for Features
                PresetBlock::make('@visual-debut/group')
                    ->name('Features Grid')
                    ->settings([
                        'layout_type' => 'grid',
                        'grid_columns' => ['_default' => 4, 'mobile' => 1],
                        'grid_gap' => ['_default' => 6],
                        'width' => '100%',
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
        return PresetBlock::make('@visual-debut/group')
            ->name('Feature')
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'column',
                'vertical_align_items' => 'center',
                'flex_gap' => ['_default' => 4],
            ])
            ->blocks([
                // Icon Container (circular border)
                PresetBlock::make('@visual-debut/group')
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
                        'padding' => [
                            'top' => 3,
                            'right' => 3,
                            'bottom' => 3,
                            'left' => 3,
                        ],
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/icon')
                            ->settings([
                                'icon' => $icon,
                                'size' => ['_default' => '5'],
                            ])
                    ]),

                // Content
                PresetBlock::make('@visual-debut/group')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'align_items' => 'center',
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/heading')
                            ->settings([
                                'text' => $title,
                                'tag' => 'h3',
                                'width' => '100%',
                                'alignment' => 'center',
                                'type_preset' => 'custom',
                                'font_size' => 16,
                                'font_weight' => '600',
                            ]),

                        PresetBlock::make('@visual-debut/text')
                            ->settings([
                                'text' => $description,
                                'width' => '100%',
                                'alignment' => 'center',
                                'type_preset' => 'custom',
                                'font_size' => 12,
                            ]),
                    ])
            ]);
    }
}
