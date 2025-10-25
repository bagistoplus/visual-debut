<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class CategoryGrid extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/category-list';
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.category-list.presets.grid.name'))
            ->category('Category')
            ->settings([
                'layout_type' => ['_default' => 'grid'],
                'columns' => ['_default' => 4, 'mobile' => 2],
                'gap' => 4,
                'content_width' => 'container',
                'nav_style' => 'arrow',
                'nav_shape' => 'none',
                'padding_top' => ['_default' => 4],
                'padding_bottom' => ['_default' => 4],
            ])
            ->blocks([
                // Heading
                PresetBlock::make('@visual-debut/heading')
                    ->settings([
                        'tag' => 'h2',
                        'heading_level' => 'h2',
                        'text' => _t('sections.category-list.presets.grid.heading'),
                        'width' => '100%',
                        'alignment' => 'center',
                        'type_preset' => 'h2',
                        'padding_block_start' => ['_default' => 8],
                        'padding_block_end' => ['_default' => 8],
                    ]),

                // Static repeated category card using CategoryCardOverlay preset
                CategoryCardOverlay::asChild()
                    ->id('static-category-card')
                    ->static()
                    ->repeated()
                    ->name('Category Card'),

                // Ghost category examples
                PresetBlock::make('@visual-debut/category')
                    ->id('category-1')
                    ->name('Category')
                    ->ghost()
                    ->settings(['category' => 2]),

                PresetBlock::make('@visual-debut/category')
                    ->id('category-2')
                    ->name('Category')
                    ->ghost()
                    ->settings(['category' => 3]),
            ]);
    }
}
