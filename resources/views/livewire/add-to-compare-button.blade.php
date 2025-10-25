@php
  $alpineProps = [
      'productId' => $productId,
      'userLoggedIn' => auth('customer')->check(),
      'messages' => [
          'alreadyInCompare' => trans('shop::app.products.view.already-in-compare'),
          'addedToCompare' => trans('shop::app.products.view.add-to-compare'),
      ],
  ];
@endphp

<x-shop::ui.button
  x-data="VisualAddToCompare({{ Js::from($alpineProps) }})"
  x-on:click="handle"
  title="{{ trans('shop::app.components.products.card.add-to-compare') }}"
  :variant="$variant"
  :color="$color"
  :size="$size"
  :icon="$icon ?? 'lucide-arrow-left-right'"
  :circle="$circle"
  :square="$square"
  :block="$block"
  {{ $attributes }}
/>
