<?php

namespace BagistoPlus\VisualDebut\Support;

use Illuminate\Support\Facades\Route;
use Webkul\EUWithdrawal\Repositories\WithdrawalRepository;

use function BagistoPlus\VisualDebut\core;

/**
 * What the EU withdrawal pages and their entry points need to know about the
 * Bagisto they run on.
 *
 * Withdrawal from a contract (Directive (EU) 2023/2673) ships with Bagisto
 * 2.5. Every 2.5 store has its routes, but each channel switches the feature
 * on in its own config, and Bagisto answers 404 on a channel that has not. A
 * link is only shown where Bagisto would serve the page behind it.
 */
class EuWithdrawal
{
    private const ENABLED_CONFIG = 'sales.eu_withdrawal.general.enabled';

    /**
     * Whether the current channel takes withdrawals. 2.4 and before do not
     * have them at all.
     */
    public static function available(): bool
    {
        return self::enabledOn(core()->getCurrentChannelCode());
    }

    /**
     * Whether the order can be withdrawn from. Bagisto decides by the channel
     * the order was placed on, not the one it is viewed from.
     */
    public static function canWithdraw(object $order): bool
    {
        return self::enabledOn($order->channel?->code);
    }

    /**
     * The withdrawal already declared for the order, if any. Only ask once
     * `canWithdraw()` holds: before 2.5 there is nothing to look in.
     */
    public static function existingFor(object $order): ?object
    {
        return app(WithdrawalRepository::class)->findForOrder($order->id);
    }

    private static function enabledOn(?string $channelCode): bool
    {
        if (! Route::has('shop.eu_withdrawal.guest.lookup')) {
            return false;
        }

        return (bool) core()->getConfigData(self::ENABLED_CONFIG, $channelCode);
    }
}
