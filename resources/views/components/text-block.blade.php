@props(['block', 'tag' => null, 'additionalAttributes' => ''])

@php
  use BagistoPlus\VisualDebut\Tailwind;
  // Width
  $widthClass = Tailwind::responsive(
      $block->settings->width ?? 'fit',
      fn($v) => match ($v) {
          'fill' => 'w-full',
          'fit' => 'w-fit',
          default => 'w-fit',
      },
  );

  // Max width classes
  $maxWidthClasses = [
      'narrow' => 'max-w-prose',
      'normal' => 'max-w-2xl',
      'none' => 'max-w-none',
  ];
  $maxWidthClass = $maxWidthClasses[$block->settings->max_width] ?? 'max-w-2xl';

  // Alignment
  $alignmentClass = Tailwind::responsive(
      $block->settings->alignment ?? 'left',
      fn($v) => match ($v) {
          'left' => 'text-left',
          'center' => 'text-center',
          'right' => 'text-right',
          default => 'text-left',
      },
  );

  // Color mapping
  $colorClass = '';
  $textColorStyle = '';
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

  // Inline styles
  $inlineStyle = $textColorStyle;

  // Determine tag based on preset if not provided
  if (!$tag) {
      $tag = match ($block->settings->typography?->id) {
          'heading-1' => 'h1',
          'heading-2' => 'h2',
          'heading-3' => 'h3',
          'heading-4' => 'h4',
          'heading-5' => 'h5',
          'heading-6' => 'h6',
          'body' => 'p',
          default => 'div',
      };
  }

  $paddingClasses = '';
  if ($block->settings->has('padding')) {
      $paddingClasses = Tailwind::responsive($block->settings->padding, fn($v) => Tailwind::buildSpacingClasses($v, 'p'));
  }
@endphp

<{{ $tag }}
  {{ $block->editor_attributes }}
  {{ $block->settings->color_scheme?->attributes() }}
  {{ $block->settings->typography?->attributes() }}
  class="{{ $widthClass }} {{ $maxWidthClass }} {{ $alignmentClass }} {{ $paddingClasses }} {{ $colorClass }}"
  @if ($inlineStyle) style="{{ $inlineStyle }}" @endif
  {{ $attributes }}
  {!! $additionalAttributes !!}
>
  {{ $slot }}
  </{{ $tag }}>
