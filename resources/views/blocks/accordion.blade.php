@php
  $openByDefault = collect($block->children())->filter(fn($child) => $child->settings->open_by_default ?? false)->pluck('id')->toArray();
@endphp

<div
  {{ $block->editor_attributes }}
  class="accordion w-full {{ $paddingClasses }}"
>
  <x-shop::ui.accordion :id="'accordion-' . $block->id" :value="$openByDefault" multiple>
    @children
  </x-shop::ui.accordion>
</div>
