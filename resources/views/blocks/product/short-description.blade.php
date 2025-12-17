@isset($product)
  <div {{ $block->editor_attributes }} class="prose">
    {!! visual_clear_inline_styles($product->short_description) !!}
  </div>
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }} class="prose text-muted">
    <p>Short product description will appear here. This is a brief summary of the product's key features and benefits.</p>
  </div>
  @end_visual_design_mode
@endisset
