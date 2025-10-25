@php
  $props = [
      'isUserLoggedIn' => auth('customer')->check(),
      'messages' => [
          'itemRemoved' => trans('shop::app.compare.remove-success'),
          'removeAll' => trans('shop::app.compare.remove-all-success'),
      ],
  ];
@endphp
<div
  x-data
  x-products-compare="@js($props)"
  class="py-12"
>
  <div {{ $section->editor_attributes }} class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      @if ($items->isEmpty())
        <div class="text-center">
          <h1 class="text-secondary-700 mb-4 text-3xl font-medium">
            @lang('shop::app.compare.title')
          </h1>
          <p class="mb-8">
            @lang('shop::app.compare.empty-text')
          </p>

          <a class="bg-primary inline-flex items-center rounded-full px-6 py-3 text-white transition-opacity hover:opacity-90" href="{{ route('shop.search.index') }}">
            <x-lucide-arrow-left class="mr-2 h-5 w-5" />
            @lang('visual-debut::shop.cart.continue-shopping')
          </a>
        </div>
      @else
        <div class="mb-8 flex items-center justify-between">
          <h1 class="text-secondary-700 mb-4 text-3xl font-medium">
            @lang('shop::app.compare.title')
          </h1>
          <button class="hover:text-primary transition-colors" x-products-compare:remove-all>
            @lang('shop::app.compare.delete-all')
          </button>
        </div>
        <div class="bg-surface text-on-surface shadow-xs box overflow-x-auto border-none">
          <div class="min-w-max">
            <div class="border-on-surface/8 flex border-b">
              <div class="text-on-background border-on-surface/8 w-[200px] flex-shrink-0 border-r p-4">
                <span class="font-medium">Product Details</span>
              </div>
              @foreach ($items as $item)
                <div class="w-[250px] flex-shrink-0 p-4">
                  <div class="relative">
                    <x-shop::product.card :product="$item" no-compare />
                    <button class="hover:text-primary bg-background z-5 absolute -right-2 -top-2 rounded-full border p-1 transition-colors"
                      x-products-compare:remove="{{ $item->id }}"
                    >
                      <x-lucide-x class="h-4 w-4" />
                    </button>
                  </div>
                </div>
              @endforeach
            </div>

            @foreach ($comparableAttributes as $attribute)
              <div class="not-last:border-b border-on-surface/8 flex">
                <div class="border-on-surface/8 w-[200px] flex-shrink-0 border-r p-4">
                  <span class="text-on-background font-medium">{{ $attribute->admin_name }}</span>
                </div>
                @foreach ($items as $item)
                  <div class="w-[250px] flex-shrink-0 p-4">
                    <div class="prose prose-sm">
                      {!! visual_clear_inline_styles($item->{$attribute->code}) !!}
                    </div>
                  </div>
                @endforeach
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
