@aware(['id' => null])

<ui-dialog-title
  @if ($id) id="{{ $id }}-title" @endif
  wire:ignore.self
  {{ $attributes->merge(['class' => 'block text-lg font-semibold text-on-background']) }}
>
  {{ $slot }}
</ui-dialog-title>
