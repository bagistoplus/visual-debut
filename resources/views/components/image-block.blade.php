@props(['block', 'image' => null, 'alt' => ''])

@php
  use BagistoPlus\VisualDebut\Tailwind;

  $image = $image ?? $block->settings->image;
  $alt = $alt ?? ($block->settings->alt ?? '');

  // Aspect ratio
  $aspectRatioClass = match ($block->settings->aspect_ratio ?? 'adapt') {
      'square' => 'aspect-square',
      'portrait' => 'aspect-[3/4]',
      'landscape' => 'aspect-[4/3]',
      default => '', // adapt
  };

  // Object fit
  $objectFitClass = match ($block->settings->object_fit ?? 'cover') {
      'contain' => 'object-contain',
      'fill' => 'object-fill',
      default => 'object-cover',
  };

  // Hover zoom
  $hoverZoom = ($block->settings->hover_zoom ?? false) === true;
  $hoverZoomScale = $block->settings->hover_zoom_scale ?? '105';

  // Width (responsive) - convert width setting to Tailwind classes
  $widthClass = Tailwind::responsive(
      $block->settings->width ?? 'fill',
      fn($v) => match ($v) {
          'fit-content' => 'w-fit',
          'fill' => 'w-full',
          'custom' => '', // handled separately
          default => 'w-full',
      },
  );

  // Custom width (responsive) - inline styles
  $customWidthStyle = '';
  $customWidth = $block->settings->custom_width ?? null;
  if ($customWidth) {
      if (is_array($customWidth)) {
          $styles = [];
          foreach ($customWidth as $breakpoint => $value) {
              if ($value !== null && $value > 0) {
                  $styles[] = "width: {$value}%";
              }
          }
          $customWidthStyle = !empty($styles) ? implode('; ', $styles) : '';
      } elseif ($customWidth > 0) {
          $customWidthStyle = "width: {$customWidth}%";
      }
  }

  // Height
  $heightClass = match ($block->settings->height ?? 'fit') {
      'fill' => 'h-full',
      default => '',
  };

  // Border
  $borderClasses = [];
  $borderStyles = [];
  if ($block->settings->border ?? false) {
      $borderWidth = $block->settings->border_width ?? 1;
      $borderClasses[] = $borderWidth === 1 ? 'border' : "border-{$borderWidth}";
      $borderClasses[] = 'border-current';

      $borderOpacity = $block->settings->border_opacity ?? 100;
      if ($borderOpacity < 100) {
          $opacity = $borderOpacity / 100;
          $borderStyles[] = "border-color: rgba(currentColor, {$opacity})";
      }
  }

  // Border radius
  $borderRadius = $block->settings->border_radius ?? 'none';
  if ($borderRadius !== 'none') {
      $borderClasses[] = match ($borderRadius) {
          'sm' => 'rounded-sm',
          'md' => 'rounded-md',
          'lg' => 'rounded-lg',
          'xl' => 'rounded-xl',
          '2xl' => 'rounded-2xl',
          '3xl' => 'rounded-3xl',
          'full' => 'rounded-full',
          default => '',
      };
  }

  // Padding (responsive, using Tailwind scale)
  $ptClass = Tailwind::responsive($block->settings->padding_block_start ?? 0, fn($v) => $v > 0 ? "pt-{$v}" : '');
  $pbClass = Tailwind::responsive($block->settings->padding_block_end ?? 0, fn($v) => $v > 0 ? "pb-{$v}" : '');
  $psClass = Tailwind::responsive($block->settings->padding_inline_start ?? 0, fn($v) => $v > 0 ? "ps-{$v}" : '');
  $peClass = Tailwind::responsive($block->settings->padding_inline_end ?? 0, fn($v) => $v > 0 ? "pe-{$v}" : '');

  // Combine inline styles
  $inlineStyles = array_filter(array_merge($borderStyles, $customWidthStyle ? [$customWidthStyle] : []));
  $styleAttr = !empty($inlineStyles) ? ' style="' . implode('; ', $inlineStyles) . '"' : '';
@endphp

@if ($image)
  <div
    {{ $block->editor_attributes }}
    class="{{ $widthClass }} {{ $heightClass }} {{ $aspectRatioClass }} {{ implode(' ', $borderClasses) }} {{ $ptClass }} {{ $pbClass }} {{ $psClass }} {{ $peClass }} relative overflow-hidden"
    {!! $styleAttr !!}
    {{ $attributes }}
  >
    <img
      src="{{ $image }}"
      alt="{{ $alt }}"
      class="{{ $objectFitClass }} {{ $hoverZoom ? 'transition-transform duration-300 hover:scale-' . $hoverZoomScale . ' group-hover:scale-' . $hoverZoomScale : '' }} h-full w-full object-center"
    />
  </div>
@else
  <div
    {{ $block->editor_attributes }}
    class="{{ $widthClass }} {{ $heightClass }} {{ $aspectRatioClass }} {{ implode(' ', $borderClasses) }} {{ $ptClass }} {{ $pbClass }} {{ $psClass }} {{ $peClass }} relative flex min-h-56 items-center justify-center overflow-hidden bg-gray-200"
    {!! $styleAttr !!}
    {{ $attributes }}
  >
    <svg
      class="h-16 w-16 text-gray-400"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
      />
    </svg>
  </div>
@endif
