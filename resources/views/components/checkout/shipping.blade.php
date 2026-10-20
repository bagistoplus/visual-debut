@props(['cart', 'shippingMethods' => []])
<div id="shipping">
  <h2 class="text-on-background text-base font-semibold md:text-2xl">
    @lang('shop::app.checkout.onepage.shipping.shipping-method')
  </h2>

  <div class="mt-4 grid gap-4 md:grid-cols-2">
    @foreach ($shippingMethods as $shippingMethod)
      @foreach ($shippingMethod['rates'] as $rate)
        <label
          class="has-checked:border-primary has-checked:bg-primary/10 hover:bg-surface hover:border-on-surface/10 box relative flex cursor-pointer flex-col gap-1 p-4 pe-12 transition-colors"
        >
          <input
            type="radio"
            name="shippingMethod"
            value="{{ $rate['method'] }}"
            class="inset-e-4 absolute top-4"
            wire:model="selectedShippingMethod"
            wire:change="handleShippingMethod('{{ $rate['method'] }}')"
          >

          <span class="text-lg font-semibold">
            <x-shop::formatted-price :price="$rate['price']" />
          </span>

          <div>
            <p class="font-medium">{{ $rate['method_title'] }}</p>
            <p class="text-sm">{{ $rate['method_description'] }}</p>
          </div>
        </label>
      @endforeach
    @endforeach
  </div>
</div>
