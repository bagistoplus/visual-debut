@props(['id', 'placement' => 'end'])

<ui-popover
  id="{{ $id }}"
  positioning-placement="{{ $placement === 'start' ? 'bottom-start' : 'bottom-end' }}"
  {{ $attributes }}
>
  {{ $slot }}
</ui-popover>
