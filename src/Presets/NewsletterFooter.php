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
                    ->name('Newsletter + Links')
                    ->settings([
                        'layout_type' => 'grid',
                        'grid_columns' => ['_default' => 2, 'mobile' => 1],
                        'gap' => ['_default' => 12],
                        'width' => 'full',
                    ])
                    ->blocks([
                        // Newsletter section
                        PresetBlock::make(Group::class)
                            ->name('Newsletter')
                            ->settings([
                                'layout_type' => 'flex',
                                'flex_direction' => 'column',
                                'gap' => ['_default' => 4],
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
                            ->name('Links')
                            ->settings([
                                'layout_type' => 'grid',
                                'grid_columns' => ['_default' => 3, 'mobile' => 1],
                                'gap' => ['_default' => 6],
                            ])
                            ->blocks([
                                $this->createLinksColumn('Quick Links', 'Quick Links', [
                                    ['label' => 'Shop', 'url' => '/'],
                                    ['label' => 'About', 'url' => '/page/about-us'],
                                    ['label' => 'Contact', 'url' => '/contact'],
                                ]),
                                $this->createLinksColumn('Help', 'Help', [
                                    ['label' => 'FAQ', 'url' => '/page/faq'],
                                    ['label' => 'Shipping', 'url' => '/page/shipping-policy'],
                                    ['label' => 'Returns', 'url' => '/page/return-policy'],
                                ]),
                                $this->createLinksColumn('Account', 'Account', [
                                    ['label' => 'Sign In', 'url' => '/customer/login'],
                                    ['label' => 'Register', 'url' => '/customer/register'],
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
                        'text' => '© ' . date('Y') . ' ' . config('app.name'),
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
                'gap' => ['_default' => 2],
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
