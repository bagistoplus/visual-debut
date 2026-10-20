{{-- Bagisto's GDPRController::cookieConsent() renders this view by name; it needs a login, so the page is never cached --}}
@extends('shop::layouts.default')

@section('body')
  <div class="flex justify-center px-4 py-12">
    <div class="bg-background text-on-background box w-full max-w-2xl p-6 shadow-sm md:p-8">
      <h1 class="text-2xl">
        @lang('shop::app.components.layouts.cookie.consent.your-cookie-consent-preferences')
      </h1>

      <div class="mt-6">
        <x-shop::cookie-consent.preferences
          :cookie="\BagistoPlus\VisualDebut\Support\CookieConsent::cookieOptions()"
          :redirect="route('shop.home.index')"
        />
      </div>
    </div>
  </div>
@endsection
