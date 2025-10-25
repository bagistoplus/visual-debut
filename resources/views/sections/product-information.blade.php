@php
  $sectionWidth = $section->settings->section_width ?? 'container';
  $mediaPosition = $section->settings->media_position ?? 'left';
  $equalColumns = $section->settings->equal_columns ?? false;
  $gap = $section->settings->gap ?? 12;
  $paddingTop = $section->settings->padding_top ?? 8;
  $paddingBottom = $section->settings->padding_bottom ?? 8;

  $containerClass = $sectionWidth === 'container' ? 'container mx-auto px-4 sm:px-6 lg:px-8' : 'px-4 sm:px-6 lg:px-8';

  // Grid column classes
  $gridCols = $equalColumns ? 'md:grid-cols-2' : 'md:grid-cols-3';

  // Order classes for media position
  $mediaOrder = $mediaPosition === 'right' ? 'md:order-2' : 'md:order-1';
  $detailsOrder = $mediaPosition === 'right' ? 'md:order-1' : 'md:order-2';

  // Media span - if not equal columns, media takes 2 cols
  $mediaSpan = $equalColumns ? '' : 'md:col-span-2';
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="{{ $containerClass }} pt-{{ $paddingTop }} pb-{{ $paddingBottom }}"
>
  <form x-on:submit.prevent>
    <div class="grid grid-cols-1 {{ $gridCols }} gap-{{ $gap }}">
      <div class="{{ $mediaSpan }} {{ $mediaOrder }}">
        @visualBlock('@visual-debut/product-media-gallery', 'static-product-media')
      </div>
      <div class="{{ $detailsOrder }}">
        @visualBlock('@visual-debut/product-details', 'static-product-details')
      </div>
    </div>
  </form>
</div>
