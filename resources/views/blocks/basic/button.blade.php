@php
  $variantMap = [
      'button' => 'solid',
      'outline' => 'outline',
      'link' => 'link',
  ];
  $variant = $variantMap[$block->settings->style_class] ?? 'solid';
  $isBlock = $block->settings->block;
  $isCircle = $block->settings->circle;
  $isSquare = $block->settings->square;

  // Build width classes for custom width (only when not block/circle/square)
  $widthClasses = '';
  if (!$isBlock && !$isCircle && !$isSquare) {
      $widthMobile = $block->settings->width_mobile ?? 'fit-content';
      $widthDesktop = $block->settings->width ?? 'fit-content';

      if ($widthMobile === 'custom') {
          $customWidthMobile = $block->settings->custom_width_mobile ?? 100;
          $widthClasses .= " max-md:w-[{$customWidthMobile}%]";
      }

      if ($widthDesktop === 'custom') {
          $customWidthDesktop = $block->settings->custom_width ?? 100;
          $widthClasses .= " md:w-[{$customWidthDesktop}%]";
      }
  }
@endphp

<x-shop::ui.button
  :variant="$variant"
  :color="$block->settings->color"
  :size="$block->settings->size"
  :icon="$block->settings->icon"
  :circle="$isCircle"
  :square="$isSquare"
  :block="$isBlock"
  :href="$block->settings->link"
  :additionalAttributes="$block->editor_attributes . ' ' . $block->settings->color_scheme?->attributes()"
>
  @if (!$isCircle && !$isSquare)
    <span {!! $block->liveUpdate()->text('label') !!}>
      {{ $block->settings->label }}
    </span>
  @endif
</x-shop::ui.button>
