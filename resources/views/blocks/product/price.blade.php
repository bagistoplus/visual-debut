@isset($product)
  <div
    {{ $block->editor_attributes }}
    x-data="VisualProductPrices"
    x-bind="bindings"
    class="text-primary [&>div>p:nth-of-type(2)]:text-neutral [&_.line-through]:text-on-background flex items-center gap-2 text-lg font-medium [&>div>p:nth-of-type(2)]:text-xs [&>div]:flex [&>div]:items-center"
  >

    {!! $product->getTypeInstance()->getPriceHtml() !!}
  </div>
@else
  @visual_design_mode
    <div {{ $block->editor_attributes }}>
      <div class="text-primary flex items-center gap-2 text-lg font-medium">
        <x-shop::formatted-price price="20"/>
      </div>
    </div>
  @end_visual_design_mode
@endisset
