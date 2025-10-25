@php
  $tag = $block->settings->heading_level ?? 'h1';
@endphp

<x-shop::text-block :block="$block" :tag="$tag">
  @if ($product)
    {{ $product->name }}
  @else
    <span class="text-muted">Product Title</span>
  @endif
</x-shop::text-block>
