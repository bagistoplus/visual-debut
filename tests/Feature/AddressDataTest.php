<?php

use BagistoPlus\VisualDebut\Data\AddressData;

it('reads an empty id as a new address', function () {
    expect(AddressData::fromArray(['id' => ''])->id)->toBeNull()
        ->and(AddressData::fromArray([])->id)->toBeNull();
});

it('keeps the id of a saved address', function () {
    expect(AddressData::fromArray(['id' => 12])->id)->toBe(12)
        ->and(AddressData::fromArray(['id' => '12'])->id)->toBe(12);
});
