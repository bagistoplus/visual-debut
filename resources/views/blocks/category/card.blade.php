@php
  $category = $block->settings->category ?? ($category ?? null);
@endphp

<div {{ $block->editor_attributes }} class="group relative overflow-hidden rounded-md">
  @children
  @if ($category)
    <a
      href="{{ $category->url }}"
      class="before:absolute before:inset-0 before:z-10"
      aria-label="{{ $category->name }}"
    ></a>
  @endif
</div>
