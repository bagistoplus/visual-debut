<?php

use BagistoPlus\VisualDebut\Commands\MigrateProductOptions;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

/**
 * A saved product template whose details block holds the given children,
 * each as [id, type, disabled].
 */
function savedTemplate(array $children): array
{
    $blocks = [
        'details' => ['id' => 'details', 'type' => '@visual-debut/product-details', 'properties' => [], 'parentId' => 'information', 'children' => array_column($children, 0)],
        'information' => ['id' => 'information', 'type' => '@visual-debut/product-information', 'properties' => [], 'parentId' => null, 'children' => ['details']],
    ];

    foreach ($children as [$id, $type, $disabled]) {
        $blocks[$id] = ['id' => $id, 'type' => $type, 'properties' => ['product' => null, 'position' => 'right'], 'parentId' => 'details', 'children' => [], 'disabled' => $disabled];
    }

    return ['blocks' => $blocks, 'regions' => [['id' => 'main', 'name' => 'main', 'blocks' => ['information']]]];
}

it('turns the first old block into the options block and drops the others', function () {
    $migrated = MigrateProductOptions::migrate(savedTemplate([
        ['title', '@visual-debut/product-title', false],
        ['variants', '@visual-debut/product-variant-picker', false],
        ['grouped', '@visual-debut/product-grouped-options', false],
        ['bundle', '@visual-debut/product-bundle-options', false],
        ['downloadable', '@visual-debut/product-downloadable-options', false],
        ['customizable', '@visual-debut/product-customizable-options', false],
        ['buy', '@visual-debut/product-buy-buttons', false],
    ]));

    expect($migrated['blocks']['details']['children'])->toBe(['title', 'variants', 'buy'])
        ->and($migrated['blocks']['variants']['type'])->toBe('@visual-debut/product-options')
        ->and($migrated['blocks']['variants']['properties'])->toBe(['product' => null])
        ->and($migrated['blocks'])->not->toHaveKeys(['grouped', 'bundle', 'downloadable', 'customizable']);
});

it('keeps the first enabled old block in place', function () {
    $migrated = MigrateProductOptions::migrate(savedTemplate([
        ['variants', '@visual-debut/product-variant-picker', true],
        ['title', '@visual-debut/product-title', false],
        ['bundle', '@visual-debut/product-bundle-options', false],
    ]));

    expect($migrated['blocks']['details']['children'])->toBe(['title', 'bundle'])
        ->and($migrated['blocks']['bundle']['type'])->toBe('@visual-debut/product-options')
        ->and($migrated['blocks']['bundle']['disabled'])->toBeFalse();
});

it('leaves a template without old blocks untouched', function () {
    $template = savedTemplate([['title', '@visual-debut/product-title', false]]);

    expect(MigrateProductOptions::migrate($template))->toBe($template);
});

it('rewrites saved files and skips a file that inherits from another', function () {
    Artisan::registerCommand(app(MigrateProductOptions::class));

    $dir = sys_get_temp_dir().'/visual-debut-'.uniqid();
    File::makeDirectory($dir.'/live', recursive: true);

    $template = savedTemplate([
        ['variants', '@visual-debut/product-variant-picker', false],
        ['bundle', '@visual-debut/product-bundle-options', false],
    ]);

    File::put($dir.'/live/product.json', json_encode($template));
    File::put($dir.'/live/inherited.json', json_encode(['parent' => 'other.json'] + $template));

    $this->artisan('visual-debut:migrate-product-options', ['--path' => [$dir], '--dry-run' => true])
        ->expectsOutputToContain('Files needing migration: 1')
        ->assertSuccessful();

    expect(File::get($dir.'/live/product.json'))->toBe(json_encode($template));

    $this->artisan('visual-debut:migrate-product-options', ['--path' => [$dir]])
        ->expectsOutputToContain('Migrated files: 1')
        ->assertSuccessful();

    $saved = json_decode(File::get($dir.'/live/product.json'), true);

    expect($saved['blocks']['variants']['type'])->toBe('@visual-debut/product-options')
        ->and($saved['blocks'])->not->toHaveKey('bundle')
        ->and(json_decode(File::get($dir.'/live/inherited.json'), true)['blocks'])->toHaveKey('bundle');

    File::deleteDirectory($dir);
});
