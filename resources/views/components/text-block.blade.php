@props(['block', 'tag' => null, 'additionalAttributes' => ''])

@php
  use BagistoPlus\VisualDebut\Tailwind;
  // Width classes
  $widthClass = $block->settings->width === '100%' ? 'w-full' : 'w-fit';

  // Max width classes
  $maxWidthClasses = [
      'narrow' => 'max-w-prose',
      'normal' => 'max-w-2xl',
      'none' => 'max-w-none',
  ];
  $maxWidthClass = $maxWidthClasses[$block->settings->max_width] ?? 'max-w-2xl';

  // Alignment classes
  $alignmentClasses = [
      'left' => 'text-left',
      'center' => 'text-center mx-auto',
      'right' => 'text-right ml-auto',
  ];
  $alignmentClass = $alignmentClasses[$block->settings->alignment] ?? 'text-left';

  // Line height and letter spacing classes - only for custom mode
  // Presets already define these via CSS variables
  $lineHeightClass = '';
  $letterSpacingClass = '';

  if ($block->settings->type_preset === 'custom') {
      $lineHeightClasses = [
          'tight' => 'leading-tight',
          'normal' => 'leading-normal',
          'loose' => 'leading-loose',
      ];
      $lineHeightClass = $lineHeightClasses[$block->settings->line_height] ?? 'leading-normal';

      $letterSpacingClasses = [
          'tight' => 'tracking-tight',
          'normal' => 'tracking-normal',
          'loose' => 'tracking-wide',
      ];
      $letterSpacingClass = $letterSpacingClasses[$block->settings->letter_spacing] ?? 'tracking-normal';
  }

  // Case classes
  $caseClass = $block->settings->case === 'uppercase' ? 'uppercase' : '';

  // Wrap classes
  $wrapClasses = [
      'pretty' => 'text-pretty',
      'balance' => 'text-balance',
      'nowrap' => 'whitespace-nowrap',
  ];
  $wrapClass = $wrapClasses[$block->settings->wrap] ?? 'text-pretty';

  // Padding - using Tailwind responsive scale
  $ptClass = Tailwind::responsive($block->settings->padding_block_start ?? 0, fn($v) => $v > 0 ? "pt-{$v}" : '');
  $pbClass = Tailwind::responsive($block->settings->padding_block_end ?? 0, fn($v) => $v > 0 ? "pb-{$v}" : '');
  $psClass = Tailwind::responsive($block->settings->padding_inline_start ?? 0, fn($v) => $v > 0 ? "ps-{$v}" : '');
  $peClass = Tailwind::responsive($block->settings->padding_inline_end ?? 0, fn($v) => $v > 0 ? "pe-{$v}" : '');

  // Typography classes
  $presetClass = '';
  $fontClass = '';
  $colorClass = '';
  $fontSizeClass = '';
  $textColorStyle = '';

  // Color mapping
  $color = $block->settings->color ?? 'default';
  if ($color === 'custom') {
      $textColorStyle = 'color: ' . ($block->settings->text_color ?? '#000000FF') . ';';
  } else {
      $colorClasses = [
          'default' => 'text-on-background',
          'primary' => 'text-primary',
          'secondary' => 'text-secondary',
          'accent' => 'text-accent',
          'info' => 'text-info',
          'success' => 'text-success',
          'warning' => 'text-warning',
          'danger' => 'text-danger',
      ];
      $colorClass = $colorClasses[$color] ?? 'text-on-background';
  }

  if ($block->settings->type_preset === 'custom') {
      $fontClass = $block->settings->font ?? 'font-body';
      $fontSizeClass = $block->settings->font_size ?? '';
  } else {
      // Use preset class
      $presetClass = 'text-preset-' . $block->settings->type_preset;
  }

  // Inline styles
  $inlineStyle = $textColorStyle;

  // Determine tag based on preset if not provided
  if (!$tag) {
      $tag = match ($block->settings->type_preset) {
          'h1' => 'h1',
          'h2' => 'h2',
          'h3' => 'h3',
          'h4' => 'h4',
          'h5' => 'h5',
          'h6' => 'h6',
          'paragraph' => 'p',
          default => 'div',
      };
  }
@endphp

<{{ $tag }}
  {{ $block->editor_attributes }}
  {{ $block->settings->color_scheme?->attributes() }}
  class="{{ $widthClass }} {{ $maxWidthClass }} {{ $alignmentClass }} {{ $ptClass }} {{ $pbClass }} {{ $psClass }} {{ $peClass }} {{ $lineHeightClass }} {{ $letterSpacingClass }} {{ $caseClass }} {{ $wrapClass }} {{ $presetClass }} {{ $fontClass }} {{ $fontSizeClass }} {{ $colorClass }}"
  @if ($inlineStyle) style="{{ $inlineStyle }}" @endif
  {{ $attributes }}
  {!! $additionalAttributes !!}
>
  {{ $slot }}
  </{{ $tag }}>
