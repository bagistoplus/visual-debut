<div
  {{ $block->editor_attributes }}
  {{ $block->settings->color_scheme?->attributes() }}
  class="{{ $alignmentClass }} {{ $paddingClasses }} flex items-center"
>
  <hr style="
      width: {{ $widthPercent }}%;
      min-height: {{ $thickness }}px;
    ">
</div>
