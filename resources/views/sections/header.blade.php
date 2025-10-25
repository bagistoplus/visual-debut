@php
  $categories = $getCategories();
  $contentWidth = $section->settings->content_width ?? 'container';
  $containerClass = $contentWidth === 'container' ? 'mx-auto container' : 'px-4 sm:px-6 lg:px-8';
@endphp

<div {{ $section->editor_attributes }} class="bg-surface text-on-surface border-on-surface/8 sticky top-0 z-20 w-full border-b">
  <div class="{{ $containerClass }}">
    <div class="flex h-16 items-center justify-between gap-x-4">
      <x-shop::ui.drawer placement="start" title="Menu">
        <x-slot:trigger>
          <button class="-ml-2 p-2 transition-colors sm:hidden" aria-label="Open menu">
            <x-lucide-menu class="h-6 w-6" />
          </button>
        </x-slot:trigger>
        <div>
          <!-- Mobile Menu -->
          <x-shop::mobile-menu :categories="$categories" />
        </div>
      </x-shop::ui.drawer>

      @children
    </div>
  </div>
</div>
