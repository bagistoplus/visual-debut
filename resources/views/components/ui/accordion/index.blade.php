@props(['id', 'value' => [], 'multiple' => false])

<ui-accordion
  id="{{ $id }}"
  collapsible
  @if ($multiple) multiple @endif
  default-value="{{ collect($value)->implode(',') }}"
  {{-- Like the items, the root keeps the props Zag added through Livewire updates --}}
  wire:ignore.self
  {{ $attributes }}
>
  {{ $slot }}
</ui-accordion>
