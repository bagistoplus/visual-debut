<?php

namespace BagistoPlus\VisualDebut\Sections\Schemas;

use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\RichText;
use BagistoPlus\Visual\Settings\Select;
use BagistoPlus\Visual\Settings\Text;

use function BagistoPlus\VisualDebut\_t;

class ProductDetailsSchema
{
    public static function settings(): array
    {
        return [];
    }

    public static function blocks(): array
    {
        $positionSelect = Settings\Select::make('position', _t('product-details.settings.position_label'))
            ->options([
                'right' => _t('product-details.settings.position_right'),
                'under_gallery' => _t('product-details.settings.position_under_gallery'),
            ])
            ->default('right');

        return [
            Block::make('text', _t('product-details.blocks.text.name'))
                ->settings([
                    clone $positionSelect,
                    Settings\RichText::make('text', _t('product-details.blocks.text.settings.text_label')),
                ]),

            Block::make('title', _t('product-details.blocks.title.name'))
                ->limit(1)
                ->settings([
                    Select::make('tag', _t('product-details.blocks.title.settings.title_tag_label'))
                        ->options([
                            'h1' => 'h1',
                            'h2' => 'h2',
                            'h3' => 'h3',
                            'h4' => 'h4',
                            'h5' => 'h5',
                            'h6' => 'h6',
                            'p' => 'p'
                        ])->default('h1'),
                    Range::make('size', _t('product-details.blocks.title.settings.title_size'))
                        ->min(50)->max(150)->step(10)->unit('%')->default(100),
                    clone $positionSelect
                ]),

            Block::make('price', _t('product-details.blocks.price.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('rating', _t('product-details.blocks.rating.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('short-description', _t('product-details.blocks.short-description.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('quantity-selector', _t('product-details.blocks.quantity-selector.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('buy-buttons', _t('product-details.blocks.buy-buttons.name'))
                ->limit(2)
                ->settings([
                    clone $positionSelect,
                    Settings\Checkbox::make('enable_buy_now', _t('product-details.blocks.buy-buttons.settings.enable_buy_now_label'))
                        ->info(_t('product-details.blocks.buy-buttons.settings.enable_buy_now_info'))
                        ->default(true),
                ]),

            Block::make('description', _t('product-details.blocks.description.name'))
                ->limit(2)
                ->settings([
                    Checkbox::make('show_in_panel', _t('product-details.blocks.description.settings.show_in_panel_label'))
                        ->default(false),
                    Checkbox::make('should_open_panel', _t('product-details.blocks.description.settings.should_open_panel_label'))
                        ->default(true),
                    clone $positionSelect
                ]),

            Block::make('variant-picker', _t('product-details.blocks.variant-picker.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('grouped-options', _t('product-details.blocks.grouped-options.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('bundle-options', _t('product-details.blocks.bundle-options.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('downloadable-options', _t('product-details.blocks.downloadable-options.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('customizable-options', _t('product-details.blocks.customizable-options.name'))
                ->limit(1)
                ->settings([clone $positionSelect]),

            Block::make('collapsible', _t('product-details.blocks.collapsible.name'))
                ->settings([
                    Checkbox::make('should_open_panel', _t('product-details.blocks.collapsible.settings.should_open_panel_label'))
                        ->default(false),
                    Icon::make('icon', _t('product-details.blocks.collapsible.settings.icon_label')),
                    Text::make('heading', _t('product-details.blocks.collapsible.settings.heading_label'))
                        ->default(_t('product-details.blocks.collapsible.name')),
                    RichText::make('content', _t('product-details.blocks.collapsible.settings.content_label')),
                    clone $positionSelect
                ]),

            Block::make('separator', _t('product-details.blocks.separator.name'))
                ->settings([clone $positionSelect]),
        ];
    }

    public static function default(): array
    {
        return [
            'blocks' => [
                ['type' => 'title'],
                ['type' => 'price'],
                ['type' => 'rating'],
                ['type' => 'short-description'],
                ['type' => 'variant-picker'],
                ['type' => 'grouped-options'],
                ['type' => 'bundle-options'],
                ['type' => 'downloadable-options'],
                ['type' => 'customizable-options'],
                ['type' => 'quantity-selector'],
                ['type' => 'buy-buttons'],
                ['type' => 'separator'],
                [
                    'type' => 'description',
                    'settings' => [
                        'show_in_panel' => true
                    ]
                ],
            ],
        ];
    }
}
