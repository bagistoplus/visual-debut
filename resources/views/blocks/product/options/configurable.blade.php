@php
  $props = [
      'variantAttributes' => $variantAttributes,
      'variantPrices' => $variantPrices,
      'variantImages' => $variantImages,
      'variantVideos' => $variantVideos,
  ];

  $unavailable = trans('visual-debut::shop.unavailable');
@endphp

{{-- The options render on the server, so the page does not move when Alpine starts; Alpine only tracks selection and availability --}}
<div
  {{ $block->editor_attributes }}
  x-data="VisualVariantPicker(@js($props))"
>
  @foreach ($variantAttributes as $attribute)
    @php
      $attributeId = $attribute['id'];
      $swatchType = $attribute['swatch_type'] ?? null;
    @endphp

    <div
      data-attribute-id="{{ $attributeId }}"
      data-swatch-type="{{ $swatchType }}"
      x-bind:data-selected="selections[@js($attributeId)]"
      class="mb-4"
    >
      <label class="mb-1 block font-semibold">
        {{ $attribute['label'] }}
      </label>

      @if (! $swatchType || $swatchType === 'dropdown')
        <select
          id="{{ $attributeId }}"
          class="max-w-72 py-1"
          x-on:change="onOptionSelected(@js($attributeId), $event.target.value)"
        >
          <option>@lang('visual-debut::shop.select-option', ['option' => $attribute['label']])</option>
          @foreach ($attribute['options'] as $option)
            <option
              value="{{ $option['id'] }}"
              x-bind:selected="selections[@js($attributeId)] == @js($option['id'])"
              x-bind:disabled="!isAvailable(@js($attributeId), @js($option['id']))"
              x-text="@js($option['label']) + (isAvailable(@js($attributeId), @js($option['id'])) ? '' : ' (' + @js($unavailable) + ')')"
            >{{ $option['label'] }}</option>
          @endforeach
        </select>
      @elseif ($swatchType === 'color')
        <div class="flex flex-wrap gap-4">
          @foreach ($attribute['options'] as $option)
            <button
              type="button"
              class="relative flex h-8 w-8 items-center justify-center rounded-full border"
              x-bind:class="[
                  selections[@js($attributeId)] === @js($option['id']) ? 'ring-2 ring-offset-2 ring-primary' :
                  'hover:ring-2 hover:ring-offset-2 hover:ring-on-background/20',
                  isAvailable(@js($attributeId), @js($option['id'])) ? '' : 'cursor-not-allowed ring-primary/40!'
              ]"
              style="background-color: {{ $option['swatch_value'] }}"
              title="{{ $option['label'] }}"
              x-bind:title="@js($option['label']) + (isAvailable(@js($attributeId), @js($option['id'])) ? '' : ' (' + @js($unavailable) + ')')"
              x-on:click="onOptionSelected(@js($attributeId), @js($option['id']))"
            >
              <div x-show="!isAvailable(@js($attributeId), @js($option['id']))" x-cloak class="absolute inset-0 rounded-full bg-black/20"></div>
            </button>
          @endforeach
        </div>
      @elseif ($swatchType === 'image')
        <div class="flex flex-wrap gap-4">
          @foreach ($attribute['options'] as $option)
            <button
              type="button"
              class="rounded-(--btn-radius) relative h-10 w-10 overflow-hidden"
              x-bind:class="[
                  selections[@js($attributeId)] === @js($option['id']) ? 'ring-2 ring-offset-2 ring-primary' :
                  'hover:ring-2 hover:ring-offset-2 hover:ring-on-background/20',
                  isAvailable(@js($attributeId), @js($option['id'])) ? '' : 'cursor-not-allowed'
              ]"
              title="{{ $option['label'] }}"
              x-bind:title="@js($option['label']) + (isAvailable(@js($attributeId), @js($option['id'])) ? '' : ' (' + @js($unavailable) + ')')"
              x-on:click="onOptionSelected(@js($attributeId), @js($option['id']))"
            >
              <img src="{{ $option['swatch_value'] }}" alt="" class="rounded-(--btn-radius) h-full w-full">
              <div x-show="!isAvailable(@js($attributeId), @js($option['id']))" x-cloak class="rounded-(--btn-radius) absolute inset-0 bg-black/30"></div>
            </button>
          @endforeach
        </div>
      @elseif ($swatchType === 'text')
        <div class="flex flex-wrap gap-2">
          @foreach ($attribute['options'] as $option)
            <button
              type="button"
              class="rounded-(--btn-radius) relative min-w-12 whitespace-nowrap border px-3 py-2 text-sm font-medium"
              x-bind:class="[
                  selections[@js($attributeId)] === @js($option['id']) ? 'border-primary bg-primary text-on-primary' :
                  'bg-background text-on-background/90 hover:bg-surface-alt',
                  isAvailable(@js($attributeId), @js($option['id'])) ? '' : 'cursor-not-allowed text-on-background'
              ]"
              title="{{ $option['label'] }}"
              x-bind:title="@js($option['label']) + (isAvailable(@js($attributeId), @js($option['id'])) ? '' : ' (' + @js($unavailable) + ')')"
              x-on:click="onOptionSelected(@js($attributeId), @js($option['id']))"
            >
              <span>{{ $option['label'] }}</span>
              <div x-show="!isAvailable(@js($attributeId), @js($option['id']))" x-cloak class="rounded-(--btn-radius) absolute inset-0 bg-black/30"></div>
            </button>
          @endforeach
        </div>
      @endif
    </div>
  @endforeach
</div>
