@php $totalBlocks = count($section->blocks); @endphp

<div class="bg-background text-on-background">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    @if ($section->settings->heading)
      <h2
        class="text mb-8 text-center font-bold leading-tight"
        style="font-size: calc(1.875rem*{{ $section->settings->heading_size / 100 }})"
        {{ $section->liveUpdate('heading') }}
      >
        {{ $section->settings->heading }}
      </h2>
    @endif

    <div class="grid grid-cols-2 gap-6 md:grid-cols-3">
      @foreach ($section->blocks as $index => $block)
        @php
          $isFirst = $index === 0;

          $classes = match (true) {
              $isFirst && $totalBlocks >= 3 => 'col-span-full md:col-span-2 row-span-full md:row-span-2',
              $isFirst => 'col-span-1 md:col-span-2 md:row-span-2',
              default => 'col-span-1 md:row-span-1',
          };
        @endphp

        <div class="{{ $classes }} box overflow-hidden border-none">
          @switch($block->type)
            @case('image')
              <img
                src="{{ $block->settings->image ?? 'https://placehold.co/800x800?text=Image' }}"
                class="h-full w-full object-cover"
                alt=""
                {{ $block->liveUpdate('image', 'src') }}
              >
            @break

            @case('product')
              @if ($block->settings->product)
                <x-shop::product.card :product="$block->settings->product" />
              @else
                <div class="box bg-surface text-on-surface flex h-full flex-col border-none">
                  <img
                    src="https://placehold.co/200x300?text=Product"
                    alt="Placeholder product image"
                    class="h-64 w-full object-cover object-center"
                  />
                  <div class="p-4">
                    <h3>Product sample</h3>
                    <p class="mt-2 text-xs">Product sample description</p>
                    <p class="text-primary mt-2 text-xs">
                      <x-shop::formatted-price :price="45" />
                    </p>
                  </div>
                </div>
              @endif
            @break

            @case('category')
              @if ($block->settings->category)
                <div class="box bg-surface text-on-surface flex h-full flex-col gap-4 border-none">
                  @if ($block->settings->category->banner_url)
                    <img src="{{ $block->settings->category->banner_url }}" class="flex-1 object-cover" />
                  @else
                    <div class="flex aspect-video items-center justify-center bg-gray-200 text-gray-500">
                      {{ $block->settings->category->name }}
                    </div>
                  @endif

                  <div class="flex-none px-4 pb-4">
                    <a href="{{ url($block->settings->category->slug) }}" class="flex items-center gap-2 text-base font-semibold">
                      {{ $block->settings->category->name }}
                      <x-lucide-arrow-right class="h-4 w-4" />
                    </a>
                  </div>
                </div>
              @else
                <div class="box bg-surface text-on-surface flex h-full flex-col border-none">
                  <img
                    src="https://placehold.co/200x300?text=Category"
                    alt="Placeholder product image"
                    class="h-64 w-full object-cover object-center"
                  />
                  <div class="p-4">
                    <h3>Category sample</h3>
                  </div>
                </div>
              @endif
            @break

            @case('custom')
              <div class="box bg-surface text-on-surface flex h-full flex-col gap-2 border-none pb-4">
                @if ($block->settings->image)
                  <img
                    src="{{ $block->settings->image }}"
                    {{ $block->liveUpdate('image', 'src') }}
                    class="h-auto w-full object-cover"
                  >
                @endif

                @if ($block->settings->title)
                  <h3 class="px-4 text-lg font-semibold" {{ $block->liveUpdate('title') }}>{{ $block->settings->title }}</h3>
                @endif

                @if ($block->settings->text)
                  <div class="prose prose-sm px-4 text-sm">{!! $block->settings->text !!}</div>
                @endif

                @if ($block->settings->link)
                  <a
                    href="{{ $block->settings->link }}"
                    class="text-primary inline-block px-4 text-sm hover:underline"
                    {{ $block->liveUpdate('link', 'href') }}
                  >
                    <span {{ $block->liveUpdate('link_text') }}>
                      {{ $block->settings->link_text }}
                    </span>
                  </a>
                @endif
              </div>
            @break
          @endswitch
        </div>
      @endforeach
    </div>
  </div>
</div>
