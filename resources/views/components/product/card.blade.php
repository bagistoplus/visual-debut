@props(['product', 'mode' => 'grid', 'noCompare' => false, 'lazy' => true])

@php
  $typeInstance = $product->getTypeInstance();
  $reviewHelper = app(\Webkul\Product\Helpers\Review::class);
  $reviewsTotal = $reviewHelper->getTotalReviews($product);

  $card = [
      'id' => $product->id,
      'name' => $product->name,
      'url_key' => $product->url_key,
      'base_image' => product_image()->getProductBaseImage($product),
      'is_new' => (bool) $product->new,
      'on_sale' => (bool) $typeInstance->haveDiscount(),
      'is_wishlist' => (bool) auth('customer')
          ->user()
          ?->wishlist_items->where('channel_id', core()->getCurrentChannel()->id)
          ->where('product_id', $product->id)
          ->count(),
      'price_html' => $typeInstance->getPriceHtml(),
      'ratings' => ['average' => $reviewsTotal > 0 ? $reviewHelper->getAverageRating($product) : 0],
      'reviews' => ['total' => $reviewsTotal],
  ];

  // Two cards share a row on phones, too narrow for three large buttons
  $actionSize = ['_default' => 'lg', 'mobile' => 'md'];
@endphp

@if ($mode === 'grid')
  <div {{ $attributes->class('box group relative h-full overflow-hidden border-none shadow-sm transition-shadow hover:shadow-md') }}>
    <div class="relative aspect-square overflow-hidden">
      <img
        src="{{ $card['base_image']['medium_image_url'] }}"
        alt="{{ $card['name'] }}"
        class="h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105"
        @if ($lazy) loading="lazy" @endif
        decoding="async"
      >

      <div class="absolute inset-0 bg-black/40 opacity-0 transition-opacity group-hover:opacity-100">
        <div class="absolute left-1/2 top-1/2 z-20 flex -translate-x-1/2 -translate-y-1/2 transform items-center justify-center gap-2">
          <x-shop::product.action-button
            action="cart"
            :product-id="$card['id']"
            :size="$actionSize"
            circle
          />

          @auth('customer')
            @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
              <x-shop::product.action-button
                action="wishlist"
                :product-id="$card['id']"
                :in-wishlist="$card['is_wishlist']"
                :size="$actionSize"
                circle
              />
            @endif
          @endauth
          @if (!$noCompare && core()->getConfigData('catalog.products.settings.compare_option'))
            <x-shop::product.action-button
              action="compare"
              :product-id="$card['id']"
              :size="$actionSize"
              circle
            />
          @endif
        </div>
      </div>
    </div>

    <div class="p-4">
      <div class="mb-2 flex items-center gap-2">
        @if (isset($card['reviews']) && $card['reviews']['total'] > 0)
          <x-shop::star-rating :rating="$card['ratings']['average']" />
          <span class="text-secondary text-sm">({{ $card['reviews']['total'] }})</span>
        @endif
      </div>

      <a class="text-on-background mb-1 line-clamp-2 text-base font-medium transition-colors before:absolute before:inset-0 before:z-10" href="{{ url($card['url_key']) }}">
        {{ $card['name'] }}
      </a>
      <div class="flex items-center justify-between">
        <div class="text-primary ![&>div>p:nth-of-type(2)]:text-on-background/60 [&_.line-through]:text-on-background/60 flex items-center gap-2 text-lg font-medium">
          {!! $card['price_html'] !!}
        </div>

        @if ($card['on_sale'])
          <span class="bg-danger text-on-danger rounded-(--box-radius) px-2 py-1 text-xs">
            @lang('shop::app.components.products.card.sale')
          </span>
        @elseif($card['is_new'])
          <span class="bg-primary/10 text-primary rounded-(--box-radius) px-2 py-1 text-xs">
            @lang('shop::app.components.products.card.new')
          </span>
        @endif
      </div>
    </div>
  </div>
@else
  <div {{ $attributes->class('box group relative hidden w-full overflow-hidden border-none shadow-sm transition-shadow hover:shadow-md sm:flex') }}>
    <div class="relative w-48 shrink-0">
      <img
        src="{{ $card['base_image']['medium_image_url'] }}"
        alt="{{ $card['name'] }}"
        class="h-full w-full object-cover object-center"
        @if ($lazy) loading="lazy" @endif
        decoding="async"
      >
    </div>

    <div class="flex flex-1 flex-col justify-between p-6">
      <div>
        <div class="mb-2 flex items-center justify-between">
          <a class="text-on-background text-xl font-medium transition-colors" href="{{ url($card['url_key']) }}">
            {{ $card['name'] }}
          </a>

          @if ($card['on_sale'])
            <span class="bg-danger text-on-danger rounded-(--box-radius) px-2 py-1 text-xs">
              @lang('shop::app.components.products.card.sale')
            </span>
          @elseif($card['is_new'])
            <span class="bg-primary/10 text-primary rounded-(--box-radius) px-2 py-1 text-xs">
              @lang('shop::app.components.products.card.new')
            </span>
          @endif
        </div>

        <div class="mb-4 flex items-center gap-2">
          @if (isset($card['reviews']) && $card['reviews']['total'] > 0)
            <x-shop::star-rating :rating="$card['ratings']['average']" />
            <span class="text-secondary text-sm">({{ $card['reviews']['total'] }})</span>
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
              <x-shop::product.action-button
                action="wishlist"
                :product-id="$card['id']"
                :in-wishlist="$card['is_wishlist']"
                circle
              />
            @endif
          @endauth

          @if (!$noCompare && core()->getConfigData('catalog.products.settings.compare_option'))
            <x-shop::product.action-button
              action="compare"
              :product-id="$card['id']"
              circle
            />
          @endif
        </div>

        <div class="flex items-center gap-4">
          <div class="text-primary [&>div>p:nth-of-type(2)]:text-on-background/60 [&_.line-through]:text-on-background/60 flex items-center gap-2 text-lg font-medium [&>div]:flex">
            {!! $card['price_html'] !!}
          </div>

          <x-shop::product.action-button action="cart" :product-id="$card['id']" />
        </div>
      </div>
    </div>
  </div>
@endif
