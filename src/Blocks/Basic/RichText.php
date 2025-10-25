<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\RichText as RichTextSetting;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class RichText extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.basic.richtext';

    protected static string $type = '@visual-debut/richtext';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/></svg>';

    protected static string $category = 'Basic';

    public static function settings(): array
    {
        return [
            RichTextSetting::make('content', _t('blocks.richtext.settings.content_label'))
                ->default('<p>Add your content here</p>'),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            Header::make(_t('blocks.richtext.settings.layout_header')),

            Select::make('width', _t('blocks.richtext.settings.width_label'))
                ->options([
                    'fit-content' => _t('blocks.richtext.settings.width_options.fit'),
                    '100%' => _t('blocks.richtext.settings.width_options.fill'),
                ])
                ->default('100%'),

            Select::make('max_width', _t('blocks.richtext.settings.max_width_label'))
                ->options([
                    'narrow' => _t('blocks.richtext.settings.max_width_options.narrow'),
                    'normal' => _t('blocks.richtext.settings.max_width_options.normal'),
                    'wide' => _t('blocks.richtext.settings.max_width_options.wide'),
                    'none' => _t('blocks.richtext.settings.max_width_options.none'),
                ])
                ->default('normal'),

            Select::make('alignment', _t('blocks.richtext.settings.alignment_label'))
                ->options([
                    'left' => _t('blocks.richtext.settings.alignment_options.left'),
                    'center' => _t('blocks.richtext.settings.alignment_options.center'),
                    'right' => _t('blocks.richtext.settings.alignment_options.right'),
                ])
                ->default('left')
                ->visibleWhen(fn($rule) => $rule->when('width', '100%')),

            Header::make(_t('blocks.richtext.settings.padding_header')),

            Range::make('padding_top', _t('blocks.richtext.settings.padding_top_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->unit('px')
                ->default(0),

            Range::make('padding_bottom', _t('blocks.richtext.settings.padding_bottom_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->unit('px')
                ->default(0),

            Range::make('padding_left', _t('blocks.richtext.settings.padding_left_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->unit('px')
                ->default(0),

            Range::make('padding_right', _t('blocks.richtext.settings.padding_right_label'))
                ->min(0)
                ->max(100)
                ->step(1)
                ->unit('px')
                ->default(0),
        ];
    }

    protected function getViewData(): array
    {
        // Width classes
        $widthClass = $this->block->settings->width === '100%' ? 'w-full' : 'w-fit';

        // Max width classes
        $maxWidthClasses = [
            'narrow' => 'max-w-prose',
            'normal' => 'max-w-2xl',
            'wide' => 'max-w-4xl',
            'none' => 'max-w-none',
        ];
        $maxWidthClass = $maxWidthClasses[$this->block->settings->max_width] ?? 'max-w-2xl';

        // Alignment classes
        $alignmentClasses = [
            'left' => 'text-left',
            'center' => 'text-center mx-auto',
            'right' => 'text-right ml-auto',
        ];
        $alignmentClass = $alignmentClasses[$this->block->settings->alignment] ?? 'text-left';

        return [
            'content' => $this->block->settings->content,
            'widthClass' => $widthClass,
            'maxWidthClass' => $maxWidthClass,
            'alignmentClass' => $alignmentClass,
            'paddingTop' => $this->block->settings->padding_top,
            'paddingBottom' => $this->block->settings->padding_bottom,
            'paddingLeft' => $this->block->settings->padding_left,
            'paddingRight' => $this->block->settings->padding_right,
        ];
    }
}
