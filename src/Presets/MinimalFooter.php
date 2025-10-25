<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class MinimalFooter extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/footer';
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.footer.presets.minimal.name'))
            ->category('Footer')
            ->settings([
                'content_width' => 'container',
                'padding_top' => ['_default' => 8],
                'padding_bottom' => ['_default' => 8],
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/container')
                    ->name('Centered Content')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'align_items' => 'center',
                        'gap' => ['_default' => 6],
                        'width' => '100%',
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/heading')
                            ->settings([
                                'text' => config('app.name'),
                                'tag' => 'h2',
                                'alignment' => 'center',
                            ]),

                        PresetBlock::make('@visual-debut/text')
                            ->settings([
                                'text' => _t('sections.footer.presets.minimal.tagline'),
                                'alignment' => 'center',
                                'type_preset' => 'custom',
                                'font_size' => 'text-sm',
                            ]),

                        $this->createSocialIcons(),

                        PresetBlock::make('@visual-debut/divider')
                            ->settings([
                                'width_percent' => 50,
                                'alignment' => 'center',
                                'padding_top' => ['_default' => 4],
                                'padding_bottom' => ['_default' => 4],
                            ]),

                        PresetBlock::make('@visual-debut/text')
                            ->settings([
                                'text' => '© ' . date('Y') . ' All rights reserved.',
                                'alignment' => 'center',
                                'type_preset' => 'custom',
                                'font_size' => 'text-xs',
                            ]),
                    ]),
            ]);
    }

    protected function createSocialIcons(): PresetBlock
    {
        return PresetBlock::make('@visual-debut/container')
            ->name('Social Icons')
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'row',
                'gap' => ['_default' => 4],
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/button')
                    ->settings([
                        'link' => '#',
                        'icon' => 'lucide-facebook',
                        'circle' => true,
                        'style_class' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                    ]),

                PresetBlock::make('@visual-debut/button')
                    ->settings([
                        'link' => '#',
                        'icon' => 'lucide-instagram',
                        'circle' => true,
                        'style_class' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                    ]),

                PresetBlock::make('@visual-debut/button')
                    ->settings([
                        'link' => '#',
                        'icon' => 'ri-twitter-x-line',
                        'circle' => true,
                        'style_class' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                    ]),
            ]);
    }
}
