@php
  use BagistoPlus\VisualDebut\Tailwind;

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

  // Padding - using Tailwind responsive scale
  $ptClass = Tailwind::responsive($block->settings->padding_block_start ?? 0, fn($v) => $v > 0 ? "pt-{$v}" : '');
  $pbClass = Tailwind::responsive($block->settings->padding_block_end ?? 0, fn($v) => $v > 0 ? "pb-{$v}" : '');

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
  class="inline-block {{ $presetClass }} {{ $fontClass }} {{ $fontSizeClass }} {{ $underlineClass }} {{ $ptClass }} {{ $pbClass }}"
  {{ $block->liveUpdate()->text('text') }}
>
  {{ $block->settings->text }}
</a>
