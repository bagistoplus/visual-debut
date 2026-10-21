@isset($product)
  @if ($product->type === 'grouped')
    @include('visual-debut::blocks.product.options.grouped')
  @endif
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }} class="grid w-full max-w-sm gap-4">
    <div class="flex items-center justify-between gap-4">
      <div class="text-xs">
        <p class="text-on-background font-semibold">@lang('visual-debut::blocks.product-grouped-options.placeholder.product-item')</p>
        <p class="mt-1">@lang('visual-debut::blocks.product-grouped-options.placeholder.sample-product', ['price' => '$25.00'])</p>
      </div>
      <x-shop::quantity-selector
        id="grouped-qty-placeholder-1"
        :min="1"
        :value="1"
        disabled
      />
    </div>
    <div class="flex items-center justify-between gap-4">
      <div class="text-xs">
        <p class="text-on-background font-semibold">@lang('visual-debut::blocks.product-grouped-options.placeholder.product-item')</p>
        <p class="mt-1">@lang('visual-debut::blocks.product-grouped-options.placeholder.another-product', ['price' => '$15.00'])</p>
      </div>
      <x-shop::quantity-selector
        id="grouped-qty-placeholder-2"
        :min="1"
        :value="1"
        disabled
      />
    </div>
  </div>
  @end_visual_design_mode
@endisset
