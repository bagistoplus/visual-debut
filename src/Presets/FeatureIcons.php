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
                'justify_content' => 'start',
                'align_items' => 'stretch',
                'flex_gap' => ['_default' => 6],
                'section_width' => 'container',
                'section_height' => 'auto',
                'padding_top' => ['_default' => 16],
                'padding_bottom' => ['_default' => 16],
            ])
            ->blocks([
                // Section Heading
                PresetBlock::make('@visual-debut/heading')
                    ->settings([
                        'text' => 'Why Shop With Us?',
                        'tag' => 'h2',
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
                PresetBlock::make('@visual-debut/container')
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
        return PresetBlock::make('@visual-debut/container')
            ->name('Feature')
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
                                'icon' => $icon,
                                'size' => ['_default' => '5'],
                            ])
                    ]),

                // Content
                PresetBlock::make('@visual-debut/container')
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
