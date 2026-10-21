@aware(['id'])

<ui-popover-positioner id="{{ $id }}-positioner" wire:ignore.self>
  <ui-popover-content
    id="{{ $id }}-content"
    wire:ignore.self
    {{ $attributes->merge(['class' => 'z-50 box bg-surface text-on-surface border-on-surface/8 py-2 shadow-sm min-w-48 w-max origin-(--transform-origin) data-[state=open]:animate-popover-in data-[state=closed]:animate-popover-out']) }}
  >
    {{ $slot }}
  </ui-popover-content>
</ui-popover-positioner>
