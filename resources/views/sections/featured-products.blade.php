@php
  $products = $getProducts();
@endphp

<div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
  <div class="text-center">
    <h2 class="text-3xl font-extrabold tracking-tight" {{ $section->liveUpdate('heading') }}>
      {{ $section->settings->heading }}
    </h2>
    <p class="text-on-background/80 mt-4 text-base" {{ $section->liveUpdate('subheading') }}>
      {{ $section->settings->subheading }}
    </p>
  </div>
  <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
    @forelse($products as $product)
      @if ($product->url_key)
        <x-shop::product.card :product="$product" />
      @endif
    @empty
    @endforelse
  </div>
</div>
