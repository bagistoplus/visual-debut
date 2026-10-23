@props(['cart'])

@php
  $displayTax = [
      'subtotal' => core()->getConfigData('sales.taxes.shopping_cart.display_subtotal'),
      'shipping' => core()->getConfigData('sales.taxes.shopping_cart.display_shipping_amount'),
  ];

  // Tax is part of the subtotal shown, so it is marked as included rather than added
  $taxIncluded = in_array($displayTax['subtotal'], ['including_tax', 'both']);

  // Bagisto 2.4.12 on sends a breakdown per rate and product when the merchant turns it on;
  // earlier versions send no such field and list the amount per rate instead
  $taxBreakdown = property_exists($cart, 'applied_taxes_breakdown') ? (array) $cart->applied_taxes_breakdown : null;
  $taxRates = (array) ($cart->applied_taxes ?? []);
  $hasTaxDetails = (float) $cart->tax_total > 0 && ($taxBreakdown === null ? $taxRates !== [] : $taxBreakdown !== []);

  // Amounts arrive as decimal strings, where "0.0000" would count as set.
  // Bagisto 2.4.12 on splits the discount between the items and the shipping.
  $discount = (float) $cart->discount_amount;
  $itemsDiscount = (float) ($cart->items_discount_amount ?? 0);
  $shippingDiscount = (float) ($cart->shipping_discount_amount ?? 0);
@endphp

<div class="space-y-4">
  <!-- Sub Total -->
  <div class="flex justify-between gap-4">
    <span class="text-on-background">
      @lang('shop::app.checkout.cart.summary.sub-total')
    </span>
    @if ($displayTax['subtotal'] === 'including_tax')
      <span class="text-on-background">{{ $cart->formatted_sub_total_incl_tax }}</span>
    @elseif ($displayTax['subtotal'] === 'both')
      <div class="text-end">
        <span class="text-on-background">{{ $cart->formatted_sub_total_incl_tax }}</span>
        <p class="text-on-background/70 text-xs italic">
          @lang('visual-debut::shop.cart.excl-tax') {{ $cart->formatted_sub_total }}
        </p>
      </div>
    @else
      <span class="text-on-background">{{ $cart->formatted_sub_total }}</span>
    @endif
  </div>

  <!-- Apply coupon -->
  <div class="border-on-surface-alt/8 border-y py-4">
    <livewire:cart-coupon-form />
  </div>

  <!-- Discount amount -->
  @if ($discount > 0)
    @if ($itemsDiscount > 0 && $shippingDiscount > 0)
      <div x-data="{ open: false }">
        <button
          type="button"
          class="flex w-full justify-between gap-4"
          x-on:click="open = !open"
          x-bind:aria-expanded="open"
        >
          <span class="text-on-background">
            @lang('shop::app.checkout.onepage.summary.discount-amount')
          </span>
          <span class="text-on-background flex items-center gap-1">
            - {{ $cart->formatted_discount_amount }}
            <x-lucide-chevron-down class="h-4 w-4 transition-transform" x-bind:class="open && 'rotate-180'" />
          </span>
        </button>

        <div x-show="open" x-cloak class="mt-1 space-y-1 pe-5 text-xs">
          <div class="flex justify-between gap-4">
            <span class="text-on-background/70">@lang('visual-debut::shop.cart.items-discount')</span>
            <span class="text-on-background/70">- {{ $cart->formatted_items_discount_amount }}</span>
          </div>
          <div class="flex justify-between gap-4">
            <span class="text-on-background/70">@lang('visual-debut::shop.cart.shipping-discount')</span>
            <span class="text-on-background/70">- {{ $cart->formatted_shipping_discount_amount }}</span>
          </div>
        </div>
      </div>
    @else
      <div class="flex justify-between gap-4">
        <span class="text-on-background">
          @lang('shop::app.checkout.onepage.summary.discount-amount')
        </span>
        <span class="text-on-background">- {{ $cart->formatted_discount_amount }}</span>
      </div>
    @endif
  @endif

  <!-- Shipping Rates -->
  <div class="flex justify-between gap-4">
    <span class="text-on-background">
      @lang('shop::app.checkout.cart.summary.delivery-charges')
    </span>
    @if ($displayTax['shipping'] === 'including_tax')
      <span class="text-on-background">+ {{ $cart->formatted_shipping_amount_incl_tax }}</span>
    @elseif ($displayTax['shipping'] === 'both')
      <div class="text-end">
        <span class="text-on-background">+ {{ $cart->formatted_shipping_amount_incl_tax }}</span>
        <p class="text-on-background/70 text-xs italic">
          @lang('visual-debut::shop.cart.excl-tax') {{ $cart->formatted_shipping_amount }}
        </p>
      </div>
    @else
      <span class="text-on-background">+ {{ $cart->formatted_shipping_amount }}</span>
    @endif
  </div>

  <!-- Taxes -->
  <div class="border-on-surface-alt/8 border-t pt-4" @if ($hasTaxDetails) x-data="{ open: false }" @endif>
    @php
      $taxAmount = $taxIncluded ? $cart->formatted_tax_total : '+ ' . $cart->formatted_tax_total;
    @endphp

    @if ($hasTaxDetails)
      <button
        type="button"
        class="flex w-full justify-between gap-4"
        x-on:click="open = !open"
        x-bind:aria-expanded="open"
      >
        <span class="text-on-background">@lang('shop::app.checkout.cart.summary.tax')</span>
        <span class="text-on-background flex items-center gap-1">
          {{ $taxAmount }}
          @if ($taxIncluded)
            <span class="text-on-background/70 text-xs italic">(@lang('visual-debut::shop.cart.tax-included'))</span>
          @endif
          <x-lucide-chevron-down class="h-4 w-4 transition-transform" x-bind:class="open && 'rotate-180'" />
        </span>
      </button>

      <div x-show="open" x-cloak class="mt-2 space-y-2 pe-5 text-xs">
        @if ($taxBreakdown !== null)
          @foreach ($taxBreakdown as $taxLine)
            <div class="space-y-1">
              <p class="text-on-background/80 font-medium">{{ $taxLine->rate }}</p>
              @foreach ($taxLine->items as $taxedItem)
                <div class="flex justify-between gap-4 ps-3">
                  <span class="text-on-background/70 truncate">{{ $taxedItem->name }}</span>
                  <span class="text-on-background/70 shrink-0 whitespace-nowrap">
                    {{ $taxIncluded ? '' : '+ ' }}{{ $taxedItem->tax_amount }}
                    <span class="italic">({{ $taxedItem->taxable_amount }})</span>
                  </span>
                </div>
              @endforeach
            </div>
          @endforeach
        @else
          @foreach ($taxRates as $rate => $amount)
            <div class="flex justify-between gap-4">
              <span class="text-on-background/70">{{ $rate }}</span>
              <span class="text-on-background/70">{{ $amount }}</span>
            </div>
          @endforeach
        @endif
      </div>
    @else
      <div class="flex justify-between gap-4">
        <span class="text-on-background">@lang('shop::app.checkout.cart.summary.tax')</span>
        <span class="text-on-background">
          {{ $taxAmount }}
          @if ($taxIncluded)
            <span class="text-on-background/70 text-xs italic">(@lang('visual-debut::shop.cart.tax-included'))</span>
          @endif
        </span>
      </div>
    @endif
  </div>

  <!-- Cart Grand Total -->
  <div class="border-on-surface-alt/8 border-t pt-4">
    <div class="flex justify-between">
      <span class="text-on-background text-lg font-medium">
        @lang('shop::app.checkout.cart.summary.grand-total')
      </span>
      <span class="text-on-background text-lg font-medium">
        {{ $cart->formatted_grand_total }}
      </span>
    </div>
  </div>
</div>
