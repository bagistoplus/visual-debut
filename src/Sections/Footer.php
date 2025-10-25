<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings\ColorScheme;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\VisualDebut\Presets\ClassicFooter;
use BagistoPlus\VisualDebut\Presets\MinimalFooter;
use BagistoPlus\VisualDebut\Presets\NewsletterFooter;

use function BagistoPlus\VisualDebut\_t;

class Footer extends BladeSection
{
    protected static string $type = '@visual-debut/footer';

    protected static string $view = 'shop::sections.footer';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="7" x="3" y="3" rx="1"/><rect width="18" height="7" x="3" y="14" rx="1"/></svg>';

    protected static string $category = 'Layout';

    protected static array $enabledOn = [
        'regions' => ['footer']
    ];

    protected static string $wrapper = 'footer';

    protected static array $accepts = ['*'];

    public static function name(): string
    {
        return _t('sections.footer.name');
    }

    public static function description(): string
    {
        return _t('sections.footer.description');
    }

    public static function settings(): array
    {
        return [
            Header::make(_t('sections.footer.settings.layout_header')),

            Select::make('content_width', _t('sections.footer.settings.content_width_label'))
                ->options([
                    'full' => _t('sections.footer.settings.content_width_options.full'),
                    'container' => _t('sections.footer.settings.content_width_options.container'),
                ])
                ->default('container')
                ->info(_t('sections.footer.settings.content_width_info')),

            Header::make(_t('sections.footer.settings.spacing_header')),

            Range::make('padding_top', _t('sections.footer.settings.padding_top_label'))
                ->min(0)->max(24)->step(1)
                ->default(['_default' => 12])
                ->responsive(),

            Range::make('padding_bottom', _t('sections.footer.settings.padding_bottom_label'))
                ->min(0)->max(24)->step(1)
                ->default(['_default' => 12])
                ->responsive(),

            Header::make(_t('sections.footer.settings.appearance_header')),

            ColorScheme::make('color_scheme', _t('sections.footer.settings.color_scheme_label'))
                ->default(null)
                ->info(_t('sections.footer.settings.color_scheme_info')),
        ];
    }

    public static function presets(): array
    {
        return [
            ClassicFooter::class,
            MinimalFooter::class,
            NewsletterFooter::class,
        ];
    }
}
