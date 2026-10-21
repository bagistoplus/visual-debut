<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\BasicBlocks\Sections\FlexSection;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class Testimonials extends Preset
{
    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.testimonials.name'))
            ->category('Content')
            ->settings([
                'flex_direction' => ['_default' => 'column'],
                'flex_justify' => ['_default' => 'start'],
                'flex_align' => ['_default' => 'center'],
                'flex_gap' => ['_default' => 8],
                'section_width' => 'container',
                'section_height' => 'auto',
                'padding' => [
                    'top' => 14,
                    'right' => 0,
                    'bottom' => 14,
                    'left' => 0,
                ],
            ])
            ->blocks([
                PresetBlock::make(Heading::class)
                    ->settings([
                        'text' => _t('sections.flex-section.presets.testimonials.heading'),
                        'heading_level' => 'h2',
                        'typography' => 'heading-2',
                        'width' => 'fill',
                        'alignment' => 'center',
                    ]),

                PresetBlock::make(Group::class)
                    ->name(_t('sections.flex-section.presets.testimonials.grid'))
                    ->settings([
                        'layout_type' => 'grid',
                        'grid_columns' => ['_default' => 3, 'mobile' => 1],
                        'grid_gap' => ['_default' => 6],
                        'width' => 'full',
                    ])
                    ->blocks([
                        $this->createTestimonial(
                            _t('sections.flex-section.presets.testimonials.items.first.quote'),
                            _t('sections.flex-section.presets.testimonials.items.first.author')
                        ),
                        $this->createTestimonial(
                            _t('sections.flex-section.presets.testimonials.items.second.quote'),
                            _t('sections.flex-section.presets.testimonials.items.second.author')
                        ),
                        $this->createTestimonial(
                            _t('sections.flex-section.presets.testimonials.items.third.quote'),
                            _t('sections.flex-section.presets.testimonials.items.third.author')
                        ),
                    ]),
            ]);
    }

    protected function createTestimonial(string $quote, string $author): PresetBlock
    {
        return PresetBlock::make(Group::class)
            ->name(_t('sections.flex-section.presets.testimonials.card'))
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'column',
                'flex_align' => 'start',
                'flex_gap' => ['_default' => 4],
                'width' => 'full',
                'border' => true,
                'border_width' => 1,
                'border_color' => '#2723221A',
                'border_radius' => 'lg',
                'padding' => [
                    'top' => 6,
                    'right' => 6,
                    'bottom' => 6,
                    'left' => 6,
                ],
            ])
            ->blocks([
                PresetBlock::make(Text::class)
                    ->settings([
                        'text' => _t('sections.flex-section.presets.testimonials.stars'),
                        'color' => 'accent',
                    ]),

                PresetBlock::make(Text::class)
                    ->settings([
                        'text' => $quote,
                        'width' => 'fill',
                    ]),

                PresetBlock::make(Text::class)
                    ->settings([
                        'text' => $author,
                        'width' => 'fill',
                        'typography' => 'heading-6',
                    ]),
            ]);
    }
}
