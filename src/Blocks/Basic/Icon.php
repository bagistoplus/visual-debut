<?php

namespace BagistoPlus\VisualDebut\Blocks\Basic;

use BagistoPlus\Visual\Blocks\SimpleBlock;
use BagistoPlus\Visual\Settings\Color;
use BagistoPlus\Visual\Settings\Icon as IconSetting;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class Icon extends SimpleBlock
{
    protected static string $type = '@visual-debut/icon';

    protected static string $view = 'visual-debut::blocks.basic.icon';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/></svg>';

    protected static string $category = 'Basic';

    public static function settings(): array
    {
        return [
            IconSetting::make('icon', _t('blocks.icon.settings.icon_label'))
                ->default('lucide-tag'),

            Select::make('size', _t('blocks.icon.settings.size_label'))
                ->options([
                    '4' => '16px',
                    '5' => '20px',
                    '6' => '24px',
                    '7' => '28px',
                    '8' => '32px',
                    '9' => '36px',
                    '10' => '40px',
                    '11' => '44px',
                    '12' => '48px',
                    '14' => '56px',
                    '16' => '64px',
                ])
                ->default('6')
                ->responsive(),

            Select::make('color', _t('blocks.icon.settings.color_label'))
                ->options([
                    'default' => _t('blocks.icon.settings.color_options.default'),
                    'primary' => _t('blocks.icon.settings.color_options.primary'),
                    'secondary' => _t('blocks.icon.settings.color_options.secondary'),
                    'accent' => _t('blocks.icon.settings.color_options.accent'),
                    'info' => _t('blocks.icon.settings.color_options.info'),
                    'success' => _t('blocks.icon.settings.color_options.success'),
                    'warning' => _t('blocks.icon.settings.color_options.warning'),
                    'danger' => _t('blocks.icon.settings.color_options.danger'),
                    'custom' => _t('blocks.icon.settings.color_options.custom'),
                ])
                ->default('default'),

            Color::make('custom_color', _t('blocks.icon.settings.custom_color_label'))
                ->default('#000000FF')
                ->visibleWhen(fn($rule) => $rule->when('color', 'custom')),
        ];
    }

}
