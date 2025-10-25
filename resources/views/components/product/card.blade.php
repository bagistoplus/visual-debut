@props(['product', 'mode' => 'grid', 'noCompare' => false])

{{-- blade-formatter-disable --}}
@php
  $productResource = (new \Webkul\Shop\Http\Resources\ProductResource($product))->resolve();
@endphp
{{-- blade-formatter-enable --}}

@if ($mode === 'grid')
  <div {{ $attributes->class('bg-surface text-on-surface box group relative h-full overflow-hidden border-none shadow-sm transition-shadow hover:shadow-md') }}>
    <div class="relative aspect-square overflow-hidden">
      <img
        src="{{ $productResource['base_image']['medium_image_url'] }}"
        alt="{{ $productResource['name'] }}"
        class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105"
      >

      <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity group-hover:opacity-100">
        <div class="absolute left-1/2 top-1/2 z-20 flex -translate-x-1/2 -translate-y-1/2 transform items-center justify-center gap-2">
          <livewire:add-to-cart-button
            :key="str()->random(16)"
            :product-id="$productResource['id']"
            size="lg"
            circle
          />

          @auth('customer')
            @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
              <livewire:add-to-wishlist-button
                :key="str()->random(16)"
                :product-id="$productResource['id']"
                :in-user-wishlist="$productResource['is_wishlist']"
                size="lg"
              />
            @endif
          @endauth
          @if (!$noCompare && core()->getConfigData('catalog.products.settings.compare_option'))
            <livewire:add-to-compare-button
              :key="str()->random(16)"
              :product-id="$productResource['id']"
              size="lg"
            />
          @endif
        </div>
      </div>
    </div>

    <div class="p-4">
      <div class="mb-2 flex items-center gap-2">
        @if (isset($productResource['reviews']) && $productResource['reviews']['total'] > 0)
          <x-shop::star-rating :rating="$productResource['ratings']['average']" />
          <span class="text-secondary text-sm">({{ $productResource['reviews']['total'] }})</span>
        @endif
      </div>

      <a class="text-on-background mb-1 line-clamp-2 text-base font-medium transition-colors before:absolute before:inset-0 before:z-10"
        href="{{ url($productResource['url_key']) }}"
      >
        {{ $productResource['name'] }}
      </a>
      <div class="flex items-center justify-between">
        <div class="text-primary ![&>div>p:nth-of-type(2)]:text-on-background/60 [&_.line-through]:text-on-background/60 flex items-center gap-2 text-lg font-medium">
          {!! $productResource['price_html'] !!}
        </div>

        @if ($productResource['on_sale'])
          <span class="bg-danger text-danger-100 rounded-[var(--box-radius)] px-2 py-1 text-xs">
            @lang('shop::app.components.products.card.sale')
          </span>
        @elseif($productResource['is_new'])
          <span class="bg-primary/10 text-primary rounded-[var(--box-radius)] px-2 py-1 text-xs">
            @lang('shop::app.components.products.card.new')
          </span>
        @endif
      </div>
    </div>
  </div>
@else
  <div {{ $attributes->class('bg-surface box group relative hidden w-full overflow-hidden border-none shadow-sm transition-shadow hover:shadow-md sm:flex') }}>
    <div class="relative w-48 flex-shrink-0">
      <img
        src="{{ $productResource['base_image']['medium_image_url'] }}"
        alt="{{ $productResource['name'] }}"
        class="h-full w-full object-cover object-center"
      >
    </div>

    <div class="flex flex-1 flex-col justify-between p-6">
      <div>
        <div class="mb-2 flex items-center justify-between">
          <a class="text-on-background text-xl font-medium transition-colors" href="{{ url($productResource['url_key']) }}">
            {{ $productResource['name'] }}
          </a>

          @if ($productResource['on_sale'])
            <span class="bg-danger text-danger-100 rounded-[var(--box-radius)] px-2 py-1 text-xs">
              @lang('shop::app.components.products.card.sale')
            </span>
          @elseif($productResource['is_new'])
            <span class="bg-primary/10 text-primary rounded-[var(--box-radius)] px-2 py-1 text-xs">
              @lang('shop::app.components.products.card.new')
            </span>
          @endif
        </div>

        <div class="mb-4 flex items-center gap-2">
          @if (isset($productResource['reviews']) && $productResource['reviews']['total'] > 0)
            <x-shop::star-rating :rating="$productResource['ratings']['average']" />
            <span class="text-secondary text-sm">({{ $productResource['reviews']['total'] }})</span>
          @endif
        </div>

        <div class="mb-4 line-clamp-2">
          {!! visual_clear_inline_styles($product->short_description) !!}
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
          @auth('customer')
            @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
              <livewire:add-to-wishlist-button
                :key="str()->random(16)"
                :product-id="$productResource['id']"
                :in-user-wishlist="$productResource['is_wishlist']"
              />
            @endif
          @endauth

          @if (!$noCompare && core()->getConfigData('catalog.products.settings.compare_option'))
            <livewire:add-to-compare-button key="add-to-compare-{{ $productResource['id'] }}-list" :product-id="$productResource['id']" />
          @endif
        </div>

        <div class="flex items-center gap-4">
          <div class="text-primary [&>div>p:nth-of-type(2)]:text-on-background/60 [&_.line-through]:text-on-background/60 flex items-center gap-2 text-lg font-medium [&>div]:flex">
            {!! $productResource['price_html'] !!}
          </div>

          <livewire:add-to-cart-button
            :key="str()->random(16)"
            x-data="{ submit() { this.$wire.addToCart() } }"
            :productId="$productResource['id']"
          />
        </div>
      </div>
    </div>
  </div>
@endif
