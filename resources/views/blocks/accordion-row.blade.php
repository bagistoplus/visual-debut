@php
  $iconWidth = ($block->settings->width ?? 20) . 'px';
@endphp

<div {{ $block->editor_attributes }} class="accordion-row border-b last:border-none">
  <x-shop::ui.accordion.item :value="$block->id" :open="$block->settings->open_by_default">
    <x-shop::ui.accordion.item-trigger class="cursor-pointer justify-between gap-4">
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

      <x-slot:indicator>
        @if (($accordionIconType ?? 'caret') === 'caret')
          <x-lucide-chevron-down class="h-5 w-5" />
        @else
          <x-lucide-plus class="h-5 w-5" />
        @endif
      </x-slot:indicator>
    </x-shop::ui.accordion.item-trigger>

    <x-shop::ui.accordion.item-content class="pb-4">
      @children
    </x-shop::ui.accordion.item-content>
  </x-shop::ui.accordion.item>
</div>
