<?php

namespace BagistoPlus\VisualDebut\Support;

use BagistoPlus\Visual\Settings\ColorScheme;

use function BagistoPlus\VisualDebut\_t;

trait HasColorSchemeSetting
{
    protected static function colorSchemeSetting(): ColorScheme
    {
        return ColorScheme::make('color_scheme', _t('sections.common.color_scheme_label'))
            ->info(_t('sections.common.color_scheme_info'));
    }
}
