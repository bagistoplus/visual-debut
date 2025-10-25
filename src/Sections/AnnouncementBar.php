<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualDebut\_t;

class AnnouncementBar extends BladeSection
{
    protected static string $type = '@visual-debut/announcement-bar';

    protected static string $view = 'shop::sections.announcement-bar';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>';

    protected static string $category = 'Marketing';

    protected static array $enabledOn = [
        'regions' => ['header']
    ];

    public static function settings(): array
    {
        return [
            Text::make('text', _t('sections.announcement-bar.settings.text_label'))
                ->default(_t('sections.announcement-bar.settings.default_text')),

            Link::make('link', _t('sections.announcement-bar.settings.link_label')),

            Select::make('variant', _t('sections.announcement-bar.settings.variant_label'))
                ->options([
                    'primary'   => 'Primary',
                    'secondary' => 'Secondary',
                    'accent'    => 'Accent',
                    'neutral'   => 'Neutral',
                ])->default('primary'),

            ColorScheme::make('scheme', _t('sections.announcement-bar.settings.scheme_label'))
                ->info(_t('sections.announcement-bar.settings.scheme_note')),
        ];
    }
}
