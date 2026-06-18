@props(['maxPrice', 'sortOptions', 'paginationLimits'])

<x-shop::ui.drawer :title="trans('visual-debut::shop.sort-and-filter')" class="md:hidden">
  <x-slot:trigger>
    <x-shop::ui.button
      class="w-full"
      variant="outline"
      color="neutral"
    >
      <span class="flex items-center">
        <x-lucide-filter class="mr-2 h-5 w-5" />
        @lang('visual-debut::shop.filters')
        <x-lucide-chevron-down class="ml-2 h-5 w-5" />
      </span>
    </x-shop::ui.button>

  </x-slot:trigger>
  <x-slot:footer>
    <div class="flex h-full w-full items-center border-t p-4">
      <x-shop::ui.modal.close>
        <x-shop::ui.button
          wire:click="resetFilters"
          icon="lucide-rotate-cw"
          class="w-full"
        >
          @lang('visual-debut::shop.reset-filters')
        </x-shop::ui.button>
      </x-shop::ui.modal.close>
    </div>
  </x-slot:footer>

  <div class="flex-1 space-y-6 border-t p-4">
    <x-shop::product.filters no-header :maxPrice="$maxPrice" />

    @if ($sortOptions->isNotEmpty())
      <label class="block">
        <span class="text-on-background">@lang('visual-debut::shop.sort-by')</span>
        <select
          class="mt-1 w-full"
          name="sort"
          wire:model.live="sort"
        >
          @foreach ($sortOptions as $option)
            <option value="{{ $option['value'] }}">
              {{ $option['title'] }}
            </option>
          @endforeach
        </select>
      </label>
    @endif

    @if ($paginationLimits->isNotEmpty())
      <label class="block">
        <span class="text-on-background">@lang('visual-debut::shop.items-per-page')</span>
        <select
          class="mt-1 w-full"
          name="sort"
          wire:model.live="limit"
        >
          @foreach ($paginationLimits as $limit)
            <option value="{{ $limit }}">
              {{ $limit }}
            </option>
          @endforeach
        </select>
      </label>
    @endif
  </div>
</x-shop::ui.drawer>
