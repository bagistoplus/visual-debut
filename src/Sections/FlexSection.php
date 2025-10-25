<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Settings\Color;
use BagistoPlus\Visual\Settings\Image;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Select;
use function BagistoPlus\VisualDebut\_t;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Gradient;
use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\VisualDebut\Tailwind;
use BagistoPlus\VisualDebut\Presets\CustomSection;
use BagistoPlus\VisualDebut\Presets\RichTextSection;
use BagistoPlus\VisualDebut\Presets\FaqSection;
use BagistoPlus\VisualDebut\Presets\HeroBanner;
use BagistoPlus\VisualDebut\Presets\TextWithImage;
use BagistoPlus\VisualDebut\Presets\FeatureIcons;

class FlexSection extends BladeSection
{
    protected static string $type = '@visual-debut/flex-section';

    protected static string $view = 'shop::sections.flex-section';
    protected static array $accepts = ['*'];
    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 12h18"/></svg>';
    protected static string $category = 'Layout';

    public string $outerClass = '';
    public string $outerStyle = '';
    public string $overlayClass = '';
    public string $overlayStyle = '';
    public string $flexClass = '';
    public string $flexStyle = '';

    public static function name(): string
    {
        return _t('sections.flex-section.name');
    }

    public static function description(): string
    {
        return _t('sections.flex-section.description');
    }

    protected function getViewData(): array
    {
        $this->computeStyles();
        return [];
    }

    protected function computeStyles(): void
    {
        $this->computeOuterStyles();
        $this->computeOverlayStyles();
        $this->computeFlexStyles();
    }

    protected function computeOuterStyles(): void
    {
        $classes = [];
        $styles = [];
        $s = $this->section->settings;

        // Background
        $bgType = $s->background_type ?? 'none';

        if ($bgType === 'color' && $s->background_color) {
            $styles[] = "background-color: {$s->background_color}";
        } elseif ($bgType === 'gradient' && $s->background_gradient) {
            $styles[] = "background-image: {$s->background_gradient}";
        } elseif ($bgType === 'image' && $s->background_image) {
            $styles[] = "background-image: url('{$s->background_image}')";

            $classes[] = match ($s->background_position ?? 'center') {
                'top' => 'bg-top',
                'bottom' => 'bg-bottom',
                'left' => 'bg-left',
                'right' => 'bg-right',
                default => 'bg-center',
            };

            $classes[] = match ($s->background_size ?? 'cover') {
                'contain' => 'bg-contain',
                'auto' => 'bg-auto',
                default => 'bg-cover',
            };

            $classes[] = match ($s->background_repeat ?? 'no-repeat') {
                'repeat' => 'bg-repeat',
                'repeat-x' => 'bg-repeat-x',
                'repeat-y' => 'bg-repeat-y',
                default => 'bg-no-repeat',
            };
        }

        // Border
        if ($s->border ?? false) {
            $borderWidth = $s->border_width ?? 1;
            $borderOpacity = ($s->border_opacity ?? 100) / 100;
            $classes[] = 'border-on-surface';
            $styles[] = "border-width: {$borderWidth}px";
            $styles[] = "border-style: solid";
            $styles[] = "border-color: rgba(var(--color-on-surface), {$borderOpacity})";
        }

        // Border radius
        if (isset($s->border_radius) && $s->border_radius !== 'none') {
            $classes[] = match ($s->border_radius) {
                'sm' => 'rounded-sm',
                'md' => 'rounded-md',
                'lg' => 'rounded-lg',
                'xl' => 'rounded-xl',
                'full' => 'rounded-full',
                default => '',
            };
        }

        $this->outerClass = implode(' ', array_filter($classes));
        $this->outerStyle = implode('; ', $styles);
    }

    protected function computeOverlayStyles(): void
    {
        $s = $this->section->settings;

        if (!($s->toggle_overlay ?? false)) {
            return;
        }

        $styles = [];
        $overlayStyle = $s->overlay_style ?? 'solid';

        if ($overlayStyle === 'gradient' && $s->overlay_gradient) {
            $styles[] = "background-image: {$s->overlay_gradient}";
        } elseif ($overlayStyle === 'solid' && $s->overlay_color) {
            $styles[] = "background-color: {$s->overlay_color}";
        }

        $this->overlayStyle = implode('; ', $styles);
    }

    protected function computeFlexStyles(): void
    {
        $classes = [];
        $styles = [];
        $s = $this->section->settings;

        // Flex direction (responsive)
        $flexDir = $s->flex_direction ?? ['_default' => 'column'];
        $classes[] = Tailwind::responsive($flexDir, fn($v) => match ($v) {
            'row' => 'flex-row',
            'row-reverse' => 'flex-row-reverse',
            'column' => 'flex-col',
            'column-reverse' => 'flex-col-reverse',
            default => 'flex-col',
        });

        // Justify content
        $classes[] = match ($s->justify_content ?? 'center') {
            'start' => 'justify-start',
            'end' => 'justify-end',
            'center' => 'justify-center',
            'between' => 'justify-between',
            'around' => 'justify-around',
            'evenly' => 'justify-evenly',
            default => 'justify-center',
        };

        // Align items
        $classes[] = match ($s->align_items ?? 'center') {
            'start' => 'items-start',
            'end' => 'items-end',
            'center' => 'items-center',
            'stretch' => 'items-stretch',
            'baseline' => 'items-baseline',
            default => 'items-center',
        };

        // Gap (responsive)
        $gap = $s->flex_gap ?? ['_default' => 4];
        $classes[] = Tailwind::responsive($gap, fn($v) => "gap-{$v}");

        // Padding (responsive)
        $this->addResponsivePadding($classes, 'padding_top', 'pt');
        $this->addResponsivePadding($classes, 'padding_bottom', 'pb');
        $this->addResponsivePadding($classes, 'padding_left', 'pl');
        $this->addResponsivePadding($classes, 'padding_right', 'pr');

        $this->flexClass = implode(' ', array_filter($classes));
        $this->flexStyle = implode('; ', $styles);
    }

    protected function addResponsivePadding(array &$classes, string $setting, string $prefix): void
    {
        $s = $this->section->settings;
        $value = $s->$setting ?? ['_default' => 0];

        $classes[] = Tailwind::responsive($value, fn($v) => "{$prefix}-{$v}");
    }

    public static function settings(): array
    {
        return [
            Header::make(_t('sections.flex-section.settings.layout_header')),

            Select::make('flex_direction', _t('sections.flex-section.settings.flex_direction_label'))
                ->options([
                    'row' => _t('sections.flex-section.settings.flex_direction_options.row'),
                    'row-reverse' => _t('sections.flex-section.settings.flex_direction_options.row_reverse'),
                    'column' => _t('sections.flex-section.settings.flex_direction_options.column'),
                    'column-reverse' => _t('sections.flex-section.settings.flex_direction_options.column_reverse'),
                ])
                ->default('column')
                ->responsive()
                ->info(_t('sections.flex-section.settings.flex_direction_info')),

            Select::make('justify_content', _t('sections.flex-section.settings.justify_content_label'))
                ->options([
                    'start' => _t('sections.flex-section.settings.justify_content_options.start'),
                    'center' => _t('sections.flex-section.settings.justify_content_options.center'),
                    'end' => _t('sections.flex-section.settings.justify_content_options.end'),
                    'between' => _t('sections.flex-section.settings.justify_content_options.between'),
                    'around' => _t('sections.flex-section.settings.justify_content_options.around'),
                    'evenly' => _t('sections.flex-section.settings.justify_content_options.evenly'),
                ])
                ->default('center'),

            Select::make('align_items', _t('sections.flex-section.settings.align_items_label'))
                ->options([
                    'start' => _t('sections.flex-section.settings.align_items_options.start'),
                    'center' => _t('sections.flex-section.settings.align_items_options.center'),
                    'end' => _t('sections.flex-section.settings.align_items_options.end'),
                    'stretch' => _t('sections.flex-section.settings.align_items_options.stretch'),
                    'baseline' => _t('sections.flex-section.settings.align_items_options.baseline'),
                ])
                ->default('center'),

            Range::make('flex_gap', _t('sections.flex-section.settings.gap_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(4)
                ->responsive()
                ->info(_t('sections.flex-section.settings.gap_info')),

            Header::make(_t('sections.flex-section.settings.size_header')),

            Select::make('section_width', _t('sections.flex-section.settings.section_width_label'))
                ->options([
                    'full' => _t('sections.flex-section.settings.section_width_options.full'),
                    'container' => _t('sections.flex-section.settings.section_width_options.container'),
                ])
                ->asSegment()
                ->default('container'),

            Select::make('section_height', _t('sections.flex-section.settings.section_height_label'))
                ->options([
                    'auto' => _t('sections.flex-section.settings.section_height_options.auto'),
                    'xs' => _t('sections.flex-section.settings.section_height_options.xs'),
                    'sm' => _t('sections.flex-section.settings.section_height_options.sm'),
                    'md' => _t('sections.flex-section.settings.section_height_options.md'),
                    'lg' => _t('sections.flex-section.settings.section_height_options.lg'),
                    'screen' => _t('sections.flex-section.settings.section_height_options.screen'),
                    'custom' => _t('sections.flex-section.settings.section_height_options.custom'),
                ])
                ->default('auto'),

            Range::make('section_height_custom', _t('sections.flex-section.settings.section_height_custom_label'))
                ->min(200)
                ->max(1000)
                ->step(50)
                ->default(600)
                ->unit('px')
                ->visibleWhen(fn($rule) => $rule->when('section_height', 'custom')),

            Header::make(_t('sections.flex-section.settings.appearance_header')),

            Select::make('background_type', _t('sections.flex-section.settings.background_type_label'))
                ->options([
                    'none' => _t('sections.flex-section.settings.background_type_options.none'),
                    'color' => _t('sections.flex-section.settings.background_type_options.color'),
                    'gradient' => _t('sections.flex-section.settings.background_type_options.gradient'),
                    'image' => _t('sections.flex-section.settings.background_type_options.image'),
                ])
                ->asSegment()
                ->default('none'),

            Color::make('background_color', _t('sections.flex-section.settings.background_color_label'))
                ->default('rgba(0, 0, 0, 0)')
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'color')),

            Gradient::make('background_gradient', _t('sections.flex-section.settings.background_gradient_label'))
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'gradient')),

            Image::make('background_image', _t('sections.flex-section.settings.background_image_label'))
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'image')),

            Select::make('background_position', _t('sections.flex-section.settings.background_position_label'))
                ->options([
                    'center' => _t('sections.flex-section.settings.background_position_options.center'),
                    'top' => _t('sections.flex-section.settings.background_position_options.top'),
                    'bottom' => _t('sections.flex-section.settings.background_position_options.bottom'),
                    'left' => _t('sections.flex-section.settings.background_position_options.left'),
                    'right' => _t('sections.flex-section.settings.background_position_options.right'),
                ])
                ->default('center')
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'image')),

            Select::make('background_size', _t('sections.flex-section.settings.background_size_label'))
                ->options([
                    'cover' => _t('sections.flex-section.settings.background_size_options.cover'),
                    'contain' => _t('sections.flex-section.settings.background_size_options.contain'),
                    'auto' => _t('sections.flex-section.settings.background_size_options.auto'),
                ])
                ->default('cover')
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'image')),

            Select::make('background_repeat', _t('sections.flex-section.settings.background_repeat_label'))
                ->options([
                    'no-repeat' => _t('sections.flex-section.settings.background_repeat_options.no_repeat'),
                    'repeat' => _t('sections.flex-section.settings.background_repeat_options.repeat'),
                    'repeat-x' => _t('sections.flex-section.settings.background_repeat_options.repeat_x'),
                    'repeat-y' => _t('sections.flex-section.settings.background_repeat_options.repeat_y'),
                ])
                ->default('no-repeat')
                ->visibleWhen(fn($rule) => $rule->when('background_type', 'image')),

            Checkbox::make('border', _t('sections.flex-section.settings.border_label'))
                ->default(false),

            Range::make('border_width', _t('sections.flex-section.settings.border_width_label'))
                ->min(1)
                ->max(8)
                ->step(1)
                ->default(1)
                ->unit('px')
                ->visibleWhen(fn($rule) => $rule->whenTruthy('border')),

            Range::make('border_opacity', _t('sections.flex-section.settings.border_opacity_label'))
                ->min(0)
                ->max(100)
                ->step(5)
                ->default(100)
                ->unit('%')
                ->visibleWhen(fn($rule) => $rule->whenTruthy('border')),

            Select::make('border_radius', _t('sections.flex-section.settings.border_radius_label'))
                ->options([
                    'none' => _t('sections.flex-section.settings.border_radius_options.none'),
                    'sm' => _t('sections.flex-section.settings.border_radius_options.sm'),
                    'md' => _t('sections.flex-section.settings.border_radius_options.md'),
                    'lg' => _t('sections.flex-section.settings.border_radius_options.lg'),
                    'xl' => _t('sections.flex-section.settings.border_radius_options.xl'),
                    'full' => _t('sections.flex-section.settings.border_radius_options.full'),
                ])
                ->default('none'),

            Checkbox::make('toggle_overlay', _t('sections.flex-section.settings.toggle_overlay_label'))
                ->default(false)
                ->info(_t('sections.flex-section.settings.toggle_overlay_info')),

            Select::make('overlay_style', _t('sections.flex-section.settings.overlay_style_label'))
                ->options([
                    'solid' => _t('sections.flex-section.settings.overlay_style_options.solid'),
                    'gradient' => _t('sections.flex-section.settings.overlay_style_options.gradient'),
                ])
                ->default('solid')
                ->asSegment()
                ->visibleWhen(fn($rule) => $rule->whenTruthy('toggle_overlay')),

            Color::make('overlay_color', _t('sections.flex-section.settings.overlay_color_label'))
                ->default('rgba(0, 0, 0, 0.5)')
                ->visibleWhen(fn($rule) => $rule->whenTruthy('toggle_overlay')->when('overlay_style', 'solid')),

            Gradient::make('overlay_gradient', _t('sections.flex-section.settings.overlay_gradient_label'))
                ->visibleWhen(fn($rule) => $rule->whenTruthy('toggle_overlay')->when('overlay_style', 'gradient')),

            Header::make(_t('sections.flex-section.settings.spacing_header')),

            Range::make('padding_top', _t('sections.flex-section.settings.padding_top_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(12)
                ->responsive(),

            Range::make('padding_bottom', _t('sections.flex-section.settings.padding_bottom_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(12)
                ->responsive(),

            Range::make('padding_left', _t('sections.flex-section.settings.padding_left_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),

            Range::make('padding_right', _t('sections.flex-section.settings.padding_right_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(0)
                ->responsive(),
        ];
    }

    public static function presets(): array
    {
        return [
            CustomSection::class,
            RichTextSection::class,
            FaqSection::class,
            HeroBanner::class,
            TextWithImage::class,
            FeatureIcons::class,
        ];
    }
}
