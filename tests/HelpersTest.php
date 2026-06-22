<?php

use function BagistoPlus\VisualDebut\_t;

it('wraps theme translation keys as visual translation references', function () {
    expect(_t('blocks.product-card.name'))->toBe('t:visual-debut::blocks.product-card.name');
});
