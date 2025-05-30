@props(['availableSortOptions' => collect(), 'availablePaginationLimits' => collect(), 'displayMode' => 'grid', 'showSorting' => true])

<div {{ $attributes->merge(['class' => 'mb-6 hidden flex-wrap justify-between gap-4 md:flex']) }}>
  <div class="flex items-center gap-4">
    @if ($showSorting && $availableSortOptions->isNotEmpty())
      <select
        class="sorting w-auto"
        name="sort"
        aria-label="Sort by"
        wire:model.live="sort"
      >
        @foreach ($availableSortOptions as $option)
          <option value="{{ $option['value'] }}">
            {{ $option['title'] }}
          </option>
        @endforeach
      </select>
    @endif

    @if ($availablePaginationLimits->isNotEmpty())
      <select
        class="w-auto"
        name="limit"
        aria-label="Items per page"
        wire:model.live="limit"
      >
        @foreach ($availablePaginationLimits as $limit)
          <option value="{{ $limit }}">
            {{ $limit }}
          </option>
        @endforeach
      </select>
    @endif
  </div>

  <div class="flex gap-2">
    @foreach (['grid' => 'lucide-layout-grid', 'list' => 'lucide-layout-list'] as $mode => $icon)
      <button
        aria-label="Show as {{ $mode }}"
        wire:click="$set('displayMode', '{{ $mode }}')"
        @class([
            'focus:ring-primary inline-flex h-10 w-10 items-center justify-center rounded-lg focus:ring-2 focus:ring-offset-2',
            'bg-primary text-primary-100' => $displayMode === $mode,
            'bg-surface-alt-600 text-on-background' => $displayMode !== $mode,
        ])
      >
        @svg($icon, ['class' => 'h-5 w-5'])
      </button>
    @endforeach
  </div>
</div>
