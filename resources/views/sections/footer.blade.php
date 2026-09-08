@php
  // Content width classes
  $contentWidthClass = $section->settings->content_width === 'container' ? 'container' : 'container-fluid';
@endphp

<div {{ $section->editor_attributes }} class="bg-surface-alt text-on-surface-alt">
  <div class="{{ $contentWidthClass }}">
    <div class="{{ $paddingClasses }}">
      @children
    </div>
  </div>
</div>
