@props(['mobile', 'icon' => 'lucide-globe'])

@php
  $locales = once(fn() => core()->getCurrentChannel()->locales()->orderBy('name')->get());
  $currentLocale = core()->getCurrentLocale();
@endphp

@if ($locales->count() > 1)
  <div class="contents">
    @isset($mobile)
      <label for="mobile-locale" class="mb-2 block text-sm font-medium">Language</label>
      <select
        id="mobile-locale"
        x-data
        @change="
          const url = new URL(window.location.href);
          url.searchParams.set('locale', $event.target.value);
          window.location.href = url.toString();
      "
      >
        @foreach ($locales as $locale)
          <option value="{{ $locale->code }}" @if ($locale->code === $currentLocale->code) selected @endif>
            {{ $locale->name }}
          </option>
        @endforeach
      </select>
    @else
      <x-shop::ui.menu class="hidden sm:block">
        <x-shop::ui.menu.trigger class="hover:text-primary flex items-center p-2 transition-colors" aria-label="locale selector">
          @svg($icon, ['class' => 'h-5 w-5'])
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
    @endisset
  </div>
@endif
