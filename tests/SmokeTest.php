<?php

use BagistoPlus\VisualDebut\ServiceProvider;

it('loads the visual debut service provider', function () {
    expect(class_exists(ServiceProvider::class))->toBeTrue();
});
