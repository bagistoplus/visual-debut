@php
  $openByDefault = collect($block->children())->filter(fn($child) => $child->settings->open_by_default ?? false)->pluck('id')->toArray();
@endphp

<div
  {{ $block->editor_attributes }}
  x-accordion="{ value: @js($openByDefault), multiple: true }"
  class="accordion w-full {{ $paddingClasses }}"
>
  @children
</div>
