<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualDebut\_t;

class Logo extends SimpleBlock
{
    protected static string $view = 'visual-debut::blocks.basic.logo';

    protected static string $type = '@visual-debut/logo';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a3 3 0 0 0-3 3v3h6V6a3 3 0 0 0-3-3z"/><path d="M12 9v12"/><path d="M9 12H3"/><path d="M21 12h-6"/></svg>';

    protected static string $category = 'Basic';

    public static function name(): string
    {
        return _t('blocks.logo.name');
    }

    public static function description(): string
    {
        return _t('blocks.logo.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('logo_text', _t('blocks.logo.settings.logo_text_label'))
                ->placeholder(_t('blocks.logo.settings.logo_text_placeholder'))
                ->info(_t('blocks.logo.settings.logo_text_info')),

            ColorScheme::make('color_scheme', _t('blocks.common.color_scheme_label'))
                ->info(_t('blocks.common.color_scheme_info')),
        ];
    }

}
