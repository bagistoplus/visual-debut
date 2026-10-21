{{--
  Follows the variant picker like the price does: the chosen variant's lowest price, or the product's once none is
  chosen. Bagisto keeps a lowest price for every variant, so a variant sold at its regular price would otherwise
  announce a discount it does not have.
--}}
<p
  class="text-on-background/70 mt-1 flex items-start gap-1.5 text-sm"
  x-data="{ fallback: @js($formattedPrice), prices: @js((object) $variantPrices), price: @js($formattedPrice) }"
  x-on:product-variant-change.window="
    const { variant, prices: variantPrices } = $event.detail;
    const discounted = variant && parseFloat(variantPrices.regular.price) > parseFloat(variantPrices.final.price);
    price = variant ? (discounted ? prices[variant] ?? null : null) : fallback;
  "
  x-show="price"
>
  @svg('lucide-info', ['class' => 'mt-0.5 h-4 w-4 shrink-0', 'aria-hidden' => true])
  <span>
    @lang('shop::app.products.omnibus.price-info')
    <strong class="text-on-background font-medium" x-text="price">{{ $formattedPrice }}</strong>
  </span>
</p>
