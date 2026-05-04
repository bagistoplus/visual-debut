<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Category\CategoryImage;
use BagistoPlus\BasicBlocks\Blocks\Category\CategoryName;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Blocks\Category\CategoryCard;

use function BagistoPlus\VisualDebut\_t;

class CategoryCardOverlay extends Preset
{
    public static function getType(): string
    {
        return CategoryCard::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('blocks.category-card.presets.overlay.name'))
            ->category('Category')
            ->blocks([
                // Category Image
                PresetBlock::make(CategoryImage::class)
                    ->settings([
                        'image_source' => 'logo',
                        'aspect_ratio' => 'square',
                        'object_fit' => 'cover',
                        'hover_zoom' => true,
                        'hover_zoom_scale' => 105,
                    ]),

                // Overlay Container with Category Name
                PresetBlock::make(Group::class)
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => 'row',
                        'flex_wrap' => 'nowrap',
                        'flex_justify' => 'center',
                        'flex_align' => 'center',
                        'flex_gap' => ['_default' => 4],
                        'is_overlay' => true,
                        'overlay_visibility' => 'always',
                        'background_type' => 'color',
                        'background_color' => 'rgba(0, 0, 0, 0.35)',
                        'z_index' => 10,
                    ])
                    ->blocks([
                        PresetBlock::make(CategoryName::class)
                            ->settings([
                                'width' => 'fit',
                                'max_width' => 'normal',
                                'alignment' => 'center',
                                'typography' => 'heading-3',
                                'color' => 'custom',
                                'text_color' => '#FFFFFFFF',
                                'heading_level' => 'h3',
                            ]),
                    ]),
            ]);
    }
}
