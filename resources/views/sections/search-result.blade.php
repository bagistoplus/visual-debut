<div>
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    @if (request()->has('image-search'))
      <div class="bg-surface-alt text-on-surface-alt border-on-surface-alt/8 box flex p-5" x-data="{
          query: '{{ request('query') }}',
          searchedImageUrl: localStorage.searchedImageUrl,
          searchedTerms: (localStorage.searchedTerms && localStorage.searchedTerms !== '') ? localStorage.searchedTerms.split('_') : [],
          search(term) {
              const url = new URL(window.location.href);
              url.searchParams.set('query', term);
              window.location.href = url.href;
          }
      }">
        <img x-bind:src="searchedImageUrl" class="w-32 flex-none">
        <div class="ml-5 flex-1">
          <h2 class="text-on-background text-2xl font-semibold">
            @lang('shop::app.search.images.results.analyzed-keywords')
          </h2>
          <div class="mt-4 flex flex-wrap gap-4">
            <template x-for="term in searchedTerms">
              <span
                x-text="term"
                class="cursor-pointer rounded-full border px-4 py-1"
                x-bind:class="term === query ? 'bg-primary text-primary-50 border-primary' : 'border-secondary text-on-background'"
                x-on:click="search(term)"
              ></span>
            </template>
          </div>
        </div>
      </div>
    @endif

    <h1 class="my-6 text-2xl font-medium max-sm:text-base">
      {{ preg_replace('/[,\\"\\\']+/', '', $title) }}
    </h1>

    <div class="flex flex-col gap-8 md:flex-row">
      <x-shop::product.filters class="hidden w-64 md:block" :maxPrice="$maxPrice" />

      <x-shop::product.mobile-filters
        :maxPrice="$maxPrice"
        :sortOptions="$this->availableSortOptions"
        :paginationLimits="$this->availablePaginationLimits"
      />

      <div class="flex-1">
        <!-- Toolbar -->
        <x-shop::product.toolbar
          :availableSortOptions="$this->availableSortOptions"
          :availablePaginationLimits="$this->availablePaginationLimits"
          :displayMode="$displayMode"
        />

        <!-- Products grid view -->
        @if ($displayMode === 'grid')
          <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
              <x-shop::product.card
                :key="$product->id"
                :product="$product"
                mode="grid"
              />
            @endforeach
          </div>
        @else
          <!-- Products list view -->
          <div class="grid grid-cols-1 gap-6">
            @foreach ($products as $product)
              <x-shop::product.card
                :key="$product->id"
                :product="$product"
                mode="list"
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
