<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings;
use BagistoPlus\Visual\Settings\ColorScheme;

use function BagistoPlus\VisualDebut\_t;

class Newsletter extends BladeSection
{
    protected static string $type = '@visual-debut/newsletter';
    protected static string $view = 'shop::sections.newsletter';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>';

    protected static string $category = 'Marketing';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/newsletter.png';

    public static function name(): string
    {
        return _t('sections.newsletter.name');
    }

    public static function description(): string
    {
        return _t('sections.newsletter.description');
    }

    public static function settings(): array
    {
        return [
            ColorScheme::make('scheme', _t('sections.newsletter.settings.scheme_label'))
                ->info(_t('sections.newsletter.settings.scheme_note')),

            Settings\Text::make('heading', _t('sections.newsletter.settings.heading_label'))
                ->default(_t('sections.newsletter.settings.heading_default')),

            Settings\RichText::make('description', _t('sections.newsletter.settings.description_label'))
                ->default(_t('sections.newsletter.settings.description_default')),
        ];
    }
}
