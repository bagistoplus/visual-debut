<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Sections\BladeSection;
use BagistoPlus\Visual\Sections\Block;
use BagistoPlus\Visual\Settings\Image;
use BagistoPlus\Visual\Settings\Link;
use BagistoPlus\Visual\Settings\RichText;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\Visual\Settings\Select;

use function BagistoPlus\VisualDebut\_t;

class TextWithImage extends BladeSection
{
    protected static string $view = 'shop::sections.text-with-image';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/text-with-image.png';

    public static function name(): string
    {
        return _t('text-with-image.name');
    }

    public static function description(): string
    {
        return _t('text-with-image.description');
    }

    public static function settings(): array
    {
        return [
            Image::make('image', _t('text-with-image.settings.image_label'))
                ->default('https://placehold.co/600x400?text=Text+With+Image'),

            Select::make('image_position', _t('text-with-image.settings.image_position_label'))
                ->options([
                    'left'  => _t('text-with-image.settings.left_label'),
                    'right' => _t('text-with-image.settings.right_label'),
                ])
                ->default('left'),

            Select::make('image_height', _t('text-with-image.settings.image_height_label'))
                ->options([
                    'auto'  => _t('text-with-image.settings.image_height_auto'),
                    'sm'    => _t('text-with-image.settings.image_height_sm'),
                    'md'    => _t('text-with-image.settings.image_height_md'),
                    'lg'    => _t('text-with-image.settings.image_height_lg'),
                ])
                ->default('auto'),

            Select::make('image_width', _t('text-with-image.settings.image_width_label'))
                ->options([
                    'sm' => _t('text-with-image.settings.width_sm'),
                    'md' => _t('text-with-image.settings.width_md'),
                    'lg' => _t('text-with-image.settings.width_lg'),
                ])
                ->default('md'),

            Select::make('content_position', _t('text-with-image.settings.content_position_label'))
                ->options([
                    'top'    => _t('text-with-image.settings.position_top'),
                    'middle' => _t('text-with-image.settings.position_middle'),
                    'bottom' => _t('text-with-image.settings.position_bottom'),
                ])
                ->default('middle'),

            Select::make('content_align', _t('text-with-image.settings.content_align_label'))
                ->options([
                    'start'  => _t('text-with-image.settings.align_start'),
                    'center' => _t('text-with-image.settings.align_center'),
                    'end'    => _t('text-with-image.settings.align_end'),
                ])
                ->default('start'),

            Select::make('content_align_mobile', _t('text-with-image.settings.content_align_mobile_label'))
                ->options([
                    'start'  => _t('text-with-image.settings.align_start'),
                    'center' => _t('text-with-image.settings.align_center'),
                    'end'    => _t('text-with-image.settings.align_end'),
                ])
                ->default('center'),
        ];
    }

    public static function blocks(): array
    {
        return [
            Block::make('heading', _t('text-with-image.blocks.heading.label'))
                ->settings([
                    Text::make('text', _t('text-with-image.blocks.heading.settings.text_label'))
                        ->default(_t('text-with-image.blocks.heading.settings.text_default')),
                ]),

            Block::make('body', _t('text-with-image.blocks.body.label'))
                ->settings([
                    RichText::make('content', _t('text-with-image.blocks.body.settings.content_label'))
                        ->default(_t('text-with-image.blocks.body.settings.content_default')),
                ]),

            Block::make('button', _t('text-with-image.blocks.button.label'))
                ->settings([
                    Text::make('text', _t('text-with-image.blocks.button.settings.text_label'))
                        ->default(_t('text-with-image.blocks.button.settings.text_default')),

                    Link::make('url', _t('text-with-image.blocks.button.settings.url_label')),

                    Select::make('variant', _t('text-with-image.blocks.button.settings.variant_label'))
                        ->options([
                            'primary'   => _t('text-with-image.blocks.button.settings.variant_primary'),
                            'secondary' => _t('text-with-image.blocks.button.settings.variant_secondary'),
                            'accent'    => _t('text-with-image.blocks.button.settings.variant_accent'),
                            'neutral'   => _t('text-with-image.blocks.button.settings.variant_neutral'),
                        ])
                        ->default('primary'),

                    Select::make('style', _t('text-with-image.blocks.button.settings.style_label'))
                        ->options([
                            'solid'   => _t('text-with-image.blocks.button.settings.style_solid'),
                            'soft'    => _t('text-with-image.blocks.button.settings.style_soft'),
                            'outline' => _t('text-with-image.blocks.button.settings.style_outline'),
                            'ghost'   => _t('text-with-image.blocks.button.settings.style_ghost'),
                        ])
                        ->default('solid'),
                ]),
        ];
    }

    public static function default(): array
    {
        return [
            'blocks' => [
                ['type' => 'heading'],
                ['type' => 'body',],
                ['type' => 'button'],
            ]
        ];
    }
}
