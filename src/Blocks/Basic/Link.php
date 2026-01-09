<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Link as LinkSetting;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Spacing;
use BagistoPlus\Visual\Settings\Text as TextSetting;
use BagistoPlus\Visual\Settings\Typography;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\VisualDebut\Tailwind;

use function BagistoPlus\VisualDebut\_t;

class Link extends SimpleBlock
{
    protected static string $type = '@visual-debut/link';

    protected static string $view = 'visual-debut::blocks.basic.link';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>';

    protected static string $category = 'Basic';

    public static function settings(): array
    {
        return [
            TextSetting::make('text', _t('blocks.link.settings.text_label'))
                ->default('Link'),

            LinkSetting::make('url', _t('blocks.link.settings.url_label'))
                ->default('/'),

            Checkbox::make('open_in_new_tab', _t('blocks.link.settings.open_in_new_tab_label'))
                ->default(false),

            Header::make(_t('blocks.link.settings.typography_header')),

            Typography::make('typography', _t('blocks.link.settings.typography_label'))
                ->info(_t('blocks.link.settings.typography_info')),

            Header::make(_t('blocks.link.settings.appearance_header')),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),

            Select::make('underline', _t('blocks.link.settings.underline_label'))
                ->options([
                    'none' => _t('blocks.link.settings.underline_options.none'),
                    'hover' => _t('blocks.link.settings.underline_options.hover'),
                    'always' => _t('blocks.link.settings.underline_options.always'),
                ])
                ->default('hover'),

            Header::make(_t('blocks.common.spacing_header')),

            Spacing::make('padding', _t('blocks.common.padding_label'))
                ->responsive()
                ->min(0)
                ->max(24),
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.link.presets.link.name'))
                ->category(_t('blocks.link.presets.link.category'))
                ->settings([
                    'text' => 'Link',
                    'url' => '/',
                ]),
        ];
    }

    protected function getViewData(): array
    {
        $paddingClasses = '';
        if ($this->block->settings->has('padding')) {
            $paddingClasses = Tailwind::responsive(
                $this->block->settings->padding,
                fn($v) => Tailwind::buildSpacingClasses($v, 'p')
            );
        }

        return [
            'paddingClasses' => $paddingClasses,
        ];
    }
}
