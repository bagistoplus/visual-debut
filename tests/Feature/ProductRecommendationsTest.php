<?php

use BagistoPlus\VisualDebut\Sections\ProductList;
use BagistoPlus\VisualDebut\Sections\ProductRecommendations;

function recommendationSettingIds(): array
{
    return collect(ProductRecommendations::settings())
        ->map(fn ($setting) => $setting->id ?? null)
        ->filter()
        ->values()
        ->all();
}

it('can only be added to the product page', function () {
    expect(ProductRecommendations::enabledOn())->toBe(['templates' => ['product'], 'regions' => ['main']])
        ->and(ProductRecommendations::disabledOn())->toBe([]);
});

it('picks its products by source instead of by category or type', function () {
    expect(recommendationSettingIds())
        ->toContain('source')
        ->not->toContain('parent_category')
        ->not->toContain('product_type');
});

it('keeps the layout settings of the product list', function () {
    $listSettings = collect(ProductList::settings())
        ->map(fn ($setting) => $setting->id ?? null)
        ->filter()
        ->reject(fn ($id) => in_array($id, ['parent_category', 'product_type']))
        ->values()
        ->all();

    expect(recommendationSettingIds())->toBe(['source', ...$listSettings]);
});

it('offers a preset for each source', function () {
    expect(collect(ProductRecommendations::presets())->map(fn ($preset) => $preset->toArray()['properties']['source'] ?? null)->all())
        ->toBe(['related', 'up_sells']);
});
