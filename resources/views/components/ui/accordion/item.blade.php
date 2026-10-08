@props(['value', 'title' => null])
@aware(['id' => null])

<ui-accordion-item
  value="{{ $value }}"
  @if ($id) id="{{ $id }}-item-{{ $value }}" @endif
  wire:ignore.self
  {{ $attributes->merge(['class' => 'block border-b last:border-none']) }}
>
  @if ($title)
    <h3 class="text-base font-semibold">
      <x-shop::ui.accordion.item-trigger class="w-full">
        {{ $title }}
      </x-shop::ui.accordion.item-trigger>
    </h3>
    <x-shop::ui.accordion.item-content>
      {{ $slot }}
    </x-shop::ui.accordion.item-content>
  @else
    {{ $slot }}
  @endif
</ui-accordion-item>
