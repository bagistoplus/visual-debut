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

  $style = $borderStyle . $borderRadius;
@endphp

<div
  {{ $block->editor_attributes }}
  x-accordion="{ value: @js($openByDefault), multiple: true }"
  class="accordion {{ $dividersClass }} {{ $colorClass }} w-full {{ $paddingClasses }}"
  style="{{ $style }}"
>
  @children
</div>
