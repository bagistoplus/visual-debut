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
                'flex_justify' => ['_default' => 'center'],
                'flex_align' => ['_default' => 'center'],
                'flex_gap' => ['_default' => 4],
                'section_width' => 'container',
                'section_height' => 'sm',
                'background_type' => 'image',
                'background_image' => '/themes/shop/visual-debut/images/hero-banner.avif',
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
                PresetBlock::make(Heading::class)
                    ->settings([
                        'text' => _t('sections.flex-section.presets.hero_banner.heading'),
                        'heading_level' => 'h1',
                        'typography' => 'heading-1',
                        'color' => 'custom',
                        'text_color' => '#EBE6E6FF',
                        'width' => [
                            '_default' => 'fit',
                            'mobile' => 'full',
                        ],
                        'alignment' => 'center',
                    ]),

                PresetBlock::make(Text::class)
                    ->settings([
                        'text' => _t('sections.flex-section.presets.hero_banner.description'),
                        'width' => 'fit',
                        'max_width' => 'normal',
                        'alignment' => 'left',
                        'color' => 'custom',
                        'text_color' => '#EBE6E6FF',
                    ]),

                PresetBlock::make(Group::class)
                    ->name(_t('sections.flex-section.presets.hero_banner.buttons'))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'row',
                        'flex_justify' => 'center',
                        'flex_align' => 'center',
                        'flex_gap' => ['_default' => 4],
                    ])
                    ->blocks([
                        PresetBlock::make(Button::class)
                            ->settings([
                                'text' => _t('sections.flex-section.presets.hero_banner.cta'),
                                'url' => '/collections',
                                'style' => 'filled',
                                'color' => 'primary',
                            ]),
                    ]),
            ]);
    }
}
