<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualDebut\_t;

class FooterGroup extends BladeBlock
{
    protected static string $type = '@visual-debut/group';

    protected static string $view = 'visual-debut::blocks.footer-group';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9h18v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9Z"/><path d="m3 9 2.45-4.9A2 2 0 0 1 7.24 3h9.52a2 2 0 0 1 1.8 1.1L21 9"/><path d="M12 3v6"/></svg>';

    protected static string $category = 'Navigation';

    public static function settings(): array
    {
        return [
            Text::make('title', _t('blocks.group.settings.title_label'))
                ->default(_t('blocks.group.settings.title_default')),
        ];
    }

}
