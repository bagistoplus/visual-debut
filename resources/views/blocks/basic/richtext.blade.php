<div
  {{ $block->editor_attributes }}
  {{ $block->settings->color_scheme?->attributes() }}
  class="prose {{ $widthClass }} {{ $maxWidthClass }} {{ $alignmentClass }} {{ $paddingClass }}"
  {{ $block->liveUpdate()->html('content') }}
>
  {!! $content !!}
</div>
