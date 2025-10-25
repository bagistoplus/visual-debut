<x-shop::ui.button
  :wire:target="$action"
  :variant="$variant"
  :color="$color"
  :size="$size"
  :icon="$icon ?? 'lucide-shopping-cart'"
  :circle="$circle"
  :square="$square"
  :block="$block"
  aria-label="{{ trans('shop::app.components.products.card.add-to-cart') }}"
  {{ $attributes->merge(['x-on:click.prevent' => '$wire.' . $action . '()']) }}
>
  @if (!$circle && !$square)
    <span wire:target="{{ $action }}" wire:loading.class="opacity-0" class="transition-opacity duration-200">
      {{ trans('shop::app.components.products.card.add-to-cart') }}
    </span>
  @endif
</x-shop::ui.button>
