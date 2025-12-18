@php
  $sectionHeight = match ($section->settings->section_height) {
      'auto' => 'h-auto',
      'xs' => 'h-[20rem]',
      'sm' => 'h-[25rem]',
      'md' => 'h-[37.5rem]',
      'lg' => 'h-[50rem]',
      'screen' => 'h-screen',
      'custom' => 'h-[' . ($section->settings->section_height_custom ?? 600) . 'px]',
      default => 'h-auto',
  };

  $contentWidth = $section->settings->section_width === 'container' ? 'container mx-auto' : '';
@endphp

<div
  {{ $section->editor_attributes }}
  class="{{ $outerClass }} relative overflow-hidden"
  style="{{ $outerStyle }}"
>
  {{-- Overlay layer --}}
  @if ($section->settings->toggle_overlay)
    <div class="absolute inset-0" style="{{ $overlayStyle }}"></div>
  @endif

  {{-- Flex container: container + layout + height + padding --}}
  <div class="{{ $contentWidth }} {{ $sectionHeight }} {{ $flexClass }} relative z-10 flex" style="{{ $flexStyle }}">
    @children
  </div>
</div>
