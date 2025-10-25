@php
  // Direction classes
  $directionClasses = [
      'row' => 'flex-row',
      'column' => 'flex-col',
  ];
  $directionClass = $directionClasses[$block->settings->content_direction] ?? 'flex-col';

  // Alignment classes
  $alignmentClasses = [
      'start' => 'items-start',
      'center' => 'items-center',
      'end' => 'items-end',
  ];
  $alignmentClass = $alignmentClasses[$block->settings->alignment] ?? 'items-start';

  // Width classes
  $widthClass = $block->settings->width === 'full' ? 'w-full' : 'w-auto';

  // Height classes
  $heightClass = $block->settings->height === 'full' ? 'h-full' : 'h-auto';

  // Gap style
  $gapStyle = 'gap: ' . ($block->settings->gap ?? 16) . 'px;';

  // Padding
  $paddingStyle = sprintf(
      'padding-block-start: %spx; padding-block-end: %spx; padding-inline-start: %spx; padding-inline-end: %spx;',
      $block->settings->padding_block_start ?? 0,
      $block->settings->padding_block_end ?? 0,
      $block->settings->padding_inline_start ?? 0,
      $block->settings->padding_inline_end ?? 0,
  );

  // Combine styles
  $inlineStyle = trim($gapStyle . ' ' . $paddingStyle);
@endphp

<div
  {{ $block->editor_attributes }}
  class="flex {{ $directionClass }} {{ $alignmentClass }} {{ $widthClass }} {{ $heightClass }}"
  @if ($inlineStyle) style="{{ $inlineStyle }}" @endif
>
  @children
</div>
