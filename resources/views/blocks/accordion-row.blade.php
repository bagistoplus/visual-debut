@php
  $iconWidth = ($block->settings->width ?? 20) . 'px';
@endphp

<div
  {{ $block->editor_attributes }}
  x-accordion:item="'{{ $block->id }}'"
  class="accordion-row border-b last:border-none"
>
  <button x-accordion:item-trigger class="flex w-full cursor-pointer items-center justify-between py-2">
    <span class="flex items-center gap-2">
      @if ($block->settings->icon)
        <span style="width: {{ $iconWidth }};">
          @svg($block->settings->icon, ['class' => 'size-full'])
        </span>
      @endif
      <span class="font-medium" {{ $block->liveUpdate()->text('heading') }}>
        {{ $block->settings->heading }}
      </span>
    </span>

    <span x-accordion:item-indicator class="ml-4 flex-shrink-0 transition-transform duration-200 data-[state=open]:rotate-180">
      @if (($accordionIconType ?? 'caret') === 'caret')
        <x-lucide-chevron-down class="h-5 w-5" />
      @else
        <x-lucide-plus class="h-5 w-5" />
      @endif
    </span>
  </button>

  <div
    x-accordion:item-content
    x-collapse
    class="pb-4"
  >
    @children
  </div>
</div>
