<?php

namespace BagistoPlus\VisualDebut\Support;

/**
 * Where the cookie consent banner and preferences store a visitor's choice.
 */
class CookieConsent
{
    private const PREFERENCES_ROUTE = 'shop.customers.gdpr.cookie_consent';

    /**
     * The attributes every consent cookie is written with, taken from the
     * session cookie's so that all of them reach the same hosts.
     *
     * @return array{domain: ?string, secure: bool, sameSite: ?string}
     */
    public static function cookieOptions(): array
    {
        return [
            'domain' => config('session.domain'),
            'secure' => (bool) config('session.secure'),
            'sameSite' => config('session.same_site'),
        ];
    }

    /**
     * The route Bagisto serves the preferences page from, named in snake case
     * from 2.5 and in kebab case before.
     */
    public static function preferencesRouteName(): string
    {
        return Routes::name(self::PREFERENCES_ROUTE);
    }

    public static function preferencesUrl(): string
    {
        return route(self::preferencesRouteName());
    }

    public static function isPreferencesPage(): bool
    {
        return request()->routeIs(self::PREFERENCES_ROUTE, 'shop.customers.gdpr.cookie-consent');
    }
}
