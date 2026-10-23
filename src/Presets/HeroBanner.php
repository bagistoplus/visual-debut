<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\BasicBlocks\Sections\FlexSection;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class HeroBanner extends Preset
{
    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.hero_banner.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => ['_default' => 'column'],
                'flex_justify' => ['_default' => 'end'],
                'flex_align' => ['_default' => 'start', 'mobile' => 'center'],
                'flex_gap' => ['_default' => 4],
                'section_width' => 'container',
                'section_height' => ['_default' => 'md', 'mobile' => 'sm'],
                'background_type' => 'image',
                'background_image' => [
                    'path' => '/themes/shop/visual-debut/images/hero.webp',
                    // Keep the model's head in frame however the hero crops
                    'focalPoint' => ['x' => 72, 'y' => 25],
                ],
                'background_size' => 'cover',
                'background_repeat' => 'no-repeat',
                // The homepage's largest image
                'background_priority' => true,
                'toggle_overlay' => true,
                'overlay_style' => 'gradient',
                'overlay_gradient' => 'linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.2) 55%, rgba(0, 0, 0, 0) 100%)',
                'padding' => [
                    '_default' => [
                        'top' => 12,
                        'right' => 0,
                        'bottom' => 12,
                        'left' => 0,
                    ],
                    'mobile' => [
                        'top' => 8,
                        'right' => 0,
                        'bottom' => 8,
                        'left' => 0,
                    ],
                ],
            ])
            ->blocks([
                PresetBlock::make(Group::class)
                    ->name(_t('sections.flex-section.presets.hero_banner.content'))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'flex_align' => ['_default' => 'start', 'mobile' => 'center'],
                        'flex_gap' => ['_default' => 4],
                        'width' => 'full',
                        'max_width' => 'md',
                    ])
                    ->blocks([
                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => _t('sections.flex-section.presets.hero_banner.eyebrow'),
                                'typography' => 'heading-6',
                                'alignment' => ['_default' => 'start', 'mobile' => 'center'],
                                'color' => 'custom',
                                'text_color' => '#FFFFFFFF',
                            ]),

                        PresetBlock::make(Heading::class)
                            ->settings([
                                'text' => _t('sections.flex-section.presets.hero_banner.heading'),
                                'heading_level' => 'h1',
                                'typography' => 'heading-1',
                                'color' => 'custom',
                                'text_color' => '#FFFFFFFF',
                                'width' => 'fill',
                                'max_width' => 'none',
                                'alignment' => ['_default' => 'start', 'mobile' => 'center'],
                            ]),

                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => _t('sections.flex-section.presets.hero_banner.description'),
                                'width' => 'fill',
                                'max_width' => 'none',
                                'alignment' => ['_default' => 'start', 'mobile' => 'center'],
                                'color' => 'custom',
                                'text_color' => '#FFFFFFFF',
                            ]),

                        PresetBlock::make(Group::class)
                            ->name(_t('sections.flex-section.presets.hero_banner.buttons'))
                            ->settings([
                                'layout_type' => 'flex',
                                'flex_direction' => 'row',
                                'flex_justify' => ['_default' => 'start', 'mobile' => 'center'],
                                'flex_align' => 'center',
                                'flex_gap' => ['_default' => 3],
                                'padding' => [
                                    'top' => 2,
                                    'right' => 0,
                                    'bottom' => 0,
                                    'left' => 0,
                                ],
                            ])
                            ->blocks([
                                PresetBlock::make(Button::class)
                                    ->settings([
                                        'text' => _t('sections.flex-section.presets.hero_banner.cta'),
                                        'url' => '/search',
                                        'style' => 'filled',
                                        'color' => 'primary',
                                        'size' => 'lg',
                                    ]),

                                PresetBlock::make(Button::class)
                                    ->settings([
                                        'text' => _t('sections.flex-section.presets.hero_banner.secondary_cta'),
                                        'url' => '/page/about-us',
                                        'style' => 'filled',
                                        'color' => 'neutral',
                                        'size' => 'lg',
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
