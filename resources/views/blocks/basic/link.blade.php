@php
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
  {{ $block->settings->typography?->attributes() }}
  href="{{ $block->settings->url }}"
  @if($target) target="{{ $target }}" @endif
  @if($rel) rel="{{ $rel }}" @endif
  class="inline-block {{ $underlineClass }} {{ $paddingClasses }}"
  {{ $block->liveUpdate()->text('text') }}
>
  {{ $block->settings->text }}
</a>
