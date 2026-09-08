<div
  {{ $block->editor_attributes }}
  {{ $block->settings->color_scheme?->attributes() }}
  @class([
      'group/product-card relative overflow-hidden',
      'box' => $wrapInCard,
      $shadowClass => $wrapInCard && $shadowClass !== '',
  ])
>
  @children
  @if ($product && $product['url_key'])
    <a class="text-on-background before:z-5 mb-1 line-clamp-2 text-base font-medium transition-colors before:absolute before:inset-0" href="{{ url($product['url_key']) }}">
    </a>
  @endif
</div>
