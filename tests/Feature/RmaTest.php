<?php

use BagistoPlus\VisualDebut\Support\Rma;
use Illuminate\Support\Facades\Route;
use Webkul\RMA\Repositories\RMARepository;

/**
 * Registers shop returns routes the way a given Bagisto names them.
 */
function rmaRoutes(string ...$names): void
{
    foreach ($names as $name) {
        Route::get('rma/'.$name.'/{id?}', fn () => '')->name('shop.customers.account.rma.'.$name);
    }

    Route::getRoutes()->refreshNameLookups();
}

it('knows a store without returns', function () {
    expect(Rma::available())->toBeFalse();

    rmaRoutes('index');

    expect(Rma::available())->toBeTrue();
});

it('names routes in snake case on Bagisto 2.5', function () {
    rmaRoutes('index', 'get_order_items', 're_open');

    expect(Rma::routeName('get_order_items'))->toBe('shop.customers.account.rma.get_order_items')
        ->and(Rma::routeName('re_open'))->toBe('shop.customers.account.rma.re_open');
});

it('falls back to kebab case route names on Bagisto 2.4', function () {
    rmaRoutes('index', 'get-order-items', 're-open');

    expect(Rma::routeName('get_order_items'))->toBe('shop.customers.account.rma.get-order-items')
        ->and(Rma::routeName('re_open'))->toBe('shop.customers.account.rma.re-open')
        ->and(Rma::route('get_order_items', ['id' => 7]))->toEndWith('/rma/get-order-items/7');
});

it('keeps single word route names as they are', function () {
    rmaRoutes('index', 'view');

    expect(Rma::routeName('view'))->toBe('shop.customers.account.rma.view')
        ->and(Rma::route('view', ['id' => 3]))->toEndWith('/rma/view/3');
});

it('shows photos through the image route on Bagisto 2.5', function () {
    rmaRoutes('index', 'image');

    expect(Rma::imageUrl((object) ['id' => 12, 'path' => 'rmas/1/images/a.png']))
        ->toEndWith('/rma/image/12');
});

it('shows photos from the public disk on Bagisto 2.4', function () {
    config()->set('filesystems.disks.public.url', 'http://shop.test/storage');
    config()->set('filesystems.default', 'public');

    expect(Rma::imageUrl((object) ['id' => 12, 'path' => 'rma/1/a.png']))
        ->toBe('http://shop.test/storage/rma/1/a.png');
});

it('points 2.4 attachments at the public disk', function () {
    config()->set('filesystems.disks.public.url', 'http://shop.test/storage');
    config()->set('filesystems.default', 'public');

    expect(Rma::storageUrl())->toBe('http://shop.test/storage/');
});

it('asks Bagisto whether a request can be canceled when it knows', function () {
    app()->instance(RMARepository::class, new class
    {
        public function canCancelRma($rma): bool
        {
            return $rma->id === 1;
        }
    });

    expect(Rma::canCancel((object) ['id' => 1, 'rma_status_id' => 6]))->toBeTrue()
        ->and(Rma::canCancel((object) ['id' => 2, 'rma_status_id' => 1]))->toBeFalse();
});

it('applies the same cancel rule itself before Bagisto 2.4.10', function (?int $status, bool $cancelable) {
    app()->instance(RMARepository::class, new class {});

    expect(Rma::canCancel((object) ['rma_status_id' => $status]))->toBe($cancelable);
})->with([
    'pending' => [1, true],
    'approved' => [2, true],
    'awaiting return' => [3, true],
    'in transit' => [4, true],
    'refunded' => [5, false],
    'solved' => [6, false],
    'declined' => [7, false],
    'item canceled' => [8, false],
    'canceled' => [9, false],
    'a custom status' => [12, true],
    'no status' => [null, false],
]);
