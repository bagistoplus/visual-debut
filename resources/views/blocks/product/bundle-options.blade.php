@isset($product)
  @if ($product->type === 'bundle')
    @include('visual-debut::blocks.product.options.bundle')
  @endif
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }} class="text-muted space-y-4">
    <div class="grid gap-2">
      <div class="grid gap-4 border-b pb-3">
        <label>
          <span class="text-sm font-semibold">@lang('visual-debut::blocks.product-bundle-options.placeholder.choose-processor')</span>
          <select class="mt-1 w-full" disabled>
            <option>@lang('visual-debut::blocks.product-bundle-options.placeholder.processor-i5', ['price' => '$100.00'])</option>
            <option>@lang('visual-debut::blocks.product-bundle-options.placeholder.processor-i7', ['price' => '$150.00'])</option>
          </select>
        </label>
      </div>
      <div class="grid gap-4 border-b pb-3">
        <label>
          <span class="text-sm font-semibold">@lang('visual-debut::blocks.product-bundle-options.placeholder.choose-memory')</span>
          <select class="mt-1 w-full" disabled>
            <option>@lang('visual-debut::blocks.product-bundle-options.placeholder.memory-8gb', ['price' => '$50.00'])</option>
            <option>@lang('visual-debut::blocks.product-bundle-options.placeholder.memory-16gb', ['price' => '$100.00'])</option>
          </select>
        </label>
      </div>
    </div>
    <hr class="my-4">
    <div class="flex items-center justify-between">
      <label>@lang('visual-debut::blocks.product-bundle-options.placeholder.total-amount')</label>
      <div class="text-primary text-xl font-medium">$150.00</div>
    </div>
  </div>
  @end_visual_design_mode
@endisset
