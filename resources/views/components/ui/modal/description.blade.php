@aware(['id' => null])

<ui-dialog-description
  @if ($id) id="{{ $id }}-description" @endif
  wire:ignore.self
  {{ $attributes->merge(['class' => 'block']) }}
>
  {{ $slot }}
</ui-dialog-description>
