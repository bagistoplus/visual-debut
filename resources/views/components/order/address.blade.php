@props(['address'])

@php
  // Bagisto 2.5 renamed country_name() to countryName()
  $country = method_exists(core(), 'countryName') ? core()->countryName($address->country) : core()->country_name($address->country);
@endphp

@if ($address->company_name)
  {{ $address->company_name }}<br />
@endif
{{ $address->name }}<br />
{{ $address->address }}<br />
{{ $address->city }}<br />
{{ $address->state }}<br />
{{ $country }} @if ($address->postcode)
  ({{ $address->postcode }})
@endif
<br>
{{ __('shop::app.customers.account.orders.view.contact') }} : {{ $address->phone }}
