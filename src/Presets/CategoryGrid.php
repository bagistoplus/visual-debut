<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Blocks\Category;
use BagistoPlus\VisualDebut\Sections\CategoryList;

use function BagistoPlus\VisualDebut\_t;

class CategoryGrid extends Preset
{
    public static function getType(): string
    {
        return CategoryList::class;
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
                'padding' => [
                    'top' => 4,
                    'right' => 0,
                    'bottom' => 4,
                    'left' => 0,
                ],
            ])
            ->blocks([
                // Heading
                PresetBlock::make(Heading::class)
                    ->settings([
                        'heading_level' => 'h2',
                        'text' => _t('sections.category-list.presets.grid.heading'),
                        'width' => 'fill',
                        'alignment' => 'center',
                        'typography' => 'heading-2',
                        'padding' => [
                            'top' => 8,
                            'right' => 0,
                            'bottom' => 8,
                            'left' => 0,
                        ],
                    ]),

                // Static repeated category card using CategoryCardOverlay preset
                CategoryCardOverlay::asChild()
                    ->id('static-category-card')
                    ->static()
                    ->repeated()
                    ->name('Category Card'),

                // Ghost category examples
                PresetBlock::make(Category::class)
                    ->id('category-1')
                    ->name('Category')
                    ->ghost()
                    ->settings(['category' => 2]),

                PresetBlock::make(Category::class)
                    ->id('category-2')
                    ->name('Category')
                    ->ghost()
                    ->settings(['category' => 3]),
            ]);
    }
}
