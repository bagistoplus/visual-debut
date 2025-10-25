<?php

namespace BagistoPlus\VisualDebut\Blocks\Category;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Category;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Presets\CategoryCardOverlay;

use function BagistoPlus\VisualDebut\_t;

class CategoryCard extends SimpleBlock
{
    protected static string $type = '@visual-debut/category-card';

    protected static array $accepts = ['@visual-debut/container', '@visual-debut/category-*'];

    protected static string $view = 'visual-debut::blocks.category.card';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M3 15h18"/></svg>';

    protected static string $category = 'Category';

    public static function settings(): array
    {
        return [
            Category::make('category', _t('blocks.category-card.settings.category_label'))
        ];
    }

    public function share(): array
    {
        return [
            'category' => $this->block->settings->category ?? $this->context['category'] ?? null
        ];
    }

    public static function presets(): array
    {
        return [
            CategoryCardOverlay::class,

            // Vertical Card with Name on Image
            Preset::make(_t('blocks.category-card.presets.vertical_overlay.name'))
                ->category(_t('blocks.category-card.presets.vertical_overlay.category'))
                ->blocks([
                    PresetBlock::make('@visual-debut/container')
                        ->properties([
                            'layout_type' => 'block',
                            'border' => true,
                            'border_width' => 1,
                            'border_style' => 'solid',
                            'border_color' => '#E5E7EBFF',
                            'border_radius' => 'md',
                            'background_color' => 'transparent',
                        ])
                        ->children([
                            PresetBlock::make('@visual-debut/container')
                                ->properties([
                                    'layout_type' => 'block',
                                ])
                                ->children([
                                    PresetBlock::make('@visual-debut/category-image')
                                        ->properties([
                                            'image_source' => 'banner',
                                            'aspect_ratio' => 'square',
                                            'object_fit' => 'cover',
                                        ]),
                                    PresetBlock::make('@visual-debut/container')
                                        ->properties([
                                            'layout_type' => 'flex',
                                            'justify_content' => 'center',
                                            'align_items' => 'center',
                                            'is_overlay' => true,
                                            'background_color' => '#000000FF',
                                            'background_opacity' => 35,
                                            'z_index' => 10,
                                        ])
                                        ->children([
                                            PresetBlock::make('@visual-debut/category-name')
                                                ->properties([
                                                    'tag' => 'h3',
                                                    'alignment' => 'center',
                                                    'text_color' => '#FFFFFFFF',
                                                ]),
                                        ]),
                                ]),
                        ]),
                ]),

            // Vertical Card with Name Below Image
            Preset::make(_t('blocks.category-card.presets.vertical_below.name'))
                ->category(_t('blocks.category-card.presets.vertical_below.category'))
                ->blocks([
                    PresetBlock::make('@visual-debut/container')
                        ->properties([
                            'layout_type' => 'flex',
                            'flex_direction' => ['_default' => 'column'],
                            'flex_gap' => 0,
                            'border' => true,
                            'border_width' => 1,
                            'border_style' => 'solid',
                            'border_color' => '#E5E7EBFF',
                            'border_radius' => 'lg',
                            'background_color' => 'transparent',
                        ])
                        ->children([
                            PresetBlock::make('@visual-debut/category-image')
                                ->properties([
                                    'image_source' => 'banner',
                                    'aspect_ratio' => 'square',
                                    'object_fit' => 'cover',
                                ]),
                            PresetBlock::make('@visual-debut/container')
                                ->properties([
                                    'layout_type' => 'flex',
                                    'flex_direction' => ['_default' => 'column'],
                                    'justify_content' => 'center',
                                    'align_items' => 'center',
                                    'padding_top' => ['_default' => 4],
                                    'padding_bottom' => ['_default' => 4],
                                    'padding_left' => ['_default' => 4],
                                    'padding_right' => ['_default' => 4],
                                ])
                                ->children([
                                    PresetBlock::make('@visual-debut/category-name')
                                        ->properties([
                                            'tag' => 'h3',
                                            'alignment' => 'center',
                                            'text_color' => '#000000FF',
                                        ]),
                                ]),
                        ]),
                ]),

            // Simple Card - Image Only with Hover Overlay
            Preset::make(_t('blocks.category-card.presets.simple_hover.name'))
                ->category(_t('blocks.category-card.presets.simple_hover.category'))
                ->blocks([
                    PresetBlock::make('@visual-debut/container')
                        ->properties([
                            'layout_type' => 'block',
                            'border_radius' => 'xl',
                            'background_color' => 'transparent',
                        ])
                        ->children([
                            PresetBlock::make('@visual-debut/category-image')
                                ->properties([
                                    'image_source' => 'banner',
                                    'aspect_ratio' => 'landscape',
                                    'object_fit' => 'cover',
                                ]),
                            PresetBlock::make('@visual-debut/container')
                                ->properties([
                                    'layout_type' => 'flex',
                                    'justify_content' => 'center',
                                    'align_items' => 'center',
                                    'is_overlay' => true,
                                    'overlay_visibility' => 'hover',
                                    'background_color' => '#000000FF',
                                    'background_opacity' => 50,
                                    'z_index' => 10,
                                ])
                                ->children([
                                    PresetBlock::make('@visual-debut/category-name')
                                        ->properties([
                                            'tag' => 'h2',
                                            'alignment' => 'center',
                                            'text_color' => '#FFFFFFFF',
                                        ]),
                                ]),
                        ]),
                ]),
        ];
    }
}
