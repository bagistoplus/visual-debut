<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\Visual\Blocks\BladeBlock;
use BagistoPlus\Visual\Settings\Checkbox;
use BagistoPlus\Visual\Settings\Header;
use BagistoPlus\Visual\Settings\Icon;
use BagistoPlus\Visual\Settings\Range;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class AccordionRow extends BladeBlock
{
    protected static string $type = '@visual-debut/accordion-row';
    protected static string $view = 'visual-debut::blocks.accordion-row';
    protected static array $accepts = ['*'];
    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h13"/><path d="M8 12h13"/><path d="M8 18h13"/><path d="M3 6h.01"/><path d="M3 12h.01"/><path d="M3 18h.01"/></svg>';
    protected static string $category = 'Layout';

    public static function settings(): array
    {
        return [
            Text::make('heading', _t('blocks.accordion-row.settings.heading_label'))
                ->default('Accordion Item'),

            Checkbox::make('open_by_default', _t('blocks.accordion-row.settings.open_by_default_label'))
                ->default(false),

            Header::make(_t('blocks.accordion-row.settings.icon_header')),

            Icon::make('icon', _t('blocks.accordion-row.settings.icon_label')),

            Range::make('width', _t('blocks.accordion-row.settings.width_label'))
                ->min(12)
                ->max(200)
                ->step(2)
                ->default(20)
                ->unit('px'),
        ];
    }

    public static function presets(): array
    {
        return [
            Preset::make(_t('blocks.accordion-row.presets.accordion_row.name'))
                ->blocks([
                    PresetBlock::make('@visual-debut/text')
                        ->id('text-1')
                        ->settings([
                            'text' => '<p>We will work quickly to ship your order as soon as possible. Once your order has shipped, you will receive an email with further information. Delivery times vary depending on your location.</p>',
                            'width' => '100%',
                        ]),
                ])
                ->settings([
                    'heading' => 'When will I get my order?',
                ]),
        ];
    }

}
