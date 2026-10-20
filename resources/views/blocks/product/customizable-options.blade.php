@isset($product)
  @if ($product->getTypeInstance()->isCustomizable())
    @include('visual-debut::blocks.product.options.customizable')
  @endif
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }} class="text-muted">
    <div class="border-b pb-3">
      <label class="text-sm font-semibold">
        @lang('visual-debut::blocks.product-customizable-options.placeholder.customizable-option')
        <span class="text-secondary text-xs font-normal">+ $5.00</span>
      </label>
      <input
        type="text"
        class="mt-1 w-full"
        disabled
        placeholder="{{ trans('visual-debut::blocks.product-customizable-options.placeholder.enter-value') }}"
      >
    </div>
  </div>
  @end_visual_design_mode
@endisset
