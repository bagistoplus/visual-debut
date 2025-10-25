<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualDebut\_t;

class FooterLink extends BladeBlock
{
    protected static string $type = '@visual-debut/link';

    protected static string $view = 'visual-debut::blocks.footer-link';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>';

    protected static string $category = 'Navigation';

    public static function settings(): array
    {
        return [
            Text::make('text', _t('blocks.link.settings.text_label'))
                ->default(_t('blocks.link.settings.text_default')),

            Link::make('link', _t('blocks.link.settings.link_label'))
                ->default('/'),
        ];
    }

}
