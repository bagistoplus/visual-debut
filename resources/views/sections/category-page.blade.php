<div {{ $section->editor_attributes }}>
  @if ($section->settings->show_category_banner)
    <div class="banner bg-surface-alt text-on-surface-alt relative py-8">
      @if ($category->banner_url)
        <img
          src="{{ $category->banner_url }}"
          alt="{{ $category->name }}"
          class="brightness-60 absolute inset-0 h-full w-full object-cover object-center"
        >
      @endif
      <div class="{{ $category->banner_url ? 'text-white/80' : '' }} relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold">
          {{ $category->name }}
        </h1>
        <div class="mt-2">
          {!! visual_clear_inline_styles($category->description) !!}
        </div>
      </div>
    </div>
  @endif

  @if ($section->settings->heading)
    <h2 class="my-6 text-center text-2xl font-bold" wire:ignore>
      {{ $section->settings->heading }}
    </h2>
  @endif

  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-8 md:flex-row">
      @if ($section->settings->show_filters)
        <div class="filters contents">
          <x-shop::product.filters class="hidden w-64 md:block" :maxPrice="$maxPrice" />

          <x-shop::product.mobile-filters
            :maxPrice="$maxPrice"
            :sortOptions="$this->availableSortOptions"
            :paginationLimits="$this->availablePaginationLimits"
          />
        </div>
      @endif

      <div class="flex-1">
        <!-- Toolbar -->
        <x-shop::product.toolbar
          :availableSortOptions="$this->availableSortOptions"
          :availablePaginationLimits="$this->availablePaginationLimits"
          :displayMode="$displayMode"
          :showSorting="$section->settings->show_sorting"
        />

        <!-- Products grid view -->
        @if ($displayMode === 'grid')
          @php
            $mobileClass = ['1' => 'grid-cols-1', '2' => 'grid-cols-2'][$section->settings->columns_mobile] ?? 'grid-cols-1';
            $tabletClass =
                [
                    '1' => 'lg:grid-cols-1',
                    '2' => 'lg:grid-cols-2',
                    '3' => 'lg:grid-cols-3',
                    '4' => 'lg:grid-cols-4',
                ][$section->settings->columns_tablet] ?? 'lg:grid-cols-3';

            $desktopClass =
                [
                    '1' => 'xl:grid-cols-1',
                    '2' => 'xl:grid-cols-2',
                    '3' => 'xl:grid-cols-3',
                    '4' => 'xl:grid-cols-4',
                    '5' => 'xl:grid-cols-5',
                    '6' => 'xl:grid-cols-6',
                ][$section->settings->columns] ?? 'xl:grid-cols-3';
          @endphp

          <div class="{{ $mobileClass }} {{ $tabletClass }} {{ $desktopClass }} grid gap-6">
            @foreach ($products as $product)
              <x-shop::product.card
                wire:key="{{ 'product-' . $product->id }}"
                mode="grid"
                :product="$product"
              />
            @endforeach
          </div>
        @else
          <!-- Products list view -->
          <div class="grid grid-cols-1 gap-6">
            @foreach ($products as $product)
              <x-shop::product.card
                mode="list"
                wire:key="{{ 'product-' . $product->id }}"
                :product="$product"
              />
            @endforeach
          </div>
        @endif

        <div class="mt-4">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

@visual_design_mode
@pushOnce('scripts')
  <script>
    document.addEventListener('visual:editor:init', function() {
      window.Visual.handleLiveUpdate('{{ $section->type }}', {
        section: {
          show_category_banner: {
            target: '.banner',
            handler: function(el, value) {
              el.classList.toggle('hidden');
            }
          },
          show_filters: {
            target: '.filters',
            handler: function(el, value) {
              el.classList.toggle('hidden');
            }
          },
          show_sorting: {
            target: '.sorting',
            handler: function(el, value) {
              el.classList.toggle('hidden');
            }
          },
          columns: {
            target: '.grid',
            handler: function(el, value) {
              Array.from(Array(6)).forEach((_, i) => {
                const cls = `xl:grid-cols-${i + 1}`;
                el.classList.remove(cls);
              });
              el.classList.add(`xl:grid-cols-${value}`);
            }
          },
          columns_tablet: {
            target: '.grid',
            handler: function(el, value) {
              Array.from(Array(4)).forEach((_, i) => {
                const cls = `lg:grid-cols-${i + 1}`;
                el.classList.remove(cls);
              });
              el.classList.add(`lg:grid-cols-${value}`);
            }
          },
          columns_mobile: {
            target: '.grid',
            handler: function(el, value) {
              Array.from(Array(2)).forEach((_, i) => {
                const cls = `grid-cols-${i + 1}`;
                el.classList.remove(cls);
              });
              el.classList.add(`grid-cols-${value}`);
            }
          },
        }
      });
    });
  </script>
@endpushOnce
@end_visual_design_mode
