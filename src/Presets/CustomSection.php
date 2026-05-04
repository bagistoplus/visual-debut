<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Sections\FlexSection;
use BagistoPlus\Visual\Support\Preset;

use function BagistoPlus\VisualDebut\_t;

class CustomSection extends Preset
{
    public static function getType(): string
    {
        return FlexSection::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.flex-section.presets.custom_section.name'))
            ->category('Content')
            ->settings([
                'section_height' => 'sm',
            ]);
    }
}
