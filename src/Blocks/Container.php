<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Color;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Gradient;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Image;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;
use BagistoPlus\VisualDebut\Tailwind;
use BagistoPlus\VisualDebut\Presets\FeatureIcon;
use Craftile\Core\Data\ResponsiveValue;
use matthieumastadenis\couleur\ColorFactory;
use matthieumastadenis\couleur\ColorInterface;
use BagistoPlus\Visual\Settings\Support\GradientValue;

class Container extends SimpleBlock
{
    protected static string $type = '@visual-debut/container';

    protected static string $view = 'visual-debut::blocks.container';

    protected static array $accepts = ['*'];

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>';

    protected static string $category = 'Layout';

    public static function settings(): array
    {
        return [
            // Layout Configuration
            Header::make(_t('blocks.container.settings.layout_header')),

            Select::make('layout_type', _t('blocks.container.settings.layout_type_label'))
                ->options([
                    'block' => _t('blocks.container.settings.layout_type_options.block'),
                    'flex' => _t('blocks.container.settings.layout_type_options.flex'),
                    'grid' => _t('blocks.container.settings.layout_type_options.grid'),
                ])
                ->default('flex')
                ->asSegment()
                ->info(_t('blocks.container.settings.layout_type_info')),

            // Flex Settings
            Select::make('flex_direction', _t('blocks.container.settings.flex_direction_label'))
                ->options([
                    'row' => _t('blocks.container.settings.flex_direction_options.row'),
                    'row-reverse' => _t('blocks.container.settings.flex_direction_options.row_reverse'),
                    'column' => _t('blocks.container.settings.flex_direction_options.column'),
                    'column-reverse' => _t('blocks.container.settings.flex_direction_options.column_reverse'),
                ])
                ->default('row')
                ->responsive()
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'flex')),

            Select::make('flex_wrap', _t('blocks.container.settings.flex_wrap_label'))
                ->options([
                    'nowrap' => _t('blocks.container.settings.flex_wrap_options.nowrap'),
                    'wrap' => _t('blocks.container.settings.flex_wrap_options.wrap'),
                    'wrap-reverse' => _t('blocks.container.settings.flex_wrap_options.wrap_reverse'),
                ])
                ->default('nowrap')
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'flex')),

            Select::make('justify_content', _t('blocks.container.settings.justify_content_label'))
                ->options([
                    'start' => _t('blocks.container.settings.justify_content_options.start'),
                    'center' => _t('blocks.container.settings.justify_content_options.center'),
                    'end' => _t('blocks.container.settings.justify_content_options.end'),
                    'between' => _t('blocks.container.settings.justify_content_options.between'),
                    'around' => _t('blocks.container.settings.justify_content_options.around'),
                    'evenly' => _t('blocks.container.settings.justify_content_options.evenly'),
                ])
                ->default('start')
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'flex')),

            Select::make('align_items', _t('blocks.container.settings.align_items_label'))
                ->options([
                    'start' => _t('blocks.container.settings.align_items_options.start'),
                    'center' => _t('blocks.container.settings.align_items_options.center'),
                    'end' => _t('blocks.container.settings.align_items_options.end'),
                    'stretch' => _t('blocks.container.settings.align_items_options.stretch'),
                    'baseline' => _t('blocks.container.settings.align_items_options.baseline'),
                ])
                ->default('stretch')
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'flex')),

            Range::make('flex_gap', _t('blocks.container.settings.gap_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(4)
                ->responsive()
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'flex')),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            // Grid Settings
            Range::make('grid_columns', _t('blocks.container.settings.grid_columns_label'))
                ->min(1)
                ->max(12)
                ->step(1)
                ->default(3)
                ->responsive()
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'grid')),

            Select::make('grid_rows', _t('blocks.container.settings.grid_rows_label'))
                ->options([
                    'auto' => _t('blocks.container.settings.grid_rows_options.auto'),
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ])
                ->default('auto')
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'grid')),

            Range::make('grid_gap', _t('blocks.container.settings.gap_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(4)
                ->responsive()
                ->visibleWhen(fn($rule) => $rule->when('layout_type', 'grid')),

            // Spacing
            Header::make(_t('blocks.container.settings.spacing_header')),

            Range::make('padding_top', _t('blocks.container.settings.padding_top_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_bottom', _t('blocks.container.settings.padding_bottom_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_left', _t('blocks.container.settings.padding_left_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_right', _t('blocks.container.settings.padding_right_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('margin_top', _t('blocks.container.settings.margin_top_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('margin_bottom', _t('blocks.container.settings.margin_bottom_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('margin_left', _t('blocks.container.settings.margin_left_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('margin_right', _t('blocks.container.settings.margin_right_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            // Sizing
            Header::make(_t('blocks.container.settings.sizing_header')),

            Select::make('width', _t('blocks.container.settings.width_label'))
                ->options([
                    'auto' => _t('blocks.container.settings.width_options.auto'),
                    'full' => _t('blocks.container.settings.width_options.full'),
                    'fit' => _t('blocks.container.settings.width_options.fit'),
                    'screen' => _t('blocks.container.settings.width_options.screen'),
                    'custom' => _t('blocks.container.settings.width_options.custom'),
                ])
                ->default('auto')
                ->responsive(),

            Range::make('custom_width', _t('blocks.container.settings.custom_width_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->default(100)
                ->unit('%')
                ->visibleWhen(fn($rule) => $rule->when('width', 'custom')),

            Range::make('min_width', _t('blocks.container.settings.min_width_label'))
                ->min(0)
                ->max(1000)
                ->step(10)
                ->default(0)
                ->unit('px'),

            Select::make('max_width', _t('blocks.container.settings.max_width_label'))
                ->options([
                    'none' => _t('blocks.container.settings.max_width_options.none'),
                    'xs' => 'XS (20rem)',
                    'sm' => 'SM (24rem)',
                    'md' => 'MD (28rem)',
                    'lg' => 'LG (32rem)',
                    'xl' => 'XL (36rem)',
                    '2xl' => '2XL (42rem)',
                    'full' => _t('blocks.container.settings.max_width_options.full'),
                    'screen' => _t('blocks.container.settings.max_width_options.screen'),
                ])
                ->default('none'),

            Select::make('height', _t('blocks.container.settings.height_label'))
                ->options([
                    'auto' => _t('blocks.container.settings.height_options.auto'),
                    'full' => _t('blocks.container.settings.height_options.full'),
                    'fit' => _t('blocks.container.settings.height_options.fit'),
                    'screen' => _t('blocks.container.settings.height_options.screen'),
                    'custom' => _t('blocks.container.settings.height_options.custom'),
                ])
                ->default('auto'),

            Range::make('custom_height', _t('blocks.container.settings.custom_height_label'))
                ->min(0)
                ->max(1000)
                ->step(10)
                ->default(400)
                ->unit('px')
                ->visibleWhen(fn($rule) => $rule->when('height', 'custom')),

            Range::make('min_height', _t('blocks.container.settings.min_height_label'))
                ->min(0)
                ->max(1000)
                ->step(10)
                ->default(0)
                ->unit('px'),

            // Borders
            Header::make(_t('blocks.container.settings.borders_header')),

            Checkbox::make('border', _t('blocks.container.settings.border_label'))
                ->default(false),

            Range::make('border_width', _t('blocks.container.settings.border_width_label'))
                ->min(0)
                ->max(8)
                ->step(1)
                ->default(1)
                ->unit('px')
                ->visibleWhen(fn($rule) => $rule->whenTruthy('border')),

            Select::make('border_style', _t('blocks.container.settings.border_style_label'))
                ->options([
                    'solid' => _t('blocks.container.settings.border_style_options.solid'),
                    'dashed' => _t('blocks.container.settings.border_style_options.dashed'),
                    'dotted' => _t('blocks.container.settings.border_style_options.dotted'),
                ])
                ->default('solid')
                ->asSegment()
                ->visibleWhen(fn($rule) => $rule->whenTruthy('border')),

            Color::make('border_color', _t('blocks.container.settings.border_color_label'))
                ->default('currentColor')
                ->visibleWhen(fn($rule) => $rule->whenTruthy('border')),

            Range::make('border_opacity', _t('blocks.container.settings.border_opacity_label'))
                ->min(0)
                ->max(100)
                ->step(5)
                ->default(100)
                ->unit('%')
                ->visibleWhen(fn($rule) => $rule->whenTruthy('border')),

            Select::make('border_radius', _t('blocks.container.settings.border_radius_label'))
                ->options([
                    'none' => _t('blocks.container.settings.border_radius_options.none'),
                    'sm' => 'SM',
                    'md' => 'MD',
                    'lg' => 'LG',
                    'xl' => 'XL',
                    '2xl' => '2XL',
                    '3xl' => '3XL',
                    'full' => _t('blocks.container.settings.border_radius_options.full'),
                ])
                ->default('none'),

            // Background
            Header::make(_t('blocks.container.settings.background_header')),

            Select::make('background_type', _t('blocks.container.settings.background_type_label'))
                ->options([
                    'none' => _t('blocks.container.settings.background_type_options.none'),
                    'color' => _t('blocks.container.settings.background_type_options.color'),
                    'gradient' => _t('blocks.container.settings.background_type_options.gradient'),
                    'image' => _t('blocks.container.settings.background_type_options.image'),
                ])
                ->asSegment()
                ->default('none'),

            Color::make('background_color', _t('blocks.container.settings.background_color_label'))
                ->default('rgba(0, 0, 0, 0)')
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'color')),

            Gradient::make('background_gradient', _t('blocks.container.settings.background_gradient_label'))
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'gradient')),

            Image::make('background_image', _t('blocks.container.settings.background_image_label'))
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'image')),

            Select::make('background_position', _t('blocks.container.settings.background_position_label'))
                ->options([
                    'center' => _t('blocks.container.settings.background_position_options.center'),
                    'top' => _t('blocks.container.settings.background_position_options.top'),
                    'bottom' => _t('blocks.container.settings.background_position_options.bottom'),
                    'left' => _t('blocks.container.settings.background_position_options.left'),
                    'right' => _t('blocks.container.settings.background_position_options.right'),
                ])
                ->default('center')
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'image')),

            Select::make('background_size', _t('blocks.container.settings.background_size_label'))
                ->options([
                    'cover' => _t('blocks.container.settings.background_size_options.cover'),
                    'contain' => _t('blocks.container.settings.background_size_options.contain'),
                    'auto' => _t('blocks.container.settings.background_size_options.auto'),
                ])
                ->default('cover')
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'image')),

            Select::make('background_repeat', _t('blocks.container.settings.background_repeat_label'))
                ->options([
                    'no-repeat' => _t('blocks.container.settings.background_repeat_options.no_repeat'),
                    'repeat' => _t('blocks.container.settings.background_repeat_options.repeat'),
                    'repeat-x' => _t('blocks.container.settings.background_repeat_options.repeat_x'),
                    'repeat-y' => _t('blocks.container.settings.background_repeat_options.repeat_y'),
                ])
                ->default('no-repeat')
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'image')),

            // Overlay
            Header::make(_t('blocks.container.settings.overlay_header')),

            Checkbox::make('is_overlay', _t('blocks.container.settings.is_overlay_label'))
                ->default(false)
                ->info(_t('blocks.container.settings.is_overlay_info')),

            Select::make('overlay_visibility', _t('blocks.container.settings.overlay_visibility_label'))
                ->options([
                    'always' => _t('blocks.container.settings.overlay_visibility_options.always'),
                    'hover' => _t('blocks.container.settings.overlay_visibility_options.hover'),
                ])
                ->default('always')
                ->info(_t('blocks.container.settings.overlay_visibility_info'))
                ->visibleWhen(fn($rule) => $rule->whenTruthy('is_overlay')),

            Select::make('overlay_hover_target', _t('blocks.container.settings.overlay_hover_target_label'))
                ->options([
                    'parent' => _t('blocks.container.settings.overlay_hover_target_options.parent'),
                    'group' => _t('blocks.container.settings.overlay_hover_target_options.group'),
                    'group/product-card' => _t('blocks.container.settings.overlay_hover_target_options.product_card'),
                ])
                ->default('parent')
                ->info(_t('blocks.container.settings.overlay_hover_target_info'))
                ->visibleWhen(fn($rule) => $rule->whenTruthy('is_overlay')->when('overlay_visibility', 'hover')),

            Range::make('z_index', _t('blocks.container.settings.z_index_label'))
                ->min(0)
                ->max(50)
                ->step(1)
                ->default(10)
                ->visibleWhen(fn($rule) => $rule->whenTruthy('is_overlay')),

            Select::make('position', _t('blocks.container.settings.position_label'))
                ->options([
                    'static' => _t('blocks.container.settings.position_options.static'),
                    'relative' => _t('blocks.container.settings.position_options.relative'),
                    'absolute' => _t('blocks.container.settings.position_options.absolute'),
                    'fixed' => _t('blocks.container.settings.position_options.fixed'),
                ])
                ->default('static')
                ->visibleWhen(fn($rule) => $rule->whenFalsy('is_overlay')),
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.container.presets.basic.name'))
                ->category(_t('blocks.container.presets.basic.category'))
                ->settings([
                    'layout_type' => 'block',
                ]),

            Preset::make(_t('blocks.container.presets.centered.name'))
                ->category(_t('blocks.container.presets.centered.category'))
                ->settings([
                    'max_width' => 'xl',
                    'margin_left' => 'auto',
                    'margin_right' => 'auto',
                ]),

            Preset::make(_t('blocks.container.presets.card.name'))
                ->category(_t('blocks.container.presets.card.category'))
                ->settings([
                    'padding_top' => 6,
                    'padding_bottom' => 6,
                    'padding_left' => 6,
                    'padding_right' => 6,
                    'border' => true,
                    'border_radius' => 'lg',
                ]),

            Preset::make(_t('blocks.container.presets.flex_row.name'))
                ->category(_t('blocks.container.presets.flex_row.category'))
                ->settings([
                    'layout_type' => 'flex',
                    'flex_direction' => 'row',
                    'flex_gap' => 4,
                ]),

            Preset::make(_t('blocks.container.presets.grid.name'))
                ->category(_t('blocks.container.presets.grid.category'))
                ->settings([
                    'layout_type' => 'grid',
                    'grid_columns' => 3,
                    'grid_gap' => 4,
                ]),

            Preset::make(_t('blocks.container.presets.overlay.name'))
                ->category(_t('blocks.container.presets.overlay.category'))
                ->settings([
                    'is_overlay' => true,
                    'background_color' => 'rgba(0, 0, 0, 0.5)',
                    'padding_top' => 8,
                    'padding_bottom' => 8,
                ])
                ->blocks([
                    PresetBlock::make('@visual-debut/text')
                        ->settings([
                            'text' => 'Overlay Content',
                        ]),
                ]),

            FeatureIcon::class,
        ];
    }

    protected function getViewData(): array
    {
        return $this->generateClasses();
    }

    protected function generateClasses(): array
    {
        $classes = ['group'];
        $styles = [];
        $properties = $this->block->properties->all();

        $this->mapPosition($classes, $styles, $properties);

        if (isset($properties['layout_type'])) {
            $layoutType = $properties['layout_type'] ?? 'block';
            $this->mapLayoutType($classes, $layoutType);

            if ($layoutType === 'flex') {
                $this->mapFlexProperties($classes, $properties);
            }

            if ($layoutType === 'grid') {
                $this->mapGridProperties($classes, $properties);
            }
        } elseif (isset($properties['flex_direction'])) {
            $classes[] = 'flex';
            $this->mapFlexProperties($classes, $properties);
        }

        $this->mapSpacing($classes, $styles, $properties);
        $this->mapSizing($classes, $styles, $properties);
        $this->mapBorder($classes, $styles, $properties);
        $this->mapBackground($classes, $styles, $properties);
        $this->mapOverlay($classes, $styles, $properties);

        return [
            'class' => implode(' ', $classes),
            'style' => implode(';', $styles)
        ];
    }

    protected function mapPosition(array &$classes, array &$styles, array $properties): void
    {
        if ($properties['is_overlay'] ?? false) {

            $classes[] = 'absolute inset-0';

            $overlayVisibility = $properties['overlay_visibility'] ?? 'always';
            if ($overlayVisibility === 'hover') {
                $hoverTarget = $properties['overlay_hover_target'] ?? 'parent';

                // Determine hover prefix based on target
                // Support named groups with 'group/name' syntax
                if (str_starts_with($hoverTarget, 'group/')) {
                    // Named group like 'group/product-card' -> 'group-hover/product-card'
                    $hoverPrefix = 'group-hover/' . substr($hoverTarget, 6);
                } elseif ($hoverTarget === 'group') {
                    $hoverPrefix = 'group-hover';
                } else {
                    $hoverPrefix = 'parent-hover';
                }

                $classes[] = "opacity-0 pointer-events-none {$hoverPrefix}:opacity-100 {$hoverPrefix}:pointer-events-auto transition-opacity duration-300 [&>*]:pointer-events-auto";
            }

            if (isset($properties['z_index'])) {
                $zIndex = $properties['z_index'];
                $commonZIndexes = [0, 10, 20, 30, 40, 50];
                if (in_array($zIndex, $commonZIndexes)) {
                    $classes[] = "z-{$zIndex}";
                } else {
                    $styles[] = "z-index: {$zIndex}";
                }
            }
        } else {
            // Use selected position when not overlay
            $classes[] = match ($properties['position'] ?? 'static') {
                'relative' => 'relative',
                'absolute' => 'absolute',
                'fixed' => 'fixed',
                default => 'static',
            };
        }
    }

    protected function mapLayoutType(array &$classes, string $layoutType): void
    {
        $classes[] = match ($layoutType) {
            'flex' => 'flex',
            'grid' => 'grid',
            default => 'block'
        };
    }

    protected function mapFlexProperties(array &$classes, array $properties): void
    {
        if (isset($properties['flex_direction'])) {
            $classes[] = Tailwind::responsive($properties['flex_direction'], fn($v) => match ($v) {
                'row' => 'flex-row',
                'row-reverse' => 'flex-row-reverse',
                'column' => 'flex-col',
                'column-reverse' => 'flex-col-reverse',
                default => 'flex-row',
            });
        }

        if (isset($properties['flex_wrap'])) {
            $classes[] = Tailwind::responsive($properties['flex_wrap'], fn($v) => match ($v) {
                'nowrap' => 'flex-nowrap',
                'wrap' => 'flex-wrap',
                'wrap-reverse' => 'flex-wrap-reverse',
                default => 'flex-nowrap',
            });
        }

        if (isset($properties['justify_content'])) {
            $classes[] = Tailwind::responsive($properties['justify_content'], fn($v) => match ($v) {
                'start' => 'justify-start',
                'end' => 'justify-end',
                'center' => 'justify-center',
                'between' => 'justify-between',
                'around' => 'justify-around',
                'evenly' => 'justify-evenly',
                default => 'justify-start',
            });
        }

        if (isset($properties['align_items'])) {
            $classes[] = Tailwind::responsive($properties['align_items'], fn($v) => match ($v) {
                'stretch' => 'items-stretch',
                'start' => 'items-start',
                'end' => 'items-end',
                'center' => 'items-center',
                'baseline' => 'items-baseline',
                default => 'items-stretch',
            });
        }

        if (isset($properties['flex_gap'])) {
            $classes[] = Tailwind::responsive($properties['flex_gap'], fn($v) => "gap-{$v}");
        }
    }

    protected function mapGridProperties(array &$classes, array $properties): void
    {
        if (isset($properties['grid_columns'])) {
            $classes[] = Tailwind::responsive($properties['grid_columns'], fn($v) => is_numeric($v) ? "grid-cols-{$v}" : (string)$v);
        }

        if (isset($properties['grid_rows'])) {
            $classes[] = Tailwind::responsive($properties['grid_rows'], fn($v) => $v === 'auto' ? 'grid-rows-auto' : "grid-rows-{$v}");
        }

        if (isset($properties['grid_gap'])) {
            $classes[] = Tailwind::responsive($properties['grid_gap'], fn($v) => "gap-{$v}");
        }
    }

    protected function mapSpacing(array &$classes, array &$styles, array $properties): void
    {
        $pt = $properties['padding_top'] ?? null;
        $pb = $properties['padding_bottom'] ?? null;
        $ps = $properties['padding_left'] ?? null;
        $pe = $properties['padding_right'] ?? null;

        $mt = $properties['margin_top'] ?? null;
        $mb = $properties['margin_bottom'] ?? null;
        $ms = $properties['margin_left'] ?? null;
        $me = $properties['margin_right'] ?? null;

        // Padding
        if ($pt && $pb && $this->responsiveValuesEqual($pt, $pb)) {
            $classes[] = Tailwind::responsive($pt, fn($v) => "py-{$v}");
        } else {
            if ($pt) {
                $classes[] = Tailwind::responsive($pt, fn($v) => "pt-{$v}");
            }
            if ($pb) {
                $classes[] = Tailwind::responsive($pb, fn($v) => "pb-{$v}");
            }
        }

        if ($ps && $pe && $this->responsiveValuesEqual($ps, $pe)) {
            $classes[] = Tailwind::responsive($ps, fn($v) => "px-{$v}");
        } else {
            if ($ps) {
                $classes[] = Tailwind::responsive($ps, fn($v) => "ps-{$v}");
            }
            if ($pe) {
                $classes[] = Tailwind::responsive($pe, fn($v) => "pe-{$v}");
            }
        }

        // Margin
        if ($mt && $mb && $this->responsiveValuesEqual($mt, $mb)) {
            $classes[] = Tailwind::responsive($mt, fn($v) => "my-{$v}");
        } else {
            if ($mt) {
                $classes[] = Tailwind::responsive($mt, fn($v) => "mt-{$v}");
            }
            if ($mb) {
                $classes[] = Tailwind::responsive($mb, fn($v) => "mb-{$v}");
            }
        }

        if ($ms && $me && $this->responsiveValuesEqual($ms, $me)) {
            $classes[] = Tailwind::responsive($ms, fn($v) => "mx-{$v}");
        } else {
            if ($ms) {
                $classes[] = Tailwind::responsive($ms, fn($v) => "ms-{$v}");
            }
            if ($me) {
                $classes[] = Tailwind::responsive($me, fn($v) => "me-{$v}");
            }
        }
    }

    protected function mapSizing(array &$classes, array &$styles, array $properties): void
    {
        // Width
        if (isset($properties['width'])) {
            $width = $properties['width'];
            if ($width === 'custom' && isset($properties['custom_width'])) {
                $customWidth = $properties['custom_width'];
                $styles[] = "width: {$customWidth}%";
            } elseif ($width !== 'auto') {
                $classes[] = Tailwind::responsive($width, fn($v) => match ($v) {
                    'full' => 'w-full',
                    'fit' => 'w-fit',
                    'screen' => 'w-screen',
                    default => '',
                });
            }
        }

        // Min width
        if (isset($properties['min_width'])) {
            $minWidth = $properties['min_width'];
            if ($minWidth > 0) {
                $styles[] = "min-width: {$minWidth}px";
            }
        }

        // Max width
        if (isset($properties['max_width'])) {
            $maxWidth = $properties['max_width'];
            if ($maxWidth !== 'none') {
                $classes[] = Tailwind::responsive($maxWidth, fn($v) => match ($v) {
                    'xs' => 'max-w-xs',
                    'sm' => 'max-w-sm',
                    'md' => 'max-w-md',
                    'lg' => 'max-w-lg',
                    'xl' => 'max-w-xl',
                    '2xl' => 'max-w-2xl',
                    'full' => 'max-w-full',
                    'screen' => 'max-w-screen',
                    default => '',
                });
            }
        }

        // Height
        if (isset($properties['height'])) {
            $height = $properties['height'];
            if ($height === 'custom' && isset($properties['custom_height'])) {
                $customHeight = $properties['custom_height'];
                $styles[] = "height: {$customHeight}px";
            } elseif ($height !== 'auto') {
                $classes[] = Tailwind::responsive($height, fn($v) => match ($v) {
                    'full' => 'h-full',
                    'fit' => 'h-fit',
                    'screen' => 'h-screen',
                    default => '',
                });
            }
        }

        // Min height
        if (isset($properties['min_height'])) {
            $minHeight = $properties['min_height'];
            if ($minHeight > 0) {
                $styles[] = "min-height: {$minHeight}px";
            }
        }
    }

    protected function mapBorder(array &$classes, array &$styles, array $properties): void
    {
        if (!($properties['border'] ?? false)) {
            return;
        }

        // Border width
        if (isset($properties['border_width'])) {
            $borderWidth = $properties['border_width'];
            if ($borderWidth >= 0 && $borderWidth <= 8) {
                $classes[] = $borderWidth === 1 ? 'border' : "border-{$borderWidth}";
            } else {
                $styles[] = "border-width: {$borderWidth}px";
            }
        }

        // Border style
        if (isset($properties['border_style'])) {
            $classes[] = "border-{$properties['border_style']}";
        }

        // Border color with opacity
        if (isset($properties['border_color'])) {
            $borderColor = $this->parseColor($properties['border_color']);

            if ($borderColor) {
                if (isset($properties['border_opacity'])) {
                    $opacity = $properties['border_opacity'] / 100;
                    $rgb = $borderColor->toRgb();
                    $coords = $rgb->coordinates();
                    $colorStr = "rgba({$coords[0]}, {$coords[1]}, {$coords[2]}, {$opacity})";
                    $styles[] = "border-color: {$colorStr}";
                } else {
                    $styles[] = "border-color: {$borderColor}";
                }
            }
        }

        // Border radius
        if (isset($properties['border_radius'])) {
            $borderRadius = $properties['border_radius'];
            if ($borderRadius !== 'none') {
                $classes[] = Tailwind::responsive($borderRadius, fn($v) => match ($v) {
                    'sm' => 'rounded-sm',
                    'md' => 'rounded-md',
                    'lg' => 'rounded-lg',
                    'xl' => 'rounded-xl',
                    '2xl' => 'rounded-2xl',
                    '3xl' => 'rounded-3xl',
                    'full' => 'rounded-full',
                    default => '',
                });
            }
        }
    }

    protected function mapBackground(array &$classes, array &$styles, array $properties): void
    {
        $bgType = $properties['background_type'] ?? 'none';

        if ($bgType === 'color' && isset($properties['background_color']) && $properties['background_color']) {
            $styles[] = "background-color: {$properties['background_color']}";
        } elseif ($bgType === 'gradient' && isset($properties['background_gradient']) && $properties['background_gradient']) {
            $styles[] = "background-image: {$properties['background_gradient']}";
        } elseif ($bgType === 'image' && isset($properties['background_image']) && $properties['background_image']) {
            $styles[] = "background-image: url('{$properties['background_image']}')";

            $classes[] = match ($properties['background_position'] ?? 'center') {
                'top' => 'bg-top',
                'bottom' => 'bg-bottom',
                'left' => 'bg-left',
                'right' => 'bg-right',
                default => 'bg-center',
            };

            $classes[] = match ($properties['background_size'] ?? 'cover') {
                'contain' => 'bg-contain',
                'auto' => 'bg-auto',
                default => 'bg-cover',
            };

            $classes[] = match ($properties['background_repeat'] ?? 'no-repeat') {
                'repeat' => 'bg-repeat',
                'repeat-x' => 'bg-repeat-x',
                'repeat-y' => 'bg-repeat-y',
                default => 'bg-no-repeat',
            };
        }
    }

    protected function mapOverlay(array &$classes, array &$styles, array $properties): void
    {
        // Note: Overlay settings are handled in mapPosition() for positioning
        // This method is kept for potential future overlay-specific styling
        // The is_overlay setting controls absolute positioning and z-index
    }

    protected function parseColor($color)
    {
        if ($color === null || $color === false || $color === true || $color === '' || is_array($color)) {
            return null;
        }

        if ($color instanceof ColorInterface) {
            return $color;
        }

        if (!is_string($color)) {
            return null;
        }

        $color = trim($color);
        if ($color === '' || $color === 'false' || $color === 'true') {
            return null;
        }

        try {
            return ColorFactory::new($color);
        } catch (\Throwable $e) {
            return null;
        }
    }

    protected function parseGradient($gradient)
    {
        if ($gradient === null || $gradient === false || $gradient === true || $gradient === '') {
            return null;
        }

        if ($gradient instanceof GradientValue) {
            return $gradient;
        }

        if (is_array($gradient)) {
            try {
                return new GradientValue($gradient);
            } catch (\Throwable $e) {
                return null;
            }
        }

        if (is_string($gradient)) {
            return $gradient;
        }

        return null;
    }

    protected function toResponsiveValue($value): ResponsiveValue
    {
        if ($value instanceof ResponsiveValue) {
            return $value;
        }

        if (is_array($value) && isset($value['_default'])) {
            return new ResponsiveValue($value);
        }

        return new ResponsiveValue(['_default' => $value]);
    }

    protected function responsiveValuesEqual($a, $b): bool
    {
        $ra = $this->toResponsiveValue($a);
        $rb = $this->toResponsiveValue($b);

        $keys = array_unique(array_merge(array_keys($ra->all()), array_keys($rb->all())));
        foreach ($keys as $k) {
            if ($ra->get($k) != $rb->get($k)) {
                return false;
            }
        }
        return true;
    }
}
