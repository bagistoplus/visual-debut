<?php

namespace BagistoPlus\VisualDebut\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Webkul\RMA\Enums\DefaultRMAStatusEnum;
use Webkul\RMA\Repositories\RMARepository;

/**
 * What the customer returns pages need to know about the Bagisto they run on.
 *
 * Returns ship with Bagisto 2.4.0 and their shop contract has moved since:
 * 2.5 renamed the routes from kebab to snake case and serves photos and
 * attachments through routes of its own, and 2.4.10 added the rule for when a
 * request may be canceled. Each difference is detected here, by what the store
 * has rather than by its version number, so a view never asks.
 */
class Rma
{
    private const ROUTE_PREFIX = 'shop.customers.account.rma.';

    /**
     * Statuses a customer can no longer cancel, as Bagisto's own
     * `RMARepository::canCancelRma()` lists them from 2.4.10.
     */
    private const UNCANCELABLE_STATUSES = [
        DefaultRMAStatusEnum::RECEIVED_PACKAGE,
        DefaultRMAStatusEnum::SOLVED,
        DefaultRMAStatusEnum::DECLINED,
        DefaultRMAStatusEnum::ITEM_CANCELED,
        DefaultRMAStatusEnum::CANCELED,
    ];

    /**
     * Whether this Bagisto has returns at all. 2.3 does not.
     */
    public static function available(): bool
    {
        return Route::has(self::ROUTE_PREFIX.'index');
    }

    /**
     * The full route name for a returns route, given by its 2.5 snake case
     * name. Before 2.5 the same route is named in kebab case.
     */
    public static function routeName(string $name): string
    {
        $current = self::ROUTE_PREFIX.$name;

        if (Route::has($current)) {
            return $current;
        }

        return self::ROUTE_PREFIX.str_replace('_', '-', $name);
    }

    public static function route(string $name, mixed $parameters = []): string
    {
        return route(self::routeName($name), $parameters);
    }

    /**
     * Where a return's photo is shown from. 2.5 keeps photos on the private
     * disk behind a route; 2.4 stores them on the public disk.
     */
    public static function imageUrl(object $image): string
    {
        if (Route::has(self::ROUTE_PREFIX.'image')) {
            return route(self::ROUTE_PREFIX.'image', $image->id);
        }

        return Storage::url($image->path);
    }

    /**
     * Whether the customer may still cancel the request. Before 2.4.10 Bagisto
     * cancels from any status, so the same rule is applied here instead.
     */
    public static function canCancel(object $rma): bool
    {
        $repository = app(RMARepository::class);

        if (method_exists($repository, 'canCancelRma')) {
            return $repository->canCancelRma($rma);
        }

        if (empty($rma->rma_status_id)) {
            return false;
        }

        return ! in_array((int) $rma->rma_status_id, self::uncancelableStatusIds(), true);
    }

    /**
     * The same rule for the returns list, which sees rows rather than models:
     * before 2.4.10 Bagisto offers Cancel on every row.
     *
     * @return array<int, int>
     */
    public static function uncancelableStatusIds(): array
    {
        return array_map(fn (DefaultRMAStatusEnum $status) => $status->value, self::UNCANCELABLE_STATUSES);
    }
}
