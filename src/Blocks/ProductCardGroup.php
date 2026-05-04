<?php

namespace BagistoPlus\VisualDebut\Blocks;

use BagistoPlus\BasicBlocks\Blocks\Basic\Button;
use BagistoPlus\BasicBlocks\Blocks\Basic\Heading;
use BagistoPlus\BasicBlocks\Blocks\Basic\Text;
use BagistoPlus\BasicBlocks\Blocks\Group;

use function BagistoPlus\VisualDebut\_t;

class ProductCardGroup extends Group
{
    protected static string $type = '@visual-debut/product-card-group';

    protected static bool $private  = true;

    protected static array $accepts = [
        Text::class,
        Heading::class,
        Button::class,
        '@visual-debut/product-*',
        '@basic-blocks/product-*',
        self::class,
    ];

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>';

    protected static string $category = 'Product';

    public static function name(): string
    {
        return _t('blocks.product-card-group.name');
    }
}
