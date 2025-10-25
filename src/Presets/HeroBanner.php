<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class HeroBanner extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/flex-section';
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.hero_banner.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => ['_default' => 'column'],
                'justify_content' => 'center',
                'align_items' => 'center',
                'flex_gap' => ['_default' => 4],
                'section_width' => 'container',
                'section_height' => 'sm',
                'background_type' => 'image',
                'background_image' => asset('themes/shop/visual-debut/images/hero-banner.avif'),
                'background_position' => 'center',
                'background_size' => 'cover',
                'background_repeat' => 'no-repeat',
                'toggle_overlay' => true,
                'overlay_style' => 'solid',
                'overlay_color' => '#00000059',
                'padding_top' => ['_default' => 0],
                'padding_bottom' => ['_default' => 0],
                'padding_left' => ['_default' => 4],
                'padding_right' => ['_default' => 4],
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/heading')
                    ->settings([
                        'text' => 'Welcome to our store',
                        'heading_level' => 'h1',
                        'type_preset' => 'h1',
                        'color' => 'custom',
                        'text_color' => '#EBE6E6FF',
                    ]),

                PresetBlock::make('@visual-debut/text')
                    ->settings([
                        'text' => 'Discover our best products and offers.',
                        'type_preset' => 'paragraph',
                        'width' => 'fit-content',
                        'max_width' => 'normal',
                        'alignment' => 'center',
                        'color' => 'custom',
                        'text_color' => '#EBE6E6FF',
                    ]),

                PresetBlock::make('@visual-debut/container')
                    ->name('Buttons')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'row',
                        'justify_content' => 'center',
                        'align_items' => 'center',
                        'flex_gap' => ['_default' => 4],
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/button')
                            ->settings([
                                'label' => 'View collections',
                                'link' => '/collections',
                                'style_class' => 'solid',
                                'color' => 'primary',
                                'width' => 'fit-content',
                            ]),
                    ]),
            ]);
    }
}
