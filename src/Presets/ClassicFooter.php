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
                    ->name(_t('sections.footer.presets.classic.footer_columns'))
                    ->settings([
                        'layout_type' => 'grid',
                        'grid_columns' => ['_default' => 4, 'mobile' => 1],
                        'gap' => ['_default' => 8],
                        'width' => 'full',
                    ])
                    ->blocks([
                        // Brand column
                        $this->createFooterColumn(
                            _t('sections.footer.presets.classic.brand_column'),
                            _t('sections.footer.presets.classic.brand_title'),
                            _t('sections.footer.presets.classic.brand_description')
                        ),

                        // Company links
                        $this->createLinksColumn(
                            _t('sections.footer.presets.classic.company_title'),
                            _t('sections.footer.presets.classic.company_title'),
                            [
                                ['label' => _t('sections.footer.presets.classic.links.about_us'), 'url' => '/page/about-us'],
                                ['label' => _t('sections.footer.presets.classic.links.contact'), 'url' => '/contact'],
                                ['label' => _t('sections.footer.presets.classic.links.careers'), 'url' => '/page/careers'],
                            ]
                        ),

                        // Policy links
                        $this->createLinksColumn(
                            _t('sections.footer.presets.classic.policy_title'),
                            _t('sections.footer.presets.classic.policy_title'),
                            [
                                ['label' => _t('sections.footer.presets.classic.links.privacy_policy'), 'url' => '/page/privacy-policy'],
                                ['label' => _t('sections.footer.presets.classic.links.terms_of_service'), 'url' => '/page/terms-of-service'],
                                ['label' => _t('sections.footer.presets.classic.links.shipping_policy'), 'url' => '/page/shipping-policy'],
                            ]
                        ),

                        // Account links
                        $this->createLinksColumn(
                            _t('sections.footer.presets.classic.account_title'),
                            _t('sections.footer.presets.classic.account_title'),
                            [
                                ['label' => _t('sections.footer.presets.classic.links.sign_in'), 'url' => '/customer/login'],
                                ['label' => _t('sections.footer.presets.classic.links.register'), 'url' => '/customer/register'],
                                ['label' => _t('sections.footer.presets.classic.links.my_account'), 'url' => '/customer/account'],
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
                    ->name(_t('sections.footer.presets.classic.bottom_bar'))
                    ->settings([
                        'layout_type' => 'flex',
                        'flex_direction' => ['_default' => 'row', 'mobile' => 'column'],
                        'flex_justify' => 'between',
                        'flex_align' => 'center',
                        'flex_gap' => ['_default' => 4],
                        'width' => 'full',
                    ])
                    ->blocks([
                        PresetBlock::make(Text::class)
                            ->settings([
                                'text' => _t('sections.footer.presets.classic.copyright', [
                                    'year' => date('Y'),
                                    'store' => config('app.name'),
                                ]),
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
            ->name(_t('sections.footer.presets.classic.social_icons'))
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
