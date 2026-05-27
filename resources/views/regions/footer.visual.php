<?php

use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Presets\ClassicFooter;

return TemplateBuilder::make()
    ->id('footer')
    ->name('Footer')
    ->section('main-footer', ClassicFooter::class)
    ->order(['main-footer']);
