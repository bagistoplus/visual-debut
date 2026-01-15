<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class HeroBanner extends Preset
{
    public static function getType(): string
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
                'vertical_justify_content' => ['_default' => 'center'],
                'vertical_align_items' => ['_default' => 'center'],
                'flex_gap' => ['_default' => 4],
                'section_width' => 'container',
                'section_height' => 'sm',
                'background_type' => 'image',
                'background_image' => '/themes/shop/visual-debut/images/hero-banner.avif',
                'background_position' => 'center',
                'background_size' => 'cover',
                'background_repeat' => 'no-repeat',
                'toggle_overlay' => true,
                'overlay_style' => 'solid',
                'overlay_color' => '#00000059',
                'padding' => [
                    'top' => 0,
                    'right' => 4,
                    'bottom' => 0,
                    'left' => 4,
                ],
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/heading')
                    ->settings([
                        'text' => 'Welcome to our store',
                        'heading_level' => 'h1',
                        'typography' => 'heading-1',
                        'color' => 'custom',
                        'text_color' => '#EBE6E6FF',
                    ]),

                PresetBlock::make('@visual-debut/text')
                    ->settings([
                        'text' => 'Discover our best products and offers.',
                        'width' => 'fit-content',
                        'max_width' => 'normal',
                        'alignment' => 'left',
                        'color' => 'custom',
                        'text_color' => '#EBE6E6FF',
                    ]),

                PresetBlock::make('@visual-debut/group')
                    ->name('Buttons')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'row',
                        'horizontal_justify_content' => 'center',
                        'horizontal_align_items' => 'center',
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
