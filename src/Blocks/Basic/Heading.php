<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings;
use BagistoPlus\VisualDebut\Blocks\Basic\Text;

use function BagistoPlus\VisualDebut\_t;

class Heading extends SimpleBlock
{
    protected static string $type = '@visual-debut/heading';
    protected static string $view = 'visual-debut::blocks.heading';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h12"/><path d="M6 20V4"/><path d="M18 20V4"/></svg>';

    protected static string $category = 'Text';

    public static function settings(): array
    {
        return array_merge(
            [
                Settings\Text::make('text', _t('blocks.text.settings.text_label'))
                    ->default('Add your heading here'),

                Settings\Select::make('heading_level', _t('blocks.heading.heading_level_label'))
                    ->options([
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                    ])
                    ->asSegment()
                    ->default('h2'),
            ],
            Text::stylingSettings()
        );
    }
}
