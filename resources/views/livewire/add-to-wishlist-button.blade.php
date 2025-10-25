<x-shop::ui.button
  wire:click="handle"
  :variant="$variant"
  :size="$size"
  :circle="$circle"
  :square="$square"
  :block="$block"
  :color="$inUserWishlist ? 'danger' : ($color ?? 'secondary')"
  :icon="$icon ?? ($inUserWishlist ? 'heroicon-s-heart' : 'heroicon-o-heart')"
  loading
  {{ $attributes }}
/>
