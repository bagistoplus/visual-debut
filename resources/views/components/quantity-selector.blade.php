@props([
    'id',
    'label' => null,
    'value' => 1,
    'min' => 0,
    'size' => 'md',
])

@php
  $size = in_array($size, ['xs', 'sm', 'md', 'lg'], true) ? $size : 'md';
@endphp

{{-- Dispatches `change` with the new number when a button is pressed or a typed value is committed --}}
<ui-number-input
  id="{{ $id }}"
  default-value="{{ intval($value) }}"
  min="{{ $min }}"
  wire:ignore.self
  x-data="{
      last: {{ intval($value) }},
      emit(value) {
          // An emptied or decimal field puts the last quantity back; Zag's blur clamp skips an empty field
          if (!Number.isInteger(value)) {
              this.$nextTick(() => this.$root.api?.setValue(this.last));

              return;
          }

          if (value !== this.last) {
              this.last = value;
              this.$dispatch('change', value);
          }
      },
  }"
  x-on:ui-number-input:value-commit="emit($event.detail.valueAsNumber)"
  x-on:click="$event.target.closest('button') && emit($el.api.valueAsNumber)"
  {{ $attributes->merge(['class' => 'flex items-center gap-4']) }}
>
  @if ($label)
    <ui-number-input-label delegate>
      <label id="{{ $id }}-label" wire:ignore.self class="text-sm font-medium">
        {{ $label }}
      </label>
    </ui-number-input-label>
  @endif
  <ui-number-input-control wire:ignore.self class="qty qty-{{ $size }}">
    <ui-number-input-decrement-trigger delegate>
      <button id="{{ $id }}-decrement" type="button" wire:ignore.self class="qty-btn">
        @svg('lucide-minus')
      </button>
    </ui-number-input-decrement-trigger>

    <ui-number-input-input delegate>
      {{-- The native change event would reach the caller's x-on:change without a number --}}
      <input
        id="{{ $id }}-input"
        value="{{ intval($value) }}"
        wire:ignore.self
        x-on:change.stop=""
        class="qty-input"
      >
    </ui-number-input-input>

    <ui-number-input-increment-trigger delegate>
      <button id="{{ $id }}-increment" type="button" wire:ignore.self class="qty-btn">
        @svg('lucide-plus')
      </button>
    </ui-number-input-increment-trigger>
  </ui-number-input-control>
</ui-number-input>
