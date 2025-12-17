@if ($product && $showQuantitySelector)
  <div {{ $block->editor_attributes }}>
    <x-shop::quantity-selector label="{{ trans('Quantity') }}" x-on:change="$wire.quantity = $event.detail" />
  </div>
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }}>
    <x-shop::quantity-selector
      label="{{ trans('Quantity') }}"
      :value="1"
      disabled
    />
  </div>
  @end_visual_design_mode
@endif
