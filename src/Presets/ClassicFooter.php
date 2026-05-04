<?php

namespace BagistoPlus\VisualDebut\Presets;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Divider;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Link;
use BagistoPlus\BasicBlocks\Blocks\Basic\RichText;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\Visual\Support\Preset;
use BagistoPlus\Visual\Support\PresetBlock;
use BagistoPlus\VisualDebut\Sections\Footer;

use function BagistoPlus\VisualDebut\_t;

class ClassicFooter extends Preset
{
    public static function getType(): string
    {
        return Footer::class;
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
                PresetBlock::make(Group::class)
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
                PresetBlock::make(Divider::class)
                    ->settings([
                        'padding' => [
                            'top' => 4,
                            'right' => 0,
                            'bottom' => 4,
                            'left' => 0,
                        ],
                    ]),

                // Bottom bar
                PresetBlock::make(Group::class)
                    ->name('Bottom Bar')
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => ['_default' => 'row', 'mobile' => 'column'],
                        'flex_justify' => 'between',
                        'flex_align' => 'center',
                        'gap' => ['_default' => 4],
                        'width' => 'full',
                    ])
                    ->blocks([
                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => '© '.date('Y').' '.config('app.name').'. All rights reserved.',
                            ]),

                        $this->createSocialIcons(),
                    ]),
            ]);
    }

    protected function createFooterColumn(string $name, string $title, string $description): PresetBlock
    {
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
                        'heading_level' => 'h3',
                    ]),

                PresetBlock::make(RichText::class)
                    ->settings([
                        'content' => '<p>'.$description.'</p>',
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
                        'heading_level' => 'h3',
                        'typography' => 'heading-5',
                    ]),

                ...$linkBlocks,
            ]);
    }

    protected function createSocialIcons(): PresetBlock
    {
        return PresetBlock::make(Group::class)
            ->name('Social Icons')
            ->settings([
                'layout_type' => 'flex',
                'flex_direction' => 'row',
                'flex_gap' => ['_default' => 2],
            ])
            ->blocks([
                PresetBlock::make(Button::class)
                    ->settings([
                        'url' => 'https://web.faceboook.com',
                        'text' => '',
                        'icon' => 'lucide-facebook',
                        'style' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                        'circle' => true,
                    ]),

                PresetBlock::make(Button::class)
                    ->settings([
                        'url' => 'https://instagram.com',
                        'text' => '',
                        'icon' => 'lucide-instagram',
                        'style' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                        'circle' => true,
                    ]),

                PresetBlock::make(Button::class)
                    ->settings([
                        'url' => 'https://x.com',
                        'text' => '',
                        'icon' => 'ri-twitter-x-line',
                        'style' => 'outline',
                        'color' => 'secondary',
                        'size' => 'sm',
                        'circle' => true,
                    ]),
            ]);
    }
}
