@isset($product)
  @if ($optionsType)
    @include('visual-debut::blocks.product.options.' . $optionsType)
  @else
    @visual_design_mode
    <p {{ $block->editor_attributes }} class="text-on-background/60 text-sm">
      @lang('visual-debut::blocks.product-options.no-options')
    </p>
    @end_visual_design_mode
  @endif
@else
  @visual_design_mode
  @include('visual-debut::blocks.product.options.placeholder')
  @end_visual_design_mode
@endisset
