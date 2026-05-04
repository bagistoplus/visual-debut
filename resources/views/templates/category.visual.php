<?php

use BagistoPlus\Visual\Support\TemplateBuilder;
use BagistoPlus\VisualDebut\Sections\CategoryPage;

return TemplateBuilder::make()
    ->section('category-page', CategoryPage::class)
    ->order(['category-page']);
