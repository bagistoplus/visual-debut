@props([
    'action',
    'productId',
    'inWishlist' => false,
    'size' => 'md',
    'variant' => null,
    'color' => null,
    'icon' => null,
    'circle' => false,
    'square' => false,
    'block' => false,
    'additionalAttributes' => '',
])

@php
  $config = [
      'action' => $action,
      'productId' => (int) $productId,
      'url' => match ($action) {
          'wishlist' => route('shop.api.customers.account.wishlist.store'),
          'compare' => route('shop.api.compare.store'),
          default => route('shop.api.checkout.cart.store'),
      },
      'loggedIn' => auth('customer')->check(),
      'loginUrl' => route('shop.customer.session.index'),
      'inWishlist' => (bool) $inWishlist,
      'messages' => [
          'failed' => trans('visual-debut::shop.request-failed'),
          'alreadyInCompare' => trans('shop::app.products.view.already-in-compare'),
          'addedToCompare' => trans('shop::app.products.view.add-to-compare'),
      ],
  ];

  $variant ??= $action === 'cart' ? 'solid' : 'soft';
  $variant = $variant === 'solid' ? 'filled' : $variant;
  $color ??= $action === 'cart' ? 'primary' : 'secondary';
  $icon ??= match ($action) {
      'wishlist' => 'heroicon-o-heart',
      'compare' => 'lucide-arrow-left-right',
      default => 'lucide-shopping-cart',
  };

  $alpineAttributes =
      $action === 'wishlist'
          ? [
              'x-bind:aria-pressed' => 'inWishlist',
              'x-bind:class' => "{ 'btn-danger [&_svg]:fill-current': inWishlist, 'btn-{$color}': !inWishlist }",
          ]
          : [];

  $label = match ($action) {
      'wishlist' => trans('shop::app.components.products.card.add-to-wishlist'),
      'compare' => trans('shop::app.components.products.card.add-to-compare'),
      default => trans('shop::app.components.products.card.add-to-cart'),
  };
@endphp

<x-basic-blocks::button
  tag="button"
  type="button"
  x-data="VisualProductAction({{ Js::from($config) }})"
  x-on:click.prevent="handle"
  x-bind:loading="pending || null"
  x-bind:disabled="pending"
  :variant="$variant"
  :color="$inWishlist ? 'danger' : $color"
  :size="$size"
  :icon="$icon"
  :circle="$circle"
  :square="$square"
  :block="$block"
  :rawAttributes="$additionalAttributes"
  aria-label="{{ $label }}"
  {{ $attributes->merge($alpineAttributes, escape: false) }}
>
  @if ($action === 'cart')
    {{ $label }}
  @endif
</x-basic-blocks::button>
