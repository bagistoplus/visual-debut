<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings;

use function BagistoPlus\VisualDebut\_t;

class HeroBanner extends BladeSection
{
    protected static string $view = 'shop::sections.hero-banner';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/hero-banner.png';

    public static function name(): string
    {
        return _t('hero-banner.name');
    }

    public static function description(): string
    {
        return _t('hero-banner.description');
    }

    public static function settings(): array
    {
        // section settings
        return [
            Settings\ColorScheme::make('scheme', _t('hero-banner.settings.scheme_label'))
                ->info(_t('hero-banner.settings.scheme_note')),

            Settings\Image::make('background', _t('hero-banner.settings.background_label')),

            Settings\Range::make('overlay_opacity', _t('hero-banner.settings.overlay_opacity_label'))
                ->min(0)->max(100)->step(5)->default(50),

            Settings\Select::make('height', _t('hero-banner.settings.height_label'))
                ->options([
                    'small'      => 'Small',
                    'medium'     => 'Medium',
                    'large'      => 'Large',
                    'fullheight' => 'Full Height',
                ])
                ->default('medium'),
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('heading', _t('hero-banner.blocks.heading.name'))
                ->settings([
                    Settings\Text::make('text', _t('hero-banner.blocks.heading.text_label'))
                        ->default(_t('hero-banner.blocks.heading.default_text')),
                ])
                ->limit(1),

            Block::make('subtext', _t('hero-banner.blocks.subtext.name'))
                ->settings([
                    Settings\Text::make('text', _t('hero-banner.blocks.subtext.text_label'))
                        ->default(_t('hero-banner.blocks.subtext.default_text')),
                ])
                ->limit(1),

            Block::make('button', _t('hero-banner.blocks.button.name'))
                ->settings([
                    Settings\Text::make('text', _t('hero-banner.blocks.button.text_label'))
                        ->default(_t('hero-banner.blocks.button.default_text')),

                    Settings\Link::make('link', _t('hero-banner.blocks.button.link_label'))
                        ->default('/'),

                    Settings\Select::make('color', _t('hero-banner.blocks.button.color_label'))
                        ->options([
                            'primary' => 'Primary',
                            'secondary' => 'Secondary'
                        ])
                        ->default('primary')
                ])
                ->limit(2),
        ];
    }

    public static function default(): array
    {
        return [
            'settings' => [
                'background'      => asset('themes/shop/visual-debut/images/hero-banner.avif'),
            ],

            'blocks' => [
                ['type'     => 'heading'],
                ['type'     => 'subtext'],
                ['type'     => 'button'],
            ],
        ];
    }
}
