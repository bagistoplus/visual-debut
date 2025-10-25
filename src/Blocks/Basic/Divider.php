<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\VisualDebut\Tailwind;

use function BagistoPlus\VisualDebut\_t;

class Divider extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.basic.divider';

    protected static string $type = '@visual-debut/divider';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="12" y2="12"/></svg>';

    protected static string $category = 'Basic';

    public static function settings(): array
    {
        return [
            Range::make('thickness', _t('blocks.divider.settings.thickness_label'))
                ->min(0.5)
                ->max(5)
                ->step(0.5)
                ->unit('px')
                ->default(1)
                ->info(_t('blocks.divider.settings.thickness_info')),

            Select::make('corner_radius', _t('blocks.divider.settings.corner_radius_label'))
                ->options([
                    'square' => _t('blocks.divider.settings.corner_radius_options.square'),
                    'rounded' => _t('blocks.divider.settings.corner_radius_options.rounded'),
                ])
                ->default('square')
                ->visibleWhen(fn($rule) => $rule->whenGt('thickness', 1)),

            Range::make('width_percent', _t('blocks.divider.settings.width_percent_label'))
                ->min(5)
                ->max(100)
                ->step(1)
                ->unit('%')
                ->default(100)
                ->info(_t('blocks.divider.settings.width_percent_info')),

            Select::make('alignment', _t('blocks.divider.settings.alignment_label'))
                ->options([
                    'left' => _t('blocks.divider.settings.alignment_options.left'),
                    'center' => _t('blocks.divider.settings.alignment_options.center'),
                    'right' => _t('blocks.divider.settings.alignment_options.right'),
                ])
                ->default('center')
                ->info(_t('blocks.divider.settings.alignment_info')),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            Header::make(_t('blocks.divider.settings.padding_header')),

            Range::make('padding_top', _t('blocks.divider.settings.padding_top_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(['_default' => 0])
                ->responsive(),

            Range::make('padding_bottom', _t('blocks.divider.settings.padding_bottom_label'))
                ->min(0)
                ->max(24)
                ->step(1)
                ->default(['_default' => 0])
                ->responsive(),
        ];
    }

    protected function getViewData(): array
    {
        $alignmentClasses = [
            'left' => 'justify-start',
            'center' => 'justify-center',
            'right' => 'justify-end',
        ];

        $paddingTop = $this->block->settings->padding_top ?? ['_default' => 0];
        $paddingBottom = $this->block->settings->padding_bottom ?? ['_default' => 0];

        $paddingClasses = implode(' ', [
            Tailwind::responsive($paddingTop, fn($v) => "pt-{$v}"),
            Tailwind::responsive($paddingBottom, fn($v) => "pb-{$v}"),
        ]);

        return [
            'thickness' => $this->block->settings->thickness,
            'cornerRadius' => $this->block->settings->corner_radius === 'rounded' ? '0.25rem' : '0',
            'widthPercent' => $this->block->settings->width_percent,
            'alignmentClass' => $alignmentClasses[$this->block->settings->alignment] ?? 'justify-center',
            'paddingClasses' => $paddingClasses,
        ];
    }
}
