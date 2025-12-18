<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;

use function BagistoPlus\VisualDebut\_t;

class ClassicFooter extends Preset
{
    protected function getType(): string
    {
        return '@visual-debut/footer';
    }

    protected function build(): void
    {
        $this
            ->name(_t('sections.footer.presets.classic.name'))
            ->category('Footer')
            ->settings([
                'content_width' => 'container',
                'padding' => [
                    'top' => 8,
                    'right' => 0,
                    'bottom' => 8,
                    'left' => 0,
                ],
            ])
            ->blocks([
                // Main content grid
                PresetBlock::make('@visual-debut/group')
                    ->name('Footer Columns')
                    ->settings([
                        'layout_type' => 'grid',
                        'grid_columns' => ['_default' => 4, 'mobile' => 1],
                        'gap' => ['_default' => 8],
                        'width' => 'full',
                    ])
                    ->blocks([
                        // Brand column
                        $this->createFooterColumn(
                            'Brand',
                            _t('sections.footer.presets.classic.brand_title'),
                            _t('sections.footer.presets.classic.brand_description')
                        ),

                        // Company links
                        $this->createLinksColumn(
                            'Company',
                            _t('sections.footer.presets.classic.company_title'),
                            [
                                ['label' => 'About Us', 'url' => '/page/about-us'],
                                ['label' => 'Contact', 'url' => '/contact'],
                                ['label' => 'Careers', 'url' => '/page/careers'],
                            ]
                        ),

                        // Policy links
                        $this->createLinksColumn(
                            'Policy',
                            _t('sections.footer.presets.classic.policy_title'),
                            [
                                ['label' => 'Privacy Policy', 'url' => '/page/privacy-policy'],
                                ['label' => 'Terms of Service', 'url' => '/page/terms-of-service'],
                                ['label' => 'Shipping Policy', 'url' => '/page/shipping-policy'],
                            ]
                        ),

                        // Account links
                        $this->createLinksColumn(
                            'Account',
                            _t('sections.footer.presets.classic.account_title'),
                            [
                                ['label' => 'Sign In', 'url' => '/customer/login'],
                                ['label' => 'Register', 'url' => '/customer/register'],
                                ['label' => 'My Account', 'url' => '/customer/account'],
                            ]
                        ),
                    ]),

                // Divider
                PresetBlock::make('@visual-debut/divider')
                    ->settings([
                        'padding' => [
                            'top' => 4,
                            'right' => 0,
                            'bottom' => 4,
                            'left' => 0,
                        ],
                    ]),

                // Bottom bar
                PresetBlock::make('@visual-debut/group')
                    ->name('Bottom Bar')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => ['_default' => 'row', 'mobile' => 'column'],
                        'horizontal_justify_content' => 'between',
                        'horizontal_align_items' => 'center',
                        'gap' => ['_default' => 4],
                        'width' => '100%',
                    ])
                    ->blocks([
                        PresetBlock::make('@visual-debut/text')
                            ->settings([
                                'text' => '© ' . date('Y') . ' ' . config('app.name') . '. All rights reserved.',
                                'type_preset' => 'custom',
                                'font_size' => 'text-sm',
                            ]),

                        $this->createSocialIcons(),
                    ]),
            ]);
    }

    protected function createFooterColumn(string $name, string $title, string $description): PresetBlock
    {
        return PresetBlock::make('@visual-debut/group')
            ->name($name)
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'column',
                'flex_gap' => ['_default' => 2],
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/heading')
                    ->settings([
                        'text' => $title,
                        'tag' => 'h3',
                        'type_preset' => 'custom',
                        'font_size' => 'text-lg',
                    ]),

                PresetBlock::make('@visual-debut/richtext')
                    ->settings([
                        'content' => '<p>' . $description . '</p>',
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
                'flex_gap' => ['_default' => 2],
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

    protected function createSocialIcons(): PresetBlock
    {
        return PresetBlock::make('@visual-debut/group')
            ->name('Social Icons')
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'row',
                'flex_gap' => ['_default' => 2],
            ])
            ->blocks([
                PresetBlock::make('@visual-debut/button')
                    ->settings([
                        'link' => 'https://web.faceboook.com',
                        'icon' => 'lucide-facebook',
                        'circle' => true,
                        'style_class' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                    ]),

                PresetBlock::make('@visual-debut/button')
                    ->settings([
                        'link' => 'https://instagram.com',
                        'icon' => 'lucide-instagram',
                        'circle' => true,
                        'style_class' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                    ]),

                PresetBlock::make('@visual-debut/button')
                    ->settings([
                        'link' => 'https://x.com',
                        'icon' => 'ri-twitter-x-line',
                        'circle' => true,
                        'style_class' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                    ]),
            ]);
    }
}
