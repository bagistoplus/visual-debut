@props([
    'paymentMethods' => [],
])

<div id="payment">
  <h2 class="text-on-background text-base font-semibold md:text-2xl">
    @lang('shop::app.checkout.onepage.payment.payment-method')
  </h2>
  <div class="mt-4 grid gap-4 md:grid-cols-2">
    @foreach ($paymentMethods as $paymentMethod)
      <label
        class="has-checked:border-primary has-checked:bg-primary/10 hover:bg-surface hover:border-on-surface/10 box relative flex cursor-pointer items-center gap-4 p-4 pe-12 transition-colors md:flex-col md:items-start md:gap-3"
      >
        <input
          type="radio"
          name="paymentMethod"
          value="{{ $paymentMethod['method'] }}"
          class="inset-e-4 absolute top-4"
          wire:model="selectedPaymentMethod"
          wire:change="handlePaymentMethod('{{ $paymentMethod['method'] }}')"
        />

        <span class="flex h-11 w-14 shrink-0 items-center justify-start">
          <img
            class="max-h-full max-w-full"
            src="{{ $paymentMethod['image'] }}"
            alt="{{ $paymentMethod['method_title'] }}"
            title="{{ $paymentMethod['method_title'] }}"
          />
        </span>

        <div>
          <p class="font-medium">{{ $paymentMethod['method_title'] }}</p>
          <p class="text-sm">{{ $paymentMethod['description'] }}</p>
        </div>
      </label>
    @endforeach
  </div>
</div>
