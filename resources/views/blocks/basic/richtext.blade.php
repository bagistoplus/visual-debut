<div
  {{ $block->editor_attributes }}
  {{ $block->settings->color_scheme?->attributes() }}
  class="prose {{ $widthClass }} {{ $maxWidthClass }} {{ $alignmentClass }}"
  style="padding-top: {{ $paddingTop }}px; padding-bottom: {{ $paddingBottom }}px; padding-left: {{ $paddingLeft }}px; padding-right: {{ $paddingRight }}px;"
  {{ $block->liveUpdate()->html('content') }}
>
  {!! $content !!}
</div>
