<title>@yield('page_title', config('app.name'))</title>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="content-language" content="{{ app()->getLocale() }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="currency" content="{{ core()->getCurrentCurrencyCode() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@stack('meta')

{{ $theme->settings->typography_presets->fontLinks() }}

<script type="application/ld+json" id="currency-data">
  @json(core()->getCurrentCurrency()->toArray())
</script>

@include('shop::partials.tokens')

<link
  rel="icon"
  sizes="16x16"
  href="{{ core()->getCurrentChannel()->favicon_url ?? asset('themes/shop/visual-debut/images/favicon.ico') }}"
/>

@bagistoVite(['resources/assets/css/index.css', 'resources/assets/ts/shop/index.ts'])

@stack('styles')

@livewireStyles
