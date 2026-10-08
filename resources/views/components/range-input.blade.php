@props([
    'min' => 0,
    'max' => 100,
    'step' => 1,
    'gap' => 0,
    'value' => [0, 100],
])

@php
  $value = array_values($value);
  $thumbClass = 'bg-primary border-primary block h-4 w-4 cursor-pointer rounded-full border';
  $fieldClass = 'input-sm w-24 rounded border py-1 pl-6 pr-2 text-right text-sm';
@endphp

{{-- Dispatches `change` with [min, max] on every move of a thumb or a committed field --}}
<div x-data="{
    value: @js($value),
    move(value) {
        this.value = value;
        this.$dispatch('change', value);
    },
    type(index, raw) {
        const number = Number(raw);

        if (raw !== '' && !Number.isNaN(number)) {
            this.$refs.slider.api?.setThumbValue(index, number);
        }

        // Show what the slider kept: the typed price clamped, or the old one when it was not a number
        this.value = [...(this.$refs.slider.api?.value ?? this.value)];
    },
}" {{ $attributes }}>
  <ui-slider
    x-ref="slider"
    min="{{ $min }}"
    max="{{ $max }}"
    step="{{ $step }}"
    min-steps-between-thumbs="{{ $gap }}"
    default-value="{{ implode(',', $value) }}"
    x-on:ui-slider:value-change="move($event.detail.value)"
    class="block"
  >
    <ui-slider-control class="flex h-4 items-center">
      <ui-slider-track class="bg-surface-alt h-1 w-full rounded">
        <ui-slider-range class="bg-primary h-full rounded"></ui-slider-range>
      </ui-slider-track>

      <ui-slider-thumb aria-label="{{ trans('visual-debut::shop.range.min-value') }}" class="{{ $thumbClass }}">
        <ui-slider-hidden-input delegate><input /></ui-slider-hidden-input>
      </ui-slider-thumb>

      <ui-slider-thumb aria-label="{{ trans('visual-debut::shop.range.max-value') }}" class="{{ $thumbClass }}">
        <ui-slider-hidden-input delegate><input /></ui-slider-hidden-input>
      </ui-slider-thumb>
    </ui-slider-control>
  </ui-slider>

  <div class="flex items-center justify-between py-5">
    @foreach (['min-value', 'max-value'] as $index => $label)
      <div class="relative">
        <span class="absolute left-2 top-1/2 -translate-y-1/2 transform">{{ core()->getCurrentCurrency()->symbol }}</span>
        {{-- .stop: the native change event would reach the caller's x-on:change without [min, max] --}}
        <input
          x-bind:value="value[{{ $index }}]"
          x-on:change.stop="type({{ $index }}, $event.target.value)"
          x-on:keydown.enter.prevent="type({{ $index }}, $event.target.value)"
          aria-label="{{ trans('visual-debut::shop.range.' . $label) }}"
          class="{{ $fieldClass }}"
        >
      </div>
    @endforeach
  </div>
</div>
