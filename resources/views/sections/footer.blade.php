@php
  // Content width classes
  $contentWidthClass = $section->settings->content_width === 'container' ? 'container' : 'container-fluid';
@endphp

<div {{ $section->editor_attributes }} {{ $section->settings->color_scheme?->attributes() }}>
  <div class="{{ $contentWidthClass }}">
    <div class="{{ $paddingClasses }}">
      @children
    </div>
  </div>
</div>
