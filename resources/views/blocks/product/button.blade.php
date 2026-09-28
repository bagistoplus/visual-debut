@php
  $action = $block->settings->action ?? 'cart';
  $size = $block->settings->size ?? 'md';
  $variant = $block->settings->variant ?? 'solid';
  $variant = $variant === 'solid' ? 'filled' : $variant;
  $color = $block->settings->color ?? 'primary';
  $icon = $block->settings->icon;
  $circle = $block->settings->circle ?? false;
  $square = $block->settings->square ?? false;
  $blockWidth = $block->settings->block ?? false;
  $editorAttrs = $block->editor_attributes->toHtml();
@endphp

@if (!$productId)
  @visual_design_mode
  {{-- Placeholder when no product is selected (design mode only) --}}
  <x-basic-blocks::button
    tag="button"
    type="button"
    :variant="$variant"
    :color="$color"
    :size="$size"
    :icon="$icon"
    :circle="$circle"
    :square="$square"
    :block="$blockWidth"
    :rawAttributes="$editorAttrs"
  >
    @if (!$circle && !$square)
      <span class="text-muted">
        {{ match ($action) {
            'wishlist' => __('visual-debut::blocks.product-button.placeholder.wishlist'),
            'compare' => __('visual-debut::blocks.product-button.placeholder.compare'),
            default => __('visual-debut::blocks.product-button.placeholder.cart'),
        } }}
      </span>
    @endif
  </x-basic-blocks::button>
  @end_visual_design_mode
@else
  @if ($action === 'cart')
    <x-shop::product.action-button
      action="cart"
      :product-id="$productId"
      :size="$size"
      :variant="$variant"
      :color="$color"
      :icon="$icon"
      :circle="$circle"
      :square="$square"
      :block="$blockWidth"
      :additional-attributes="$editorAttrs"
    />
  @elseif ($action === 'wishlist')
    @if ($canShowWishlist)
      <x-shop::product.action-button
        action="wishlist"
        :product-id="$productId"
        :in-wishlist="$inWishlist"
        :size="$size"
        :variant="$variant"
        :color="$color"
        :icon="$icon"
        :circle="$circle"
        :square="$square"
        :block="$blockWidth"
        :additional-attributes="$editorAttrs"
      />
    @else
      @visual_design_mode
      <x-basic-blocks::button
        tag="button"
        type="button"
        :variant="$variant"
        :color="$color"
        :size="$size"
        :icon="$icon ?? 'heroicon-o-heart'"
        :circle="$circle"
        :square="$square"
        :block="$blockWidth"
        :rawAttributes="$editorAttrs"
      >
        @if (!$circle && !$square)
          {{ __('visual-debut::blocks.product-button.wishlist_disabled') }}
        @endif
      </x-basic-blocks::button>
      @end_visual_design_mode
    @endif
  @elseif ($action === 'compare')
    @if ($canShowCompare)
      <x-shop::product.action-button
        action="compare"
        :product-id="$productId"
        :size="$size"
        :variant="$variant"
        :color="$color"
        :icon="$icon"
        :circle="$circle"
        :square="$square"
        :block="$blockWidth"
        :additional-attributes="$editorAttrs"
      />
    @else
      @visual_design_mode
      {{-- Compare disabled fallback (design mode only) --}}
      <x-basic-blocks::button
        tag="button"
        type="button"
        :variant="$variant"
        :color="$color"
        :size="$size"
        :icon="$icon ?? 'lucide-arrow-left-right'"
        :circle="$circle"
        :square="$square"
        :block="$blockWidth"
        :rawAttributes="$editorAttrs"
      >
        @if (!$circle && !$square)
          {{ __('visual-debut::blocks.product-button.compare_disabled') }}
        @endif
      </x-basic-blocks::button>
      @end_visual_design_mode
    @endif
  @endif
@endif
