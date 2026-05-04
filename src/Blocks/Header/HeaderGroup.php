<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\BasicBlocks\Blocks\Group;
use BagistoPlus\VisualDebut\Blocks\Basic\Logo;

use function BagistoPlus\VisualDebut\_t;

class HeaderGroup extends Group
{
    protected static string $type = '@visual-debut/header-group';

    protected static bool $private = true;

    protected static array $accepts = [
        Logo::class,
        Nav::class,
        Currency::class,
        Locale::class,
        Search::class,
        Compare::class,
        User::class,
        Cart::class,
        self::class,
    ];

    public static function name(): string
    {
        return _t('blocks.header-group.name');
    }
}
