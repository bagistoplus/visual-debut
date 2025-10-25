<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;

use function BagistoPlus\VisualDebut\_t;

class CustomSection extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/flex-section';
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
