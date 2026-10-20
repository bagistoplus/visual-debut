<?php

namespace BagistoPlus\VisualDebut\Support;

use Illuminate\Support\Facades\Route;

/**
 * Route names that changed across the Bagisto versions Debut supports.
 *
 * Bagisto 2.5 renamed routes from kebab case to snake case (the URLs stayed).
 * Callers name a route the 2.5 way and get whichever name this store has,
 * which holds as long as every underscore in the name was a hyphen before.
 */
class Routes
{
    public static function name(string $name): string
    {
        if (Route::has($name)) {
            return $name;
        }

        return str_replace('_', '-', $name);
    }

    public static function url(string $name, mixed $parameters = []): string
    {
        return route(self::name($name), $parameters);
    }
}
