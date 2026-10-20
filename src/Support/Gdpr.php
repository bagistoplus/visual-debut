<?php

namespace BagistoPlus\VisualDebut\Support;

use Illuminate\Support\Facades\Route;

/**
 * What the customer GDPR requests page needs to know about the Bagisto it
 * runs on.
 *
 * GDPR requests ship with Bagisto 2.3.0 and their shop contract has moved
 * since: 2.3.10 turned revoke from a GET link into a POST form, and 2.5
 * renamed the export routes from kebab to snake case. Each difference is
 * detected here, by what the store has rather than by its version number, so
 * a view never asks.
 */
class Gdpr
{
    private const ROUTE_PREFIX = 'shop.customers.account.gdpr.';

    /**
     * Whether this Bagisto has GDPR requests at all. 2.2 does not.
     */
    public static function available(): bool
    {
        return Route::has(self::ROUTE_PREFIX.'index');
    }

    /**
     * The full route name for a GDPR route, given by its 2.5 snake case
     * name. Before 2.5 the same route is named in kebab case.
     */
    public static function routeName(string $name): string
    {
        return Routes::name(self::ROUTE_PREFIX.$name);
    }

    public static function route(string $name, mixed $parameters = []): string
    {
        return route(self::routeName($name), $parameters);
    }

    /**
     * The method revoke is sent with: GET up to 2.3.9, POST from 2.3.10.
     */
    public static function revokeMethod(): string
    {
        $route = Route::getRoutes()->getByName(self::ROUTE_PREFIX.'revoke');

        return in_array('POST', $route?->methods() ?? [], true) ? 'POST' : 'GET';
    }
}
