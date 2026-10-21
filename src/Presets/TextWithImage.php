<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\BasicBlocks\Blocks\Media\Image;
use BagistoPlus\BasicBlocks\Sections\FlexSection;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class TextWithImage extends Preset
{
    /** Translation group under sections.flex-section.presets */
    protected string $copyKey = 'image_with_text';

    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $copy = "sections.flex-section.presets.{$this->copyKey}";

        $this
            ->name(_t("{$copy}.name"))
            ->category('Content')
            ->settings([
                'flex_direction' => ['_default' => 'row', 'mobile' => 'column'],
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
                PresetBlock::make(Image::class)
                    ->settings([
                        'image' => '/themes/shop/visual-debut/images/image-with-text.webp',
                        'alt' => _t("{$copy}.image_alt"),
                        'aspect_ratio' => 'square',
                        'object_fit' => 'cover',
                        'width' => 'fill',
                        'border_radius' => 'sm',
                    ]),

                // Content Container
                PresetBlock::make(Group::class)
                    ->name(_t("{$copy}.content"))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'column',
                        'flex_justify' => 'center',
                        'flex_align' => ['_default' => 'start', 'mobile' => 'center'],
                        'flex_gap' => ['_default' => 4],
                        'width' => 'full',
                    ])
                    ->blocks($this->contentBlocks($copy)),
            ]);
    }

    /**
     * @return array<int, PresetBlock>
     */
    protected function contentBlocks(string $copy): array
    {
        return [
            PresetBlock::make(Heading::class)
                ->settings([
                    'text' => _t("{$copy}.heading"),
                    'heading_level' => 'h2',
                    'typography' => 'heading-2',
                ]),
            PresetBlock::make(Text::class)
                ->settings([
                    'text' => _t("{$copy}.description"),
                    'width' => ['_default' => 'fit', 'mobile' => 'fill'],
                    'max_width' => 'narrow',
                    'alignment' => ['_default' => 'start', 'mobile' => 'center'],
                ]),
            PresetBlock::make(Button::class)
                ->settings([
                    'text' => _t("{$copy}.cta"),
                    'size' => 'lg',
                ]),
        ];
    }
}
