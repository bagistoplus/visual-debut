<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Divider;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Sections\Footer;

use function BagistoPlus\VisualDebut\_t;

class MinimalFooter extends Preset
{
    public static function getType(): string
    {
        return Footer::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.footer.presets.minimal.name'))
            ->category('Footer')
            ->settings([
                'content_width' => 'container',
                'padding' => [
                    'top' => 8,
                    'right' => 0,
                    'bottom' => 8,
                    'left' => 0,
                ],
            ])
            ->blocks([
                PresetBlock::make(Group::class)
                    ->name(_t('sections.footer.presets.minimal.centered_content'))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'flex_align' => 'center',
                        'flex_gap' => ['_default' => 6],
                        'width' => 'full',
                    ])
                    ->blocks([
                        PresetBlock::make(Heading::class)
                            ->settings([
                                'text' => config('app.name'),
                                'heading_level' => 'h2',
                                'alignment' => 'center',
                            ]),

                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => _t('sections.footer.presets.minimal.tagline'),
                                'alignment' => 'center',
                            ]),

                        $this->createSocialIcons(),

                        PresetBlock::make(Divider::class)
                            ->settings([
                                'width_percent' => 50,
                                'alignment' => 'center',
                                'padding' => [
                                    'top' => 4,
                                    'right' => 0,
                                    'bottom' => 4,
                                    'left' => 0,
                                ],
                            ]),

                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => _t('sections.footer.presets.minimal.copyright', ['year' => date('Y')]),
                                'alignment' => 'center',
                            ]),
                    ]),
            ]);
    }

    protected function createSocialIcons(): PresetBlock
    {
        return PresetBlock::make(Group::class)
            ->name(_t('sections.footer.presets.minimal.social_icons'))
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'row',
                'flex_gap' => ['_default' => 4],
            ])
            ->blocks([
                PresetBlock::make(Button::class)
                    ->settings([
                        'url' => '#',
                        'text' => '',
                        'icon' => 'lucide-facebook',
                        'style' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                        'circle' => true,
                    ]),

                PresetBlock::make(Button::class)
                    ->settings([
                        'url' => '#',
                        'text' => '',
                        'icon' => 'lucide-instagram',
                        'style' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                        'circle' => true,
                    ]),

                PresetBlock::make(Button::class)
                    ->settings([
                        'url' => '#',
                        'text' => '',
                        'icon' => 'ri-twitter-x-line',
                        'style' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                        'circle' => true,
                    ]),
            ]);
    }
}
