@php
  // Content width classes
  $contentWidthClass = $section->settings->content_width === 'container' ? 'container' : 'px-4 sm:px-6 lg:px-8';
@endphp

<div {{ $section->editor_attributes }} class="bg-surface-alt text-on-surface-alt/80">
  <div class="{{ $contentWidthClass }} {{ $paddingClasses }}">
    @children
  </div>
</div>
