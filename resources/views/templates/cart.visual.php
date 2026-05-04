<?php

use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Sections\Breadcrumbs;
use BagistoPlus\VisualDebut\Sections\CartContent;

return TemplateBuilder::make()
    ->section('breadcrumbs', Breadcrumbs::class)
    ->section('cart', CartContent::class)
    ->order(['breadcrumbs', 'cart']);
