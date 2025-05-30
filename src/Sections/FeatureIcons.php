<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Facades\ThemeEditor;
use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Settings\Textarea;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class FeatureIcons extends BladeSection
{
    protected static string $view = 'shop::sections.feature-icons';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/feature-icons.png';

    public static function name(): string
    {
        return _t('feature-icons.name');
    }

    public static function description(): string
    {
        return _t('feature-icons.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('heading', _t('feature-icons.settings.heading_label')),
            Text::make('description', _t('feature-icons.settings.description_label')),

            Range::make('icon_size', _t('feature-icons.settings.icon_size_label'))
                ->min(16)->max(40)->step(4)->unit('px')->default(24),

            Range::make('columns', _t('feature-icons.settings.columns_label'))
                ->min(3)->max(6)->step(1)->default(4),

            Select::make('layout', _t('feature-icons.settings.layout_label'))
                ->options([
                    'horizontal' => _t('feature-icons.settings.layout_horizontal'),
                    'vertical'   => _t('feature-icons.settings.layout_vertical'),
                ])->default('vertical'),
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('feature', _t('feature-icons.blocks.feature.label'))
                ->settings([
                    Icon::make('icon', _t('feature-icons.blocks.feature.settings.icon_label')),
                    Text::make('title', _t('feature-icons.blocks.feature.settings.title_label')),
                    Textarea::make('text', _t('feature-icons.blocks.feature.settings.text_label')),
                ]),
        ];
    }

    protected static array $default = [
        'settings' => [
            'heading'     => 'Why Shop With Us?',
            'description' => 'Explore our customer-focused features',
            'icon_size'   => 24,
            'columns'     => 4,
            'layout'      => 'vertical',
        ],
        'blocks' => [],
    ];

    public function getFeatures(): array
    {
        if (count($this->section->blocks) > 0) {
            return collect($this->section->blocks)->map(fn($block) => [
                'icon'  => $block->settings->icon ?? null,
                'title' => $block->settings->title ?? '',
                'text'  => $block->settings->text ?? '',
                'liveUpdateTitle' => $block->liveUpdate()->text('title'),
                'liveUpdateText'  => $block->liveUpdate()->text('text'),
            ])->all();
        }

        if (ThemeEditor::inDesignMode()) {
            return array_fill(0, 4, [
                'icon'  => null,
                'title' => _t('feature-icons.placeholders.title'),
                'text'  => _t('feature-icons.placeholders.text'),
            ]);
        }

        return [];
    }
}
