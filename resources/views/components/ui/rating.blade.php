@props([
    'id',
    'label' => null,
    'value' => null,
    'count' => 5,
])

{{-- Dispatches `change` with the picked number --}}
<ui-rating
  id="{{ $id }}"
  @if ($value !== null) default-value="{{ $value }}" @endif
  wire:ignore.self
  x-on:ui-rating:value-change="$dispatch('change', $event.detail.value)"
  {{ $attributes }}
>
  @if ($label)
    <ui-rating-label delegate>
      <label id="{{ $id }}-label" wire:ignore.self>{{ $label }}</label>
    </ui-rating-label>
  @endif

  <ui-rating-control id="{{ $id }}-control" wire:ignore.self class="flex gap-1">
    @for ($i = 1; $i <= $count; $i++)
      <ui-rating-item id="{{ $id }}-item-{{ $i }}" wire:ignore.self class="group cursor-pointer rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-accent">
        <x-lucide-star class="stroke-on-background group-data-highlighted:stroke-accent group-data-highlighted:fill-accent h-5 w-5" />
      </ui-rating-item>
    @endfor
  </ui-rating-control>
</ui-rating>
