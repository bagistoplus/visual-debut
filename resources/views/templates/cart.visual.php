<?php

use BagistoPlus\Visual\Support\TemplateBuilder;

return TemplateBuilder::make()
    ->section('breadcrumbs', '@visual-debut/breadcrumbs')
    ->section('cart', '@visual-debut/cart-content')
    ->order(['breadcrumbs', 'cart']);
