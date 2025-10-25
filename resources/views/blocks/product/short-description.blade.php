@isset($product)
  <div {{ $block->editor_attributes }} class="prose">
    {!! visual_clear_inline_styles($product->short_description) !!}
  </div>
@else
  <div {{ $block->editor_attributes }}>
    This block should be used in a context where a product is defined
  </div>
@endisset
