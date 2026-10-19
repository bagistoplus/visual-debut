<?php

use BagistoPlus\VisualDebut\Support\Gdpr;
use Illuminate\Support\Facades\Route;

/**
 * Registers shop GDPR routes the way a given Bagisto names them.
 */
function gdprRoutes(string ...$names): void
{
    foreach ($names as $name) {
        Route::get('gdpr/'.$name.'/{id?}', fn () => '')->name('shop.customers.account.gdpr.'.$name);
    }

    Route::getRoutes()->refreshNameLookups();
}

/**
 * Registers the revoke route with the method a given Bagisto sends it with.
 */
function gdprRevokeRoute(string $method): void
{
    Route::match([$method], 'gdpr/revoke/{id}', fn () => '')->name('shop.customers.account.gdpr.revoke');

    Route::getRoutes()->refreshNameLookups();
}

it('knows a store without GDPR requests', function () {
    expect(Gdpr::available())->toBeFalse();

    gdprRoutes('index');

    expect(Gdpr::available())->toBeTrue();
});

it('names export routes in snake case on Bagisto 2.5', function () {
    gdprRoutes('index', 'pdf_view', 'html_view');

    expect(Gdpr::routeName('pdf_view'))->toBe('shop.customers.account.gdpr.pdf_view')
        ->and(Gdpr::routeName('html_view'))->toBe('shop.customers.account.gdpr.html_view');
});

it('falls back to kebab case export route names before Bagisto 2.5', function () {
    gdprRoutes('index', 'pdf-view', 'html-view');

    expect(Gdpr::routeName('pdf_view'))->toBe('shop.customers.account.gdpr.pdf-view')
        ->and(Gdpr::routeName('html_view'))->toBe('shop.customers.account.gdpr.html-view')
        ->and(Gdpr::route('html_view'))->toEndWith('/gdpr/html-view');
});

it('keeps single word route names as they are', function () {
    gdprRoutes('index', 'store');

    expect(Gdpr::routeName('store'))->toBe('shop.customers.account.gdpr.store')
        ->and(Gdpr::route('store'))->toEndWith('/gdpr/store');
});

it('revokes with the method the store routes it with', function (string $method) {
    gdprRevokeRoute($method);

    expect(Gdpr::revokeMethod())->toBe($method)
        ->and(Gdpr::route('revoke', 4))->toEndWith('/gdpr/revoke/4');
})->with([
    'a link up to 2.3.9' => ['GET'],
    'a form from 2.3.10' => ['POST'],
]);
