@php
  $openByDefault = collect($block->children())->filter(fn($child) => $child->settings->open_by_default ?? false)->pluck('id')->toArray();

  $dividersClass = $block->settings->dividers ? 'accordion-dividers' : '';
  $colorClass = !$block->settings->inherit_color_scheme ? 'color-' . ($block->settings->color_scheme ?? 'default') : '';

  // Border styles
  $borderStyle = '';
  if ($block->settings->border && $block->settings->border !== 'none') {
      $borderOpacity = ($block->settings->border_opacity ?? 100) / 100;
      $borderStyle .= sprintf('--border-width: %spx; --border-style: %s; --border-opacity: %s;', $block->settings->border_width ?? 1, $block->settings->border, $borderOpacity);
  }

  $borderRadius = 'border-radius: ' . ($block->settings->border_radius ?? 0) . 'px;';

  // Padding
  $paddingStyle = sprintf(
      'padding-block-start: %spx; padding-block-end: %spx; padding-inline-start: %spx; padding-inline-end: %spx;',
      $block->settings->padding_block_start ?? 0,
      $block->settings->padding_block_end ?? 0,
      $block->settings->padding_inline_start ?? 0,
      $block->settings->padding_inline_end ?? 0,
  );

  // Typography preset
  $typePreset = $block->settings->type_preset ?: 'h5';
  $typographyStyle = sprintf('--summary-font-size: var(--font-%s--size, 1rem); --summary-line-height: var(--font-%s--line-height, 1.5);', $typePreset, $typePreset);

  $style = $borderStyle . $borderRadius . $paddingStyle . $typographyStyle;
@endphp

<div
  {{ $block->editor_attributes }}
  x-accordion="{ value: @js($openByDefault), multiple: true }"
  class="accordion {{ $dividersClass }} {{ $colorClass }} w-full"
  style="{{ $style }}"
>
  @children
</div>
