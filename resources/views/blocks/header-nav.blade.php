@php
  $categories = $section->getCategories();
  $navClasses = $block->settings->push_to_left ? ' mr-auto' : '';
  $navClasses .= $block->settings->push_to_right ? ' ml-auto' : '';
@endphp

<div {{ $block->editor_attributes }} class="{{ $navClasses }} hidden h-full sm:block" {{ $block->liveUpdate()->toggleClass('push_to_left', 'mr-auto')->toggleClass('push_to_right', 'ml-auto') }}>
  <x-shop::navigation :categories="$categories" />
</div>
