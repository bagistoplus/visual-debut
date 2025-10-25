@php
  $action = $block->settings->action ?? 'cart';
  $size = $block->settings->size ?? 'md';
  $variant = $block->settings->variant ?? 'solid';
  $color = $block->settings->color ?? 'primary';
  $icon = $block->settings->icon;
  $circle = $block->settings->circle ?? false;
  $square = $block->settings->square ?? false;
  $blockWidth = $block->settings->block ?? false;
@endphp

<div {{ $block->editor_attributes }}>
  @if (!$productResource)
    @visual_design_mode
    {{-- Placeholder when no product is selected (design mode only) --}}
    <x-shop::ui.button
      :variant="$variant"
      :color="$color"
      :size="$size"
      :icon="$icon"
      :circle="$circle"
      :square="$square"
      :block="$blockWidth"
    >
      @if (!$circle && !$square)
        <span class="text-muted">
          {{ match ($action) {
              'wishlist' => __('blocks.product-button.placeholder.wishlist'),
              'compare' => __('blocks.product-button.placeholder.compare'),
              default => __('blocks.product-button.placeholder.cart'),
          } }}
        </span>
      @endif
    </x-shop::ui.button>
    @end_visual_design_mode
  @else
    @if ($action === 'cart')
      <livewire:add-to-cart-button
        :key="'product-button-cart-' . $productResource['id'] . '-' . str()->random(8)"
        :product-id="$productResource['id']"
        :size="$size"
        :variant="$variant"
        :color="$color"
        :icon="$icon"
        :circle="$circle"
        :square="$square"
        :block="$blockWidth"
      />
    @elseif ($action === 'wishlist')
      @if ($canShowWishlist)
        <livewire:add-to-wishlist-button
          :key="'product-button-wishlist-' . $productResource['id'] . '-' . str()->random(8)"
          :product-id="$productResource['id']"
          :in-user-wishlist="$productResource['is_wishlist']"
          :size="$size"
          :variant="$variant"
          :color="$color"
          :icon="$icon"
          :circle="$circle"
          :square="$square"
          :block="$blockWidth"
        />
      @else
        @visual_design_mode
        <x-shop::ui.button
          :variant="$variant"
          :color="$color"
          :size="$size"
          :icon="$icon ?? 'heroicon-o-heart'"
          :circle="$circle"
          :square="$square"
          :block="$blockWidth"
        >
          @if (!$circle && !$square)
            {{ __('blocks.product-button.wishlist_disabled') }}
          @endif
        </x-shop::ui.button>
        @end_visual_design_mode
      @endif
    @elseif ($action === 'compare')
      @if ($canShowCompare)
        <livewire:add-to-compare-button
          :key="'product-button-compare-' . $productResource['id'] . '-' . str()->random(8)"
          :product-id="$productResource['id']"
          :size="$size"
          :variant="$variant"
          :color="$color"
          :icon="$icon"
          :circle="$circle"
          :square="$square"
          :block="$blockWidth"
        />
      @else
        @visual_design_mode
        {{-- Compare disabled fallback (design mode only) --}}
        <x-shop::ui.button
          :variant="$variant"
          :color="$color"
          :size="$size"
          :icon="$icon ?? 'lucide-arrow-left-right'"
          :circle="$circle"
          :square="$square"
          :block="$blockWidth"
        >
          @if (!$circle && !$square)
            {{ __('blocks.product-button.compare_disabled') }}
          @endif
        </x-shop::ui.button>
        @end_visual_design_mode
      @endif
    @endif
  @endif
</div>
