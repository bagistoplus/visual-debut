@php
  $currencies = core()->getCurrentChannel()->currencies;
  $currentCurrency = core()->getCurrentCurrency();
@endphp

@if ($currencies->count() > 1)
  <div {{ $block->editor_attributes }} class="contents">
    <x-shop::ui.menu class="hidden sm:block">
      <x-shop::ui.menu.trigger aria-label="currency selector" class="hover:text-primary flex items-center p-2 transition-colors">
        <span class="ms-1">
          {{ $currentCurrency->symbol }} {{ $currentCurrency->code }}
        </span>
      </x-shop::ui.menu.trigger>
      <x-shop::ui.menu.items>
        @foreach ($currencies as $currency)
          <x-shop::ui.menu.item href="{{ request()->fullUrlWithQuery(['currency' => $currency->code]) }}">
            {{ $currency['symbol'] }} {{ $currency['name'] }}
          </x-shop::ui.menu.item>
        @endforeach
      </x-shop::ui.menu.items>
    </x-shop::ui.menu>
  </div>
@else
  <div {{ $block->editor_attributes }}></div>
@endif