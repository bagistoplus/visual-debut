@isset($product)
  <div {{ $block->editor_attributes }}>
    <div
      x-data="VisualProductPrices"
      x-bind="bindings"
      class="text-primary [&>div>p:nth-of-type(2)]:text-neutral [&_.line-through]:text-on-background flex items-center gap-2 text-lg font-medium [&>div>p:nth-of-type(2)]:text-xs [&>div]:flex [&>div]:items-center"
    >
      {!! $product->getTypeInstance()->getPriceHtml() !!}
    </div>

    {{-- The lowest price before the discount (EU Omnibus Directive), Bagisto 2.5 on. Bagisto decides when it shows and renders it with the theme's products/omnibus views --}}
    @if (class_exists(\Webkul\Omnibus\Services\OmnibusPriceManager::class))
      {!! app(\Webkul\Omnibus\Services\OmnibusPriceManager::class)->getOmnibusPriceHtml($product) !!}
    @endif
  </div>
@else
  @visual_design_mode
  <div {{ $block->editor_attributes }}>
    <div class="text-primary flex items-center gap-2 text-lg font-medium">
      <x-shop::formatted-price price="20" />
    </div>
  </div>
  @end_visual_design_mode
@endisset
