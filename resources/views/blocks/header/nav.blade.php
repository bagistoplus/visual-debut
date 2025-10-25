@php
  $itemClass = 'group inline-flex h-10 w-max items-center justify-center box border-none px-4 py-2 text-sm font-medium transition-colors hover:bg-surface-alt  focus:outline-none';
@endphp

<div
  id="navigation"
  {{ $block->editor_attributes }}
  x-data
  x-navigation
  class="hidden h-full items-center sm:flex"
>
  <div class="relative">
    <ul class="text-on-background group flex flex-1 list-none items-center justify-center space-x-2 rounded-md p-1.5">
      @foreach ($categories as $category)
        <li>
          @if ($category->children->isEmpty())
            <a href="{{ $category->url }}" class="{{ $itemClass }}">
              {{ $category->name }}
            </a>
          @else
            <a
              href="{{ $category->url }}"
              class="{{ $itemClass }}"
              x-navigation:item="{{ $category->id }}"
            >
              {{ $category->name }}
            </a>
          @endif
        </li>
      @endforeach
    </ul>
  </div>

  <div
    x-navigation:dropdown
    x-transition:enter="transition ease-out duration-100"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="absolute top-full pt-1 duration-200 ease-out"
    x-cloak
  >
    <div class="bg-surface border-on-surface/8 box z-20 flex h-auto w-auto justify-center overflow-hidden shadow">
      @foreach ($categories as $category)
        @if ($category->children->isNotEmpty())
          @php $hasImage = $category->logo_url || $category->banner_url; @endphp
          <div x-navigation:section="{{ $category->id }}" class="{{ $hasImage ? 'max-w-3xl' : 'max-w-xl' }} flex w-full items-stretch justify-center gap-x-3 p-4">
            @if ($hasImage)
              <div class="text-surface-200 box relative flex h-full min-h-64 w-40 flex-shrink-0 items-end overflow-hidden border-none p-4">
                <img src="{{ $category->logo_url ?? $category->banner_url }}" class="absolute inset-0 h-full object-cover brightness-50">
                <div class="relative space-y-1.5">
                  <span class="block text-lg font-bold">{{ $category->name }}</span>
                  <span class="text-surface-200/80 block text-sm">{!! $category->description !!}</span>
                </div>
              </div>
            @endif

            <div class="flex-1">
              <div class="flex flex-wrap gap-4">
                @foreach ($category->children as $subCategory)
                  <div class="w-64 flex-none">
                    <a
                      x-navigation:sub-item
                      href="{{ $subCategory->url }}"
                      class="hover:bg-surface-alt box block border-none px-3.5 py-3 text-sm"
                    >
                      <span class="text-on-background mb-1 block font-semibold">
                        {{ $subCategory->name }}
                      </span>
                      @if ($subCategory->description)
                        <span class="text-on-background/70 block truncate leading-5">
                          {!! $subCategory->description !!}
                        </span>
                      @endif
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>
