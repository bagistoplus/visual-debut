<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Divider;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Link;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Sections\Footer;

use function BagistoPlus\VisualDebut\_t;

class NewsletterFooter extends Preset
{
    public static function getType(): string
    {
        return Footer::class;
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.footer.presets.newsletter.name'))
            ->category('Footer')
            ->settings([
                'content_width' => 'container',
                'padding' => [
                    'top' => 16,
                    'right' => 0,
                    'bottom' => 16,
                    'left' => 0,
                ],
            ])
            ->blocks([
                PresetBlock::make(Group::class)
                    ->name(_t('sections.footer.presets.newsletter.container'))
                    ->settings([
                        'layout_type' => 'grid',
                        'grid_columns' => ['_default' => 2, 'mobile' => 1],
                        'gap' => ['_default' => 12],
                        'width' => 'full',
                    ])
                    ->blocks([
                        // Newsletter section
                        PresetBlock::make(Group::class)
                            ->name(_t('sections.footer.presets.newsletter.newsletter'))
                            ->settings([
                                'layout_type' => 'flex',
                                'flex_direction' => 'column',
                                'flex_gap' => ['_default' => 4],
                            ])
                            ->blocks([
                                PresetBlock::make(Heading::class)
                                    ->settings([
                                        'text' => _t('sections.footer.presets.newsletter.heading'),
                                        'heading_level' => 'h3',
                                    ]),

                                PresetBlock::make(Text::class)
                                    ->settings([
                                        'text' => _t('sections.footer.presets.newsletter.description'),
                                    ]),
                            ]),

                        // Links grid
                        PresetBlock::make(Group::class)
                            ->name(_t('sections.footer.presets.newsletter.links'))
                            ->settings([
                                'layout_type' => 'grid',
                                'grid_columns' => ['_default' => 3, 'mobile' => 1],
                                'gap' => ['_default' => 6],
                            ])
                            ->blocks([
                                $this->createLinksColumn(_t('sections.footer.presets.newsletter.columns.quick_links'), _t('sections.footer.presets.newsletter.columns.quick_links'), [
                                    ['label' => _t('sections.footer.presets.newsletter.links_items.shop'), 'url' => '/'],
                                    ['label' => _t('sections.footer.presets.newsletter.links_items.about'), 'url' => '/page/about-us'],
                                    ['label' => _t('sections.footer.presets.newsletter.links_items.contact'), 'url' => '/contact'],
                                ]),
                                $this->createLinksColumn(_t('sections.footer.presets.newsletter.columns.help'), _t('sections.footer.presets.newsletter.columns.help'), [
                                    ['label' => _t('sections.footer.presets.newsletter.links_items.faq'), 'url' => '/page/faq'],
                                    ['label' => _t('sections.footer.presets.newsletter.links_items.shipping'), 'url' => '/page/shipping-policy'],
                                    ['label' => _t('sections.footer.presets.newsletter.links_items.returns'), 'url' => '/page/return-policy'],
                                ]),
                                $this->createLinksColumn(_t('sections.footer.presets.newsletter.columns.account'), _t('sections.footer.presets.newsletter.columns.account'), [
                                    ['label' => _t('sections.footer.presets.newsletter.links_items.sign_in'), 'url' => '/customer/login'],
                                    ['label' => _t('sections.footer.presets.newsletter.links_items.register'), 'url' => '/customer/register'],
                                ]),
                            ]),
                    ]),

                PresetBlock::make(Divider::class)
                    ->settings([
                        'padding' => [
                            'top' => 4,
                            'right' => 0,
                            'bottom' => 4,
                            'left' => 0,
                        ],
                    ]),

                PresetBlock::make(Text::class)
                    ->settings([
                        'text' => _t('sections.footer.presets.newsletter.copyright', [
                            'year' => date('Y'),
                            'store' => config('app.name'),
                        ]),
                        'alignment' => 'center',
                    ]),
            ]);
    }

    protected function createLinksColumn(string $name, string $title, array $links): PresetBlock
    {
        $linkBlocks = array_map(function ($link) {
            return PresetBlock::make(Link::class)
                ->settings([
                    'text' => $link['label'],
                    'url' => $link['url'],
                    'underline' => 'hover',
                    'padding' => [
                        'top' => 1,
                        'right' => 0,
                        'bottom' => 1,
                        'left' => 0,
                    ],
                ]);
        }, $links);

        return PresetBlock::make(Group::class)
            ->name($name)
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'column',
                'flex_gap' => ['_default' => 2],
            ])
            ->blocks([
                PresetBlock::make(Heading::class)
                    ->settings([
                        'text' => $title,
                        'heading_level' => 'h4',
                    ]),

                ...$linkBlocks,
            ]);
    }
}
