@isset($product)
  <div {{ $block->editor_attributes }} class="prose max-w-none">
    {!! visual_clear_inline_styles($product->short_description) !!}
  </div>
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }} class="prose text-muted max-w-none">
    <h3>Product Description</h3>
    <p>This is where the full product description will appear. It includes detailed information about the product's features, specifications, materials, and usage instructions.</p>
    <ul>
      <li>Feature highlight 1</li>
      <li>Feature highlight 2</li>
      <li>Feature highlight 3</li>
    </ul>
  </div>
  @end_visual_design_mode
@endisset
