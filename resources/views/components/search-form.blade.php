@props([
    'searchIcon' => 'lucide-search',
    'imageSearchIcon' => 'lucide-camera',
])

<div id="search-form">
  <div x-data="{ showSearch: false }">
    <button
      class="p-2 cursor-pointer" 
      aria-label="Search"
      x-on:click="showSearch = !showSearch"
    >
      @svg($searchIcon, ['class' => 'hover:text-primary h-5 w-5 transition-colors'])
    </button>

    <div
      x-cloak
      x-show="showSearch"
      class="bg-surface border-on-surface/8 shadow-xs absolute left-0 right-0 top-16 border-b"
      x-on:click.outside="showSearch = false"
    >
      <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">

        <form method="get" action="{{ route('shop.search.index') }}" class="relative mx-auto max-w-3xl">
          @foreach (collect(request()->query())->except('query') as $key => $value)
            <input type="hidden" name="{{ $key }}" value=@json($value)>
          @endforeach

          @svg($searchIcon, ['class' => 'hover:text-primary absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 transition-colors'])

            <livewire:search-suggestions searchIcon="lucide-search" />

        </form>

        @if (core()->getConfigData('catalog.products.settings.image_search'))
          <x-shop::image-search-button :icon="$imageSearchIcon"
                                       class="absolute right-4 top-1/2 flex -translate-y-1/2 transform items-center"/>
          @endif
          </form>
      </div>
    </div>
  </div>
</div>
