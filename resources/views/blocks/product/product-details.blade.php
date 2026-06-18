@php
  $gap = $block->settings->gap ?? 6;
  $sticky = $block->settings->sticky ?? false;

  $positionClass = $sticky ? 'sticky top-4 self-start' : '';
@endphp

<div {{ $block->editor_attributes }} class="gap-{{ $gap }} {{ $paddingClasses }} {{ $positionClass }} flex flex-col">
  @children

  @if (empty($block->childrenIds))
    @visual_design_mode
    <div class="visual-placeholder">
      <p>@lang('visual-debut::blocks.product-details.placeholder.empty')</p>
    </div>
    @end_visual_design_mode
  @endif
</div>
