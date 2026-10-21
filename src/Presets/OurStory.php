<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class OurStory extends TextWithImage
{
    protected string $copyKey = 'our_story';

    protected function contentBlocks(string $copy): array
    {
        return [
            PresetBlock::make(Text::class)
                ->settings([
                    'text' => _t("{$copy}.eyebrow"),
                    'typography' => 'heading-6',
                    'color' => 'primary',
                    'alignment' => ['_default' => 'start', 'mobile' => 'center'],
                ]),
            PresetBlock::make(Heading::class)
                ->settings([
                    'text' => _t("{$copy}.heading"),
                    'heading_level' => 'h2',
                    'typography' => 'heading-2',
                    'alignment' => ['_default' => 'start', 'mobile' => 'center'],
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
                    'url' => '/page/about-us',
                    'size' => 'lg',
                ]),
        ];
    }
}
