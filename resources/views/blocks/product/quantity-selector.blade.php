@if ($product && $showQuantitySelector)
  <div {{ $block->editor_attributes }}>
    <x-shop::quantity-selector :id="'product-qty-' . $block->id" label="{{ trans('visual-debut::shop.order.quantity') }}" x-on:change="$wire.quantity = $event.detail" />
  </div>
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }}>
    <x-shop::quantity-selector
      :id="'product-qty-' . $block->id"
      label="{{ trans('visual-debut::shop.order.quantity') }}"
      :value="1"
      disabled
    />
  </div>
  @end_visual_design_mode
@endif
