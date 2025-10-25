@php
  $category = $block->settings->category ?? $category ?? null;
@endphp

<x-shop::text-block :block="$block">
  @if ($category)
    {{ $category->name }}
  @else
    <span class="text-muted">Category Name</span>
  @endif
</x-shop::text-block>
