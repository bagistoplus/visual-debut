<?php

use BagistoPlus\VisualDebut\Support\CookieConsent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

it('writes consent cookies with the session cookie attributes', function () {
    config()->set('session.domain', '.shop.test');
    config()->set('session.secure', true);
    config()->set('session.same_site', 'lax');

    expect(CookieConsent::cookieOptions())->toBe([
        'domain' => '.shop.test',
        'secure' => true,
        'sameSite' => 'lax',
    ]);
});

it('leaves unset attributes out', function () {
    config()->set('session.domain', null);
    config()->set('session.secure', null);
    config()->set('session.same_site', null);

    expect(CookieConsent::cookieOptions())->toBe([
        'domain' => null,
        'secure' => false,
        'sameSite' => null,
    ]);
});

it('knows the preferences page by either route name', function (string $name) {
    $route = Route::get('customer/account/your-cookie-consent-preferences', fn () => '')->name($name);
    $request = Request::create('/customer/account/your-cookie-consent-preferences');
    $request->setRouteResolver(fn () => $route->bind($request));
    app()->instance('request', $request);

    expect(CookieConsent::isPreferencesPage())->toBeTrue();
})->with([
    'Bagisto 2.5' => ['shop.customers.gdpr.cookie_consent'],
    'before 2.5' => ['shop.customers.gdpr.cookie-consent'],
]);

it('knows any other page is not the preferences page', function () {
    expect(CookieConsent::isPreferencesPage())->toBeFalse();
});

it('links the preferences page by its route name on Bagisto 2.5', function () {
    Route::get('your-cookie-consent-preferences', fn () => '')->name('shop.customers.gdpr.cookie_consent');
    Route::getRoutes()->refreshNameLookups();

    expect(CookieConsent::preferencesUrl())->toEndWith('/your-cookie-consent-preferences');
});

it('falls back to the kebab case route name before Bagisto 2.5', function () {
    Route::get('your-cookie-consent-preferences', fn () => '')->name('shop.customers.gdpr.cookie-consent');
    Route::getRoutes()->refreshNameLookups();

    expect(CookieConsent::preferencesRouteName())->toBe('shop.customers.gdpr.cookie-consent')
        ->and(CookieConsent::preferencesUrl())->toEndWith('/your-cookie-consent-preferences');
});
