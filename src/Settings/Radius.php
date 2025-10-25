<?php

namespace BagistoPlus\VisualDebut\Settings;

use BagistoPlus\Visual\Settings\Base;

class Radius extends Base
{
    public static string $type = 'radius';

    public static function make(string $id, string $label = ''): static
    {
        return parent::make($id, $label)->default('md');
    }
}
