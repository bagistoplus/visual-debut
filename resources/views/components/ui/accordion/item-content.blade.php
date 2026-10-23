@aware(['id' => null, 'value' => null, 'open' => false])

<ui-accordion-item-content
  @if ($id) id="{{ $id }}-content-{{ $value }}" @endif
  {{-- Rendered in its starting state, so the first paint matches what the accordion sets once it upgrades --}}
  data-state="{{ $open ? 'open' : 'closed' }}"
  @unless ($open) hidden @endunless
  wire:ignore.self
>
  <div>
    <div {{ $attributes->merge(['class' => 'pb-2']) }}>
      {{ $slot }}
    </div>
  </div>
</ui-accordion-item-content>
