@php
  $locales = once(fn() => core()->getCurrentChannel()->locales()->orderBy('name')->get());
  $currentLocale = core()->getCurrentLocale();
@endphp

@if ($locales->count() > 1)
  <div {{ $block->editor_attributes }} class="contents">
    <x-shop::ui.menu class="hidden sm:block">
      <x-shop::ui.menu.trigger class="hover:text-primary flex items-center p-2 transition-colors" aria-label="locale selector">
        @svg($block->settings->icon ?? 'lucide-globe', ['class' => 'h-5 w-5'])
        <span class="ms-1 uppercase">{{ $currentLocale->code }}</span>
      </x-shop::ui.menu.trigger>

      <x-shop::ui.menu.items>
        @foreach ($locales as $locale)
          <x-shop::ui.menu.item href="{{ request()->fullUrlWithQuery(['locale' => $locale->code]) }}">
            {{ $locale->name }}
          </x-shop::ui.menu.item>
        @endforeach
      </x-shop::ui.menu.items>
    </x-shop::ui.menu>
  </div>
@else
  <div {{ $block->editor_attributes }} class="contents"></div>
@endif