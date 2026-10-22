<?php

use BagistoPlus\VisualDebut\Support\EuWithdrawal;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Webkul\Core\Facades\Core;
use Webkul\EUWithdrawal\Repositories\WithdrawalRepository;

/**
 * Registers the guest lookup route, which every store from Bagisto 2.4.5 on
 * has. 2.5 names it in snake case, 2.4 in kebab case.
 */
function withdrawalRoutes(string $name = 'shop.eu_withdrawal.guest.lookup'): void
{
    Route::get('withdraw', fn () => '')->name($name);

    Route::getRoutes()->refreshNameLookups();
}

/**
 * Bagisto's core, with withdrawals switched on for the given channels and
 * the shopper on the `default` channel.
 */
function withdrawalChannels(string ...$enabled): void
{
    Core::swap(new class($enabled)
    {
        public function __construct(private readonly array $enabled) {}

        public function getCurrentChannelCode(): string
        {
            return 'default';
        }

        public function getConfigData(string $field, ?string $channel = null): mixed
        {
            return $field === 'sales.eu_withdrawal.general.enabled' && in_array($channel, $this->enabled, true);
        }
    });
}

function orderOn(string $channel): object
{
    return (object) ['id' => 7, 'channel' => (object) ['code' => $channel]];
}

it('knows a store without withdrawals', function () {
    withdrawalChannels('default');

    expect(EuWithdrawal::available())->toBeFalse()
        ->and(EuWithdrawal::canWithdraw(orderOn('default')))->toBeFalse();
});

it('offers withdrawals only on a channel that switched them on', function () {
    withdrawalRoutes();

    withdrawalChannels();
    expect(EuWithdrawal::available())->toBeFalse();

    withdrawalChannels('default');
    expect(EuWithdrawal::available())->toBeTrue();
});

it('offers withdrawals on Bagisto 2.4', function () {
    withdrawalRoutes('shop.eu-withdrawal.guest.lookup');
    withdrawalChannels('default');

    expect(EuWithdrawal::available())->toBeTrue();
});

it('decides by the channel the order was placed on', function () {
    withdrawalRoutes();
    withdrawalChannels('eu');

    expect(EuWithdrawal::canWithdraw(orderOn('eu')))->toBeTrue()
        ->and(EuWithdrawal::canWithdraw(orderOn('default')))->toBeFalse();
});

it('finds the withdrawal already declared for an order', function () {
    app()->instance(WithdrawalRepository::class, new class
    {
        public function findForOrder(int $orderId): ?object
        {
            return $orderId === 7 ? (object) ['uuid' => 'abc'] : null;
        }
    });

    expect(EuWithdrawal::existingFor(orderOn('default'))?->uuid)->toBe('abc')
        ->and(EuWithdrawal::existingFor((object) ['id' => 8]))->toBeNull();
});

it('names withdrawal routes so Bagisto 2.4 finds them and owns the wording', function () {
    $english = require dirname(__DIR__, 2).'/resources/lang/en/shop.php';

    foreach (File::allFiles(dirname(__DIR__, 2).'/resources/views') as $view) {
        $contents = $view->getContents();

        expect($contents)
            ->not->toMatch("/route\\('[^']*eu_withdrawal/", $view->getRelativePathname())
            ->not->toContain('shop::app.eu-withdrawal', $view->getRelativePathname());

        preg_match_all("/'visual-debut::shop\\.(eu-withdrawal\\.[a-z.-]+[a-z])'(?! \\.)/", $contents, $keys);

        foreach ($keys[1] as $key) {
            expect(data_get($english, $key))->toBeString($view->getRelativePathname().': '.$key);
        }
    }
});
