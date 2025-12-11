<div
  {{ $block->editor_attributes }}
  {{ $block->settings->color_scheme?->attributes() }}
  class="{{ $class }}"
  @if ($style) style="{{ $style }}" @endif
>
  @children
</div>
