@props(['maxPrice', 'noHeader' => false, 'accordionId' => 'product-filters'])

<div {{ $attributes->merge(['class' => 'space-y-6']) }}>
  @if (!$noHeader)
    <div class="flex items-center justify-between">
      <h2 class="text-on-background font-medium">
        @lang('shop::app.categories.filters.filters')
      </h2>
      <button wire:click="resetFilters" class="text-primary hover:text-primary/80 flex items-center text-sm">
        <x-lucide-rotate-ccw class="mr-1 h-4 w-4" />
        @lang('visual-debut::shop.reset')
      </button>
    </div>
  @endif

  <x-shop::ui.accordion
    :id="$accordionId"
    :value="$this->availableFilters->pluck('id')"
    multiple
  >
    @foreach ($this->availableFilters as $filter)
      <x-shop::ui.accordion.item :value="$filter->id" :title="$filter->name" open>
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
          @php
            $applied = $this->appliedOptions($filter->code);
            $labels = $filter->options->map(fn($option) => $option->label ?? $option->admin_name);
          @endphp
          <div class="space-y-3 py-3" x-data="{
              code: @js($filter->code),
              labels: @js($labels->values()),
              query: '',
              ids() {
                  const value = $wire.filters[this.code] ?? '';
                  return value === '' ? [] : value.split(',');
              },
              toggle(id) {
                  const ids = this.ids();
                  const next = ids.includes(id) ? ids.filter((other) => other !== id) : [...ids, id];
                  $wire.$set('filters.' + this.code, next.join(','), false);
                  this.commit();
              },
              commit: Alpine.debounce(() => $wire.$commit(), 250),
              matches(label) {
                  return label.toLowerCase().includes(this.query.trim().toLowerCase());
              },
          }">
            @if ($labels->count() > 8)
              <input
                type="search"
                x-model="query"
                class="input-sm w-full"
                placeholder="@lang('visual-debut::shop.search') {{ $filter->name }}"
                aria-label="@lang('visual-debut::shop.search') {{ $filter->name }}"
              >
            @endif
            <div class="-m-1 max-h-64 space-y-2 overflow-y-auto p-1 pe-2">
              @foreach ($filter->options as $option)
                <label class="flex items-center" x-show="matches(@js($labels[$loop->index]))">
                  <input
                    type="checkbox"
                    name="{{ $filter->code }}"
                    value="{{ $option->id }}"
                    @checked(in_array((string) $option->id, $applied, true))
                    x-bind:checked="ids().includes('{{ $option->id }}')"
                    x-on:change="toggle('{{ $option->id }}')"
                  >
                  <span class="ms-3">{{ $labels[$loop->index] }}</span>
                </label>
              @endforeach
              <p
                class="text-sm opacity-70"
                x-show="!labels.some((label) => matches(label))"
                x-cloak
              >
                @lang('visual-debut::shop.no-matching-options')
              </p>
            </div>
          </div>
        @endif
      </x-shop::ui.accordion.item>
    @endforeach
  </x-shop::ui.accordion>
</div>
