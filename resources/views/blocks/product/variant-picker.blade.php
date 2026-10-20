@isset($product)
  @if ($hasVariants)
    @include('visual-debut::blocks.product.options.configurable')
  @endif
@else
  @visual_design_mode
  @include('visual-debut::blocks.product.options.placeholder')
  @end_visual_design_mode
@endisset
