<?php

use BagistoPlus\VisualDebut\Support\Routes;
use Illuminate\Support\Facades\Route;

/**
 * Registers a route under the given name, as one Bagisto version names it.
 */
function namedRoute(string $name): void
{
    Route::get('named/{id?}', fn () => '')->name($name);
    Route::getRoutes()->refreshNameLookups();
}

it('keeps the snake case name on Bagisto 2.5', function () {
    namedRoute('paypal.smart_button.create_order');

    expect(Routes::name('paypal.smart_button.create_order'))->toBe('paypal.smart_button.create_order');
});

it('falls back to the kebab case name before 2.5', function () {
    namedRoute('paypal.smart-button.create-order');

    expect(Routes::name('paypal.smart_button.create_order'))->toBe('paypal.smart-button.create-order');
});

it('keeps a name without underscores as it is', function () {
    expect(Routes::name('shop.checkout.cart.index'))->toBe('shop.checkout.cart.index');
});

it('builds the url from whichever name the store has', function () {
    namedRoute('shop.customers.account.orders.print-invoice');

    expect(Routes::url('shop.customers.account.orders.print_invoice', 7))->toEndWith('/named/7');
});
