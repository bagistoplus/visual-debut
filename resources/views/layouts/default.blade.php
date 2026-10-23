@php
  $direction = core()->getCurrentLocale()->direction;
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $direction }}">

  <head>
    {!! view_render_event('bagisto.shop.layout.head.before') !!}

    @include('shop::partials.head')

    {{-- In partials, so the settings stay out of the layout's variables, which Livewire blocks receive as context --}}
    @include('shop::partials.custom-css')

    {!! view_render_event('bagisto.shop.layout.head.after') !!}
  </head>

  <body class="{{ $direction }}" style="scroll-behavior: smooth;">
    {!! view_render_event('bagisto.shop.layout.body.before') !!}

    <x-shop::toasts />

    <x-shop::page-loader />

    <x-shop::confirm-modal />

    @if (core()->getConfigData('general.gdpr.settings.enabled') &&
            core()->getConfigData('general.gdpr.cookie.enabled') &&
            !\BagistoPlus\VisualDebut\Support\CookieConsent::isPreferencesPage())
      <x-shop::cookie-consent />
    @endif

    {!! view_render_event('bagisto.shop.layout.content.before') !!}

    <main role="main" tabindex="-1">
      @visualRegion('header')

      @section('body')
        @visual_layout_content
      @show

      @visualRegion('footer')
    </main>

    {!! view_render_event('bagisto.shop.layout.content.after') !!}

    {!! view_render_event('bagisto.shop.layout.body.after') !!}

    {{-- WebMCP tools for AI agents, Bagisto 2.4.8 on. Included rather than <x-shop::layouts.webmcp />, which fails to compile on a Bagisto without the view --}}
    @if (Route::has('shop.webmcp.product'))
      <div class="hidden">
        @includeIf('shop::components.layouts.webmcp')
        @include('shop::partials.webmcp-tools')
      </div>
    @endif

    @stack('scripts')
    @livewireScriptConfig

    @include('shop::partials.custom-javascript')
  </body>

</html>
