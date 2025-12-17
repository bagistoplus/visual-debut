@isset($product)
  @if ($product->type === 'grouped')
    @php
      $groupedProducts = $product->grouped_products()->orderBy('sort_order')->get();
    @endphp

    @if ($groupedProducts->count())
      <div {{ $block->editor_attributes }} class="grid w-full max-w-sm gap-4">
        @foreach ($groupedProducts as $groupedProduct)
          @if ($groupedProduct->associated_product->getTypeInstance()->isSaleable())
            <div class="flex items-center justify-between gap-4">
              <div class="text-xs">
                <p class="text-on-background font-semibold">
                  @lang('shop::app.products.view.type.grouped.name')
                </p>
                <p class="mt-1 line-clamp-1">
                  <span>{{ $groupedProduct->associated_product->name }} + </span>
                  <x-shop::formatted-price :price="$groupedProduct->associated_product->getTypeInstance()->getFinalPrice()" />
                </p>
              </div>
              <x-shop::quantity-selector
                :min="1"
                :value="$groupedProduct->qty"
                x-on:change="$wire.set('groupedProductQuantities.{{ $groupedProduct->associated_product->id }}', $event.detail, false)"
              />

            </div>
          @endif
        @endforeach
      </div>
    @endif
  @endif
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }} class="grid w-full max-w-sm gap-4 text-muted">
    <div class="flex items-center justify-between gap-4">
      <div class="text-xs">
        <p class="text-on-background font-semibold">Product Item</p>
        <p class="mt-1">Sample Product + $25.00</p>
      </div>
      <x-shop::quantity-selector :min="1" :value="1" disabled />
    </div>
    <div class="flex items-center justify-between gap-4">
      <div class="text-xs">
        <p class="text-on-background font-semibold">Product Item</p>
        <p class="mt-1">Another Product + $15.00</p>
      </div>
      <x-shop::quantity-selector :min="1" :value="1" disabled />
    </div>
  </div>
  @end_visual_design_mode
@endisset