@php
  $gap = $block->settings->gap ?? 6;
  $sticky = $block->settings->sticky ?? false;

  $positionClass = $sticky ? 'sticky top-4 self-start' : '';
@endphp

<div
  {{ $block->editor_attributes }}
  class="flex flex-col gap-{{ $gap }} {{ $paddingClasses }} {{ $positionClass }}"
>
  @children

  @if (empty($block->childrenIds))
    @visual_design_mode
    <div class="visual-placeholder">
      <p>Add product information blocks</p>
    </div>
    @end_visual_design_mode
  @endif
</div>
