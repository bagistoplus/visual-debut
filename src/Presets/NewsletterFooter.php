<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class NewsletterFooter extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/footer';
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
                PresetBlock::make('@visual-debut/group')
                    ->name('Newsletter + Links')
                    ->settings([
                        'layout_type' => 'grid',
                        'grid_columns' => ['_default' => 2, 'mobile' => 1],
                        'gap' => ['_default' => 12],
                        'width' => 'fill',
                    ])
                    ->blocks([
                        // Newsletter section
                        PresetBlock::make('@visual-debut/group')
                            ->name('Newsletter')
                            ->settings([
                                'layout_type' => 'flex',
                                'flex_direction' => 'column',
                                'gap' => ['_default' => 4],
                            ])
                            ->blocks([
                                PresetBlock::make('@visual-debut/heading')
                                    ->settings([
                                        'text' => _t('sections.footer.presets.newsletter.heading'),
                                        'tag' => 'h3',
                                    ]),

                                PresetBlock::make('@visual-debut/text')
                                    ->settings([
                                        'text' => _t('sections.footer.presets.newsletter.description'),
                                    ]),
                            ]),

                        // Links grid
                        PresetBlock::make('@visual-debut/group')
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

                PresetBlock::make('@visual-debut/divider')
                    ->settings([
                        'padding' => [
                            'top' => 4,
                            'right' => 0,
                            'bottom' => 4,
                            'left' => 0,
                        ],
                    ]),

                PresetBlock::make('@visual-debut/text')
                    ->settings([
                        'text' => '© ' . date('Y') . ' ' . config('app.name'),
                        'alignment' => 'center',
                        'type_preset' => 'custom',
                        'font_size' => 'text-sm',
                    ]),
            ]);
    }

    protected function createLinksColumn(string $name, string $title, array $links): PresetBlock
    {
        $linkBlocks = array_map(function ($link) {
            return PresetBlock::make('@visual-debut/link')
                ->settings([
                    'text' => $link['label'],
                    'url' => $link['url'],
                    'type_preset' => 'paragraph',
                    'underline' => 'hover',
                    'padding' => [
                        'top' => 1,
                        'right' => 0,
                        'bottom' => 1,
                        'left' => 0,
                    ],
                ]);
        }, $links);

        return PresetBlock::make('@visual-debut/group')
            ->name($name)
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'column',
                'gap' => ['_default' => 2],
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/heading')
                    ->settings([
                        'text' => $title,
                        'tag' => 'h4',
                        'type_preset' => 'custom',
                        'font_size' => 'text-base',
                        'font_weight' => '600',
                    ]),

                ...$linkBlocks,
            ]);
    }
}
