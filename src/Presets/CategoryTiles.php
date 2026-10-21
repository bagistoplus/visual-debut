<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Category\CategoryImage;
use BagistoPlus\BasicBlocks\Blocks\Category\CategoryName;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Blocks\Category\CategoryCard;
use BagistoPlus\VisualDebut\Sections\CategoryList;

use function BagistoPlus\VisualDebut\_t;

class CategoryTiles extends Preset
{
    public static function getType(): string
    {
        return CategoryList::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.category-list.presets.tiles.name'))
            ->category('Category')
            ->settings([
                'nb_categories' => 4,
                'layout_type' => 'grid',
                'columns' => ['_default' => 4, 'mobile' => 2],
                'gap' => 6,
                'content_width' => 'container',
                'nav_style' => 'arrow',
                'nav_shape' => 'none',
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
                        'heading_level' => 'h2',
                        'text' => _t('sections.category-list.presets.grid.heading'),
                        'width' => 'fill',
                        'alignment' => 'center',
                        'typography' => 'heading-2',
                        'padding' => [
                            'top' => 0,
                            'right' => 0,
                            'bottom' => 8,
                            'left' => 0,
                        ],
                    ]),

                // No category blocks: the section falls back to the channel's top-level categories
                PresetBlock::make(CategoryCard::class)
                    ->id('static-category-card')
                    ->static()
                    ->repeated()
                    ->name(_t('sections.category-list.presets.tiles.category_card'))
                    ->settings([
                        'wrap_in_card' => false,
                    ])
                    ->blocks([
                        PresetBlock::make(CategoryImage::class)
                            ->settings([
                                'image_source' => 'banner',
                                'aspect_ratio' => 'portrait',
                                'object_fit' => 'cover',
                                'hover_zoom' => true,
                                'hover_zoom_scale' => 105,
                                'border_radius' => 'sm',
                            ]),

                        PresetBlock::make(Group::class)
                            ->settings([
                                'layout_type' => 'flex',
                                'flex_direction' => 'column',
                                'flex_justify' => 'end',
                                'flex_align' => 'start',
                                'flex_gap' => ['_default' => 1],
                                'is_overlay' => true,
                                'overlay_position' => 'full',
                                'overlay_visibility' => 'always',
                                'background_type' => 'gradient',
                                'background_gradient' => 'linear-gradient(to top, rgba(0, 0, 0, 0.55) 0%, rgba(0, 0, 0, 0) 60%)',
                                'border_radius' => 'sm',
                                'z_index' => 10,
                                'padding' => [
                                    'top' => 4,
                                    'right' => 4,
                                    'bottom' => 4,
                                    'left' => 4,
                                ],
                            ])
                            ->blocks([
                                PresetBlock::make(CategoryName::class)
                                    ->settings([
                                        'width' => 'fit',
                                        'alignment' => 'start',
                                        'typography' => 'heading-5',
                                        'color' => 'custom',
                                        'text_color' => '#FFFFFFFF',
                                    ]),

                                PresetBlock::make(Text::class)
                                    ->settings([
                                        'text' => _t('sections.category-list.presets.tiles.cta'),
                                        'width' => 'fit',
                                        'alignment' => 'start',
                                        'color' => 'custom',
                                        'text_color' => '#FFFFFFFF',
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
