@props(['maxPrice', 'noHeader' => false])

<div {{ $attributes->merge(['class' => 'space-y-6']) }}>
  @if (!$noHeader)
    <div class="flex items-center justify-between">
      <h5 class="text-on-background font-medium">
        @lang('shop::app.categories.filters.filters')
      </h5>
      <button wire:click="resetFilters" class="text-primary hover:text-primary/80 flex items-center text-sm">
        <x-lucide-rotate-ccw class="mr-1 h-4 w-4" />
        @lang('visual-debut::shop.reset')
      </button>
    </div>
  @endif

  <x-shop::ui.accordion :value="$this->availableFilters->pluck('id')" multiple>
    @foreach ($this->availableFilters as $filter)
      <x-shop::ui.accordion.item :id="$filter->id" :title="$filter->name">
        @if ($filter->type === 'price')
          <div wire:ignore class="py-3 pr-3">
            <x-shop::range-input
              :gap="16"
              :max="intval($maxPrice)"
              :value="$this->priceBounds($filter->code)"
              x-on:change.debounce="$wire.applyPriceRange('{{ $filter->code }}', $event.detail.join(','))"
            />
          </div>
        @else
          <div class="space-y-2 py-3">
            @php $applied = $this->appliedOptions($filter->code); @endphp
            @foreach ($filter->options as $option)
              <label class="flex items-center">
                <input
                  type="checkbox"
                  name="{{ $filter->code }}"
                  value="{{ $option->id }}"
                  @checked(in_array((string) $option->id, $applied, true))
                  wire:click="toggleFilter('{{ $filter->code }}', '{{ $option->id }}')"
                >
                <span class="ms-3">{{ $option->label ?? $option->admin_name }}</span>
              </label>
            @endforeach
          </div>
        @endif
      </x-shop::ui.accordion.item>
    @endforeach
  </x-shop::ui.accordion>
</div>
