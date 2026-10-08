@props([
    'id',
    // Any floating-ui placement, e.g. bottom-start, bottom-end, top-start, top-end
    'placement' => 'bottom-start',
])

<ui-popover id="{{ $id }}" positioning-placement="{{ $placement }}" {{ $attributes }}>
  <ui-popover-trigger delegate wire:ignore.self>
    {{ $trigger }}
  </ui-popover-trigger>

  <ui-popover-positioner id="{{ $id }}-positioner" wire:ignore.self>
    <ui-popover-content
      id="{{ $id }}-content"
      wire:ignore.self
      class="z-50 origin-(--transform-origin) data-[state=open]:animate-popover-in data-[state=closed]:animate-popover-out"
    >
      {{ $slot }}
    </ui-popover-content>
  </ui-popover-positioner>
</ui-popover>
