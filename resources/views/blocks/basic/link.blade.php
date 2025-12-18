@php
  // Type preset classes
  $presetClass = '';
  $fontClass = '';
  $fontSizeClass = '';

  if ($block->settings->type_preset === 'custom') {
      $fontClass = $block->settings->font_weight ?? 'font-normal';
      $fontSizeClass = $block->settings->font_size ?? 'text-base';
  } else {
      // Use preset class (paragraph, h1-h6)
      $presetClass = 'text-preset-' . $block->settings->type_preset;
  }

  // Underline classes
  $underlineClasses = [
    'none' => '',
    'hover' => 'hover:underline',
    'always' => 'underline',
  ];
  $underlineClass = $underlineClasses[$block->settings->underline ?? 'hover'] ?? 'hover:underline';

  // Target attribute
  $target = $block->settings->open_in_new_tab ? '_blank' : null;
  $rel = $block->settings->open_in_new_tab ? 'noopener noreferrer' : null;
@endphp

<a
  {{ $block->editor_attributes }}
  {{ $block->settings->color_scheme?->attributes() }}
  href="{{ $block->settings->url }}"
  @if($target) target="{{ $target }}" @endif
  @if($rel) rel="{{ $rel }}" @endif
  class="inline-block {{ $presetClass }} {{ $fontClass }} {{ $fontSizeClass }} {{ $underlineClass }} {{ $paddingClasses }}"
  {{ $block->liveUpdate()->text('text') }}
>
  {{ $block->settings->text }}
</a>
