@php
  // Aspect ratio calculation
  $aspectRatioClasses = [
      'landscape' => 'aspect-[16/9]',
      'portrait' => 'aspect-[4/5]',
      'square' => 'aspect-square',
      'adapt' => '',
  ];
  $aspectRatioClass = $aspectRatioClasses[$block->settings->image_ratio] ?? '';

  // Width classes for desktop
  $widthClasses = [
      'fit-content' => 'w-fit',
      'fill' => 'w-full',
      'custom' => '',
  ];
  $widthClass = $widthClasses[$block->settings->width] ?? 'w-full';

  // Custom width for desktop
  $customWidthStyle = '';
  if ($block->settings->width === 'custom') {
      $customWidthStyle = 'width: ' . ($block->settings->custom_width ?? 100) . '%;';
  }

  // Width classes for mobile
  $widthMobileClasses = [
      'fit-content' => 'max-md:w-fit',
      'fill' => 'max-md:w-full',
      'custom' => '',
  ];
  $widthMobileClass = $widthMobileClasses[$block->settings->width_mobile] ?? 'max-md:w-full';

  // Custom width for mobile
  if ($block->settings->width_mobile === 'custom') {
      $customWidthStyle .= ' --custom-width-mobile: ' . ($block->settings->custom_width_mobile ?? 100) . '%;';
  }

  // Height classes
  $heightClass = $block->settings->height === 'fill' ? 'h-full object-cover' : 'h-auto object-contain';

  // Border styling
  $borderStyle = '';
  if ($block->settings->border === 'solid') {
      $borderWidth = $block->settings->border_width ?? 1;
      $borderOpacity = ($block->settings->border_opacity ?? 100) / 100;
      $borderStyle = "border: {$borderWidth}px solid rgba(0, 0, 0, {$borderOpacity});";
  }

  // Border radius
  $borderRadiusStyle = 'border-radius: ' . ($block->settings->border_radius ?? 0) . 'px;';

  // Padding
  $paddingStyle = sprintf(
      'padding-block-start: %spx; padding-block-end: %spx; padding-inline-start: %spx; padding-inline-end: %spx;',
      $block->settings->padding_block_start ?? 0,
      $block->settings->padding_block_end ?? 0,
      $block->settings->padding_inline_start ?? 0,
      $block->settings->padding_inline_end ?? 0,
  );

  // Combine styles
  $containerStyle = trim($customWidthStyle . ' ' . $borderStyle . ' ' . $borderRadiusStyle . ' ' . $paddingStyle);

  // Determine if we need a link wrapper
  $hasLink = !empty($block->settings->link);
  $tag = $hasLink ? 'a' : 'div';

  // Image source
  $imageSrc = $block->settings->image ?? 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="525" height="525"%3E%3Crect fill="%23f4f4f4" width="525" height="525"/%3E%3C/svg%3E';
@endphp

<{{ $tag }}
  {{ $block->editor_attributes }}
  @if ($hasLink)
    href="{{ $block->settings->link }}"
  @endif
  class="block {{ $widthClass }} {{ $widthMobileClass }}"
  @if ($containerStyle) style="{{ $containerStyle }}" @endif
>
  <img
    src="{{ $imageSrc }}"
    alt=""
    class="{{ $aspectRatioClass }} {{ $heightClass }} w-full"
    loading="lazy"
  >
</{{ $tag }}>
