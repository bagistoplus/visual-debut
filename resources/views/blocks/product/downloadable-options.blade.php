@isset($product)
  @if ($product->type === 'downloadable')
    @include('visual-debut::blocks.product.options.downloadable')
  @endif
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }} class="space-y-4">
    <div>
      <h3 class="text-on-background mb-2 text-base font-semibold">@lang('visual-debut::blocks.product-downloadable-options.placeholder.samples')</h3>
      <ul>
        <li><a class="text-primary" href="#">@lang('visual-debut::blocks.product-downloadable-options.placeholder.download-sample', ['index' => 1])</a></li>
        <li><a class="text-primary" href="#">@lang('visual-debut::blocks.product-downloadable-options.placeholder.download-sample', ['index' => 2])</a></li>
      </ul>
    </div>
    <div>
      <h3 class="text-on-background mb-2 text-base font-semibold">@lang('visual-debut::blocks.product-downloadable-options.placeholder.links')</h3>
      <div class="grid gap-2">
        <label class="flex items-center gap-x-2">
          <input
            type="checkbox"
            disabled
            class="text-primary"
          >
          <span>@lang('visual-debut::blocks.product-downloadable-options.placeholder.download-link', ['index' => 1, 'price' => '$5.00'])</span>
        </label>
        <label class="flex items-center gap-x-2">
          <input
            type="checkbox"
            disabled
            class="text-primary"
          >
          <span>@lang('visual-debut::blocks.product-downloadable-options.placeholder.download-link', ['index' => 2, 'price' => '$3.00'])</span>
        </label>
      </div>
    </div>
  </div>
  @end_visual_design_mode
@endisset
