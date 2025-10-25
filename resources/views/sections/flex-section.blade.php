@php
  // Section height (using rem)
  $sectionHeight = match ($section->settings->section_height) {
      'auto' => 'min-h-fit',
      'xs' => 'min-h-[20rem]',
      'sm' => 'min-h-[25rem]',
      'md' => 'min-h-[37.5rem]',
      'lg' => 'min-h-[50rem]',
      'screen' => 'min-h-screen',
      'custom' => 'min-h-[' . ($section->settings->section_height_custom ?? 600) . 'px]',
      default => 'min-h-fit',
  };

  // Content wrapper width
  $contentWidth = $section->settings->section_width === 'container' ? 'container mx-auto px-4 sm:px-6 lg:px-8' : '';
@endphp

{{-- Outer container: position context + background + border --}}
<div
  {{ $section->editor_attributes }}
  class="relative overflow-hidden {{ $outerClass }}"
  style="{{ $outerStyle }}"
>
  {{-- Overlay layer --}}
  @if ($section->settings->toggle_overlay)
    <div
      class="absolute inset-0"
      style="{{ $overlayStyle }}"
    ></div>
  @endif

  {{-- Flex container: container + layout + height + padding --}}
  <div class="relative z-10 flex {{ $contentWidth }} {{ $sectionHeight }} {{ $flexClass }}" style="{{ $flexStyle }}">
    @children
  </div>
</div>
