@aware(['id' => null, 'value' => null])

<ui-accordion-item-trigger delegate>
  <button
    @if ($id) id="{{ $id }}-trigger-{{ $value }}" @endif
    wire:ignore.self
    {{ $attributes->merge(['class' => 'flex items-center py-2 w-full']) }}
  >
    <span>{{ $slot }}</span>
    <ui-accordion-item-indicator wire:ignore.self class="ms-auto shrink-0 transition-transform duration-200 data-[state=open]:rotate-180">
      @if (isset($indicator))
        {{ $indicator }}
      @else
        <x-lucide-chevron-down class="h-4 w-4" />
      @endif
    </ui-accordion-item-indicator>
  </button>
</ui-accordion-item-trigger>
