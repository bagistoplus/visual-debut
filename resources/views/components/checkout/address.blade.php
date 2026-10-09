@props([
    'savedAddresses' => [],
    'billingAddress' => [],
    'shippingAddress' => [],
    'cartHaveStockableItems' => false,
])

<div>
  <h2 class="text-on-background text-base font-semibold md:text-2xl">
    @lang('shop::app.checkout.onepage.address.title')
  </h2>

  <form
    class="mt-2"
    wire:submit.prevent="handleAddressForm"
    x-data="{ useBillingAddressForShipping: @js($billingAddress->use_for_shipping) }"
  >
    @csrf
    <x-shop::checkout.address-fields
      name="billing"
      :saved-addresses="$savedAddresses->whereNotIn('address_type', 'cart_shipping')"
      :address="$billingAddress"
      :show-use-for-shipping-checkbox="$cartHaveStockableItems"
      title="{{ trans('shop::app.checkout.onepage.address.billing-address') }}"
    />

    {{-- Kept in the DOM so Livewire can update it; disabled while hidden so its required fields don't block the submit --}}
    <fieldset
      x-show="!useBillingAddressForShipping"
      x-bind:disabled="useBillingAddressForShipping"
      @if ($billingAddress->use_for_shipping) x-cloak @endif
      class="min-w-0"
    >
      <hr class="my-4">
      <x-shop::checkout.address-fields
        name="shipping"
        :saved-addresses="$savedAddresses->whereNotIn('address_type', 'cart_billing')"
        :address="$shippingAddress"
        title="{{ trans('shop::app.checkout.onepage.address.shipping-address') }}"
      />
    </fieldset>

    <div class="mt-4 text-right">
      <x-shop::ui.button wire:target="handleAddressForm" type="submit">
        {{ trans('shop::app.checkout.onepage.address.proceed') }}
      </x-shop::ui.button>
    </div>
  </form>
</div>
