@aware(['id' => null])

<ui-collapsible-trigger delegate>
  <button
    @if ($id) id="{{ $id }}-trigger" @endif
    wire:ignore.self
    {{ $attributes }}
  >
    {{ $slot }}
  </button>
</ui-collapsible-trigger>
