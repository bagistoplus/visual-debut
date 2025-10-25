<?php

use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Presets\ClassicFooter;

return TemplateBuilder::make()
    ->id('footer')
    ->name('footer')
    ->section('main-footer', ClassicFooter::class)
    ->order(['main-footer']);
