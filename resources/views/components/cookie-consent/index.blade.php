@php
  use BagistoPlus\VisualDebut\Support\CookieConsent;

  $cookie = CookieConsent::cookieOptions();

  // Fixed on phones, the admin's corner (or the centre) from the sm breakpoint
  $positions = [
      'bottom-left' => 'bottom-0 sm:left-0',
      'bottom-right' => 'bottom-0 sm:right-0',
      'top-left' => 'top-0 sm:left-0',
      'top-right' => 'top-0 sm:right-0',
      'center' => 'top-1/2 -translate-y-1/2 sm:left-1/2 sm:-translate-x-1/2',
  ];

  $position = $positions[core()->getConfigData('general.gdpr.cookie.position')] ?? $positions['bottom-left'];
  $title = core()->getConfigData('general.gdpr.cookie.static_block_identifier');
@endphp

{{-- Whether to show is decided in the browser: Bagisto's page cache serves this markup to every visitor --}}
<div
  x-data="VisualCookieBanner(@js(['cookie' => $cookie, 'dialog' => 'cookie-preferences']))"
  x-show="visible"
  x-cloak
  role="region"
  aria-label="{{ $title }}"
  class="bg-background text-on-background box fixed inset-x-0 z-50 m-4 p-5 shadow-lg sm:inset-x-auto sm:w-md {{ $position }}"
>
  @if ($title)
    <p class="font-semibold">{{ $title }}</p>
  @endif

  <p class="mt-2 text-sm">
    {{ core()->getConfigData('general.gdpr.cookie.description') }}
    <a href="{{ url('page/privacy-policy') }}" class="underline">
      @lang('shop::app.components.layouts.cookie.index.privacy-policy')
    </a>
  </p>

  <div class="mt-4 flex flex-wrap items-center gap-2">
    <x-shop::ui.button size="sm" x-on:click="accept()">
      @lang('shop::app.components.layouts.cookie.index.accept')
    </x-shop::ui.button>
    <x-shop::ui.button size="sm" x-on:click="reject()">
      @lang('shop::app.components.layouts.cookie.index.reject')
    </x-shop::ui.button>
    <x-shop::ui.button size="sm" variant="link" x-on:click="customize()">
      @lang('shop::app.components.layouts.cookie.index.learn-more-and-customize')
    </x-shop::ui.button>
  </div>
</div>

<x-shop::ui.modal
  id="cookie-preferences"
  :title="trans('shop::app.components.layouts.cookie.consent.your-cookie-consent-preferences')"
>
  <div class="mt-4">
    <x-shop::cookie-consent.preferences :cookie="$cookie" />
  </div>
</x-shop::ui.modal>
