@php
  use BagistoPlus\VisualDebut\Tailwind;

  // Content width classes
  $contentWidthClass = $section->settings->content_width === 'container' ? 'container' : 'px-4 sm:px-6 lg:px-8';

  // Padding classes
  $paddingTop = $section->settings->padding_top ?? ['_default' => 12];
  $paddingBottom = $section->settings->padding_bottom ?? ['_default' => 12];

  $paddingClasses = implode(' ', [Tailwind::responsive($paddingTop, fn($v) => "pt-{$v}"), Tailwind::responsive($paddingBottom, fn($v) => "pb-{$v}")]);
@endphp

<div {{ $section->editor_attributes }} class="bg-surface-alt text-on-surface-alt/80">
  <div class="{{ $contentWidthClass }} {{ $paddingClasses }}">
    @children
  </div>
</div>
