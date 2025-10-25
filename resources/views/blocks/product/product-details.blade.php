@php
  $gap = $block->settings->gap ?? 6;
  $sticky = $block->settings->sticky ?? false;
  $paddingTop = $block->settings->padding_top ?? 0;
  $paddingBottom = $block->settings->padding_bottom ?? 0;
  $paddingLeft = $block->settings->padding_left ?? 0;
  $paddingRight = $block->settings->padding_right ?? 0;

  $positionClass = $sticky ? 'sticky top-4 self-start' : '';
@endphp

<div
  {{ $block->editor_attributes }}
  class="flex flex-col gap-{{ $gap }} pt-{{ $paddingTop }} pb-{{ $paddingBottom }} ps-{{ $paddingLeft }} pe-{{ $paddingRight }} {{ $positionClass }}"
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
