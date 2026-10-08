@aware(['id' => null])

<ui-collapsible-content
  @if ($id) id="{{ $id }}-content" @endif
  wire:ignore.self
  {{ $attributes->merge(['class' => 'data-[state=open]:animate-collapsible-down data-[state=closed]:animate-collapsible-up']) }}
>
  {{ $slot }}
</ui-collapsible-content>
