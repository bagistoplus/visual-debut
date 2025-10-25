<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\Visual\Settings;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Blocks\Basic\Logo;
use BagistoPlus\VisualDebut\Blocks\Container;
use BagistoPlus\VisualDebut\Blocks\Header\Cart;
use BagistoPlus\VisualDebut\Blocks\Header\Compare;
use BagistoPlus\VisualDebut\Blocks\Header\Currency;
use BagistoPlus\VisualDebut\Blocks\Header\Locale;
use BagistoPlus\VisualDebut\Blocks\Header\Nav;
use BagistoPlus\VisualDebut\Blocks\Header\Search;
use BagistoPlus\VisualDebut\Blocks\Header\User;
use Webkul\Category\Repositories\CategoryRepository;

use function BagistoPlus\VisualDebut\_t;

class Header extends BladeSection
{
    protected static string $type = '@visual-debut/header';

    protected static string $view = 'shop::sections.header';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="7" x="3" y="3" rx="1"/><rect width="18" height="7" x="3" y="14" rx="1"/></svg>';

    protected static string $category = 'Layout';

    protected static array $enabledOn = [
        'regions' => ['header']
    ];

    protected static string $wrapper = 'header';

    protected static array $accepts = [
        Logo::class,
        Nav::class,
        Currency::class,
        Locale::class,
        Search::class,
        Compare::class,
        User::class,
        Cart::class,
        Container::class
    ];

    public static function name(): string
    {
        return _t('sections.header.name');
    }

    public static function description(): string
    {
        return _t('sections.header.description');
    }

    public static function settings(): array
    {
        return [
            Settings\Select::make('content_width', _t('sections.header.settings.content_width_label'))
                ->options([
                    'container' => _t('sections.header.settings.content_width_container'),
                    'fullwidth' => _t('sections.header.settings.content_width_fullwidth'),
                ])
                ->asSegment()
                ->default('container'),
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('sections.header.presets.default.name'))
                ->category('Layout')
                ->blocks([
                    // Logo Group
                    PresetBlock::make('@visual-debut/container')
                        ->name('Logo')
                        ->settings([
                            'layout_type' => 'flex',
                            'flex_direction' => 'row',
                            'align_items' => 'center',
                            'flex_gap' => 4,
                        ])
                        ->blocks([
                            PresetBlock::make('@visual-debut/logo'),
                        ]),

                    // Navigation Group
                    PresetBlock::make('@visual-debut/container')
                        ->name('Navigation')
                        ->settings([
                            'layout_type' => 'flex',
                            'flex_direction' => 'row',
                            'align_items' => 'center',
                            'flex_gap' => 4,
                            'width' => [
                                '_default' => 'full',
                            ],
                        ])
                        ->blocks([
                            PresetBlock::make('@visual-debut/header-nav'),
                        ]),

                    // Actions Group
                    PresetBlock::make('@visual-debut/container')
                        ->name('Actions')
                        ->settings([
                            'layout_type' => 'flex',
                            'flex_direction' => 'row',
                            'justify_content' => 'end',
                            'align_items' => 'center',
                            'flex_gap' => [
                                '_default' => 2,
                            ],
                        ])
                        ->blocks([
                            PresetBlock::make('@visual-debut/header-currency'),
                            PresetBlock::make('@visual-debut/header-locale'),
                            PresetBlock::make('@visual-debut/header-search'),
                            PresetBlock::make('@visual-debut/header-compare'),
                            PresetBlock::make('@visual-debut/header-user'),
                            PresetBlock::make('@visual-debut/header-cart'),
                        ]),
                ]),
        ];
    }

    public static function default(): array
    {
        return [
            'blocks' => [
                ['type' => '@visual-debut/logo'],
                ['type' => '@visual-debut/header-nav'],
                ['type' => '@visual-debut/header-currency'],
                ['type' => '@visual-debut/header-locale'],
                ['type' => '@visual-debut/header-search'],
                ['type' => '@visual-debut/header-compare'],
                ['type' => '@visual-debut/header-user'],
                ['type' => '@visual-debut/header-cart'],
            ],
        ];
    }

    public function getCategories()
    {
        // @phpstan-ignore-next-line
        $rootCategoryId = core()->getCurrentChannel()->root_category_id;

        $categories = app(CategoryRepository::class)->getVisibleCategoryTree($rootCategoryId);

        return $categories->filter(fn($c) => (bool) $c->slug);
    }
}
