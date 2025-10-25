@isset($product)
  @if ($showQuantitySelector)
    <div {{ $block->editor_attributes }}>
      <x-shop::quantity-selector label="{{ trans('Quantity') }}" x-on:change="$wire.quantity = $event.detail" />
    </div>
  @endif
@else
  <div {{ $block->editor_attributes }}>
    This block should be used in a context where a product is defined
  </div>
@endisset
