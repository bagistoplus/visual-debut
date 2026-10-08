@aware(['id' => null, 'value' => null])

<ui-accordion-item-content
  @if ($id) id="{{ $id }}-content-{{ $value }}" @endif
  wire:ignore.self
  class="[&:not([hidden])]:grid *:min-h-0 data-[state=open]:animate-accordion-open data-[state=closed]:animate-accordion-close"
>
  <div>
    <div {{ $attributes->merge(['class' => 'pb-2']) }}>
      {{ $slot }}
    </div>
  </div>
</ui-accordion-item-content>
