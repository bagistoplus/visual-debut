@php
  use BagistoPlus\VisualDebut\Tailwind;

  $widthClass = $section->settings->content_width === 'container' ? 'container mx-auto px-4 sm:px-6 lg:px-8' : 'px-4 sm:px-6 lg:px-8';

  $paddingTopClasses = Tailwind::responsive($section->settings->padding_top, fn($v) => "pt-{$v}");
  $paddingBottomClasses = Tailwind::responsive($section->settings->padding_bottom, fn($v) => "pb-{$v}");

  $columnClasses = Tailwind::responsive($section->settings->columns, fn($v) => "grid-cols-{$v}");
  $gapClass = 'gap-' . ($section->settings->gap ?? 4);

  $layoutType = Tailwind::responsive($section->settings->layout_type, fn($v) => $v);
  $isCarousel = str_contains($layoutType, 'carousel');
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="{{ $paddingTopClasses }} {{ $paddingBottomClasses }}"
>
  <div class="{{ $widthClass }}">
    @children

    @if ($isCarousel)
      {{-- Carousel layout --}}
      @php
        // Get columns settings as responsive value object
        $columnsRv = $section->settings->columns;

        // Default columns (desktop)
        $defaultColumns = $columnsRv->default ?? 4;

        // Gap configuration
        $gapValue = $section->settings->gap ?? 4;
        $gapRem = $gapValue * 0.25; // Convert to rem
        $spaceBetweenPx = $gapValue * 4; // Convert to pixels

        // Build breakpoints object for carousel
        $breakpoints = [];

        // Mobile breakpoint (if defined)
        if ($columnsRv->has('mobile')) {
            $breakpoints[0] = [
                'slidesPerView' => (int) $columnsRv->mobile,
                'spaceBetween' => $spaceBetweenPx,
            ];
        }

        // Tablet breakpoint (640px - Tailwind sm)
        if ($columnsRv->has('tablet')) {
            $breakpoints[640] = [
                'slidesPerView' => $columnsRv->tablet,
                'spaceBetween' => $spaceBetweenPx,
            ];
        }

        // Desktop breakpoint (1024px - Tailwind lg)
        if ($defaultColumns) {
            $breakpoints[1024] = [
                'slidesPerView' => $defaultColumns,
                'spaceBetween' => $spaceBetweenPx,
            ];
        }

        // Pagination type based on nav_style
        $paginationType = match ($section->settings->nav_style) {
            'dot', 'both' => 'dots',
            default => false,
        };

        // Navigation shape classes
        $navShapeClass = match ($section->settings->nav_shape) {
            'circle' => 'rounded-full',
            'square' => 'rounded-md',
            default => '',
        };

        // Build carousel config array
        $carouselConfig = [
            'slidesPerView' => $defaultColumns,
            'spaceBetween' => $spaceBetweenPx,
            'draggable' => true,
            'pagination' => $paginationType,
            'loop' => false,
            'mousewheel' => true,
            'breakpoints' => $breakpoints,
            'id' => $section->id,
        ];
      @endphp

      <div x-carousel="@js($carouselConfig)" class="relative">
        <div x-carousel:viewport class="no-scrollbar scroll-snap-x overflow-touch flex overflow-x-auto overflow-y-hidden scroll-smooth pb-1">
          @foreach ($products as $product)
            <div x-carousel:slide class="min-w-(--slide-width) mr-(--carousel-space-between)">
              @visualBlock('@visual-debut/product-card', 'static-product-card', [
                  'product' => $product,
              ])
            </div>
          @endforeach

          @if ($products->isEmpty())
            @visual_design_mode
            @for ($i = 1; $i <= $defaultColumns; $i++)
              <div x-carousel:slide>
                <div class="bg-surface-alt group relative overflow-hidden rounded-md">
                  <div class="aspect-square bg-gray-200"></div>
                  <div class="p-4">
                    <h3 class="text-lg font-semibold">Product {{ $i }}</h3>
                    <p class="text-on-surface-muted text-sm">$99.00</p>
                  </div>
                </div>
              </div>
            @endfor
            @end_visual_design_mode
          @endif
        </div>

        @if ($section->settings->nav_style !== 'none' && in_array($section->settings->nav_style, ['arrow', 'both']))
          <button
            x-carousel:prev-button
            class="bg-surface text-on-surface hover:bg-surface-alt {{ $navShapeClass }} absolute left-4 top-1/2 z-10 -translate-y-1/2 cursor-pointer p-2 shadow-md transition-colors disabled:cursor-not-allowed disabled:opacity-30"
            aria-label="Previous"
          >
            @if (($section->settings->nav_icon ?? 'chevron') === 'arrow')
              <x-lucide-arrow-left class="h-6 w-6" />
            @else
              <x-lucide-chevron-left class="h-6 w-6" />
            @endif
          </button>
          <button
            x-carousel:next-button
            class="bg-surface text-on-surface hover:bg-surface-alt {{ $navShapeClass }} absolute right-4 top-1/2 z-10 -translate-y-1/2 cursor-pointer p-2 shadow-md transition-colors disabled:cursor-not-allowed disabled:opacity-30"
            aria-label="Next"
          >
            @if (($section->settings->nav_icon ?? 'chevron') === 'arrow')
              <x-lucide-arrow-right class="h-6 w-6" />
            @else
              <x-lucide-chevron-right class="h-6 w-6" />
            @endif
          </button>
        @endif

        @if ($section->settings->nav_style !== 'none' && in_array($section->settings->nav_style, ['dot', 'both']))
          {{-- Carousel pagination dots --}}
          @php
            $maxPages = $products->isNotEmpty() ? (int) ceil($products->count() / $defaultColumns) : 1;
          @endphp
          <div class="mt-4 flex justify-center gap-2">
            @for ($i = 0; $i < $maxPages; $i++)
              <button
                x-carousel:pagination="{{ $i }}"
                x-show="$carousel.activeIndex === {{ $i }} || {{ $i }} < Math.ceil($carousel.totalSlides / $carousel.visibleSlidesCount)"
                class="border-on-surface h-3 w-3 rounded-full border-2 transition-colors"
                :class="$carousel.activeIndex === {{ $i }} ? 'bg-on-surface' : 'bg-transparent'"
                aria-label="Go to slide {{ $i + 1 }}"
              ></button>
            @endfor
          </div>
        @endif
      </div>
    @else
      {{-- Grid layout --}}
      <div class="{{ $columnClasses }} {{ $gapClass }} grid">
        @foreach ($products as $product)
          @visualBlock('@visual-debut/product-card', 'static-product-card', [
              'product' => $product,
          ])
        @endforeach

        @if ($products->isEmpty())
          @visual_design_mode
          @for ($i = 1; $i <= 4; $i++)
            <div class="bg-surface-alt group relative overflow-hidden rounded-md">
              <div class="aspect-square bg-gray-200"></div>
              <div class="p-4">
                <h3 class="text-lg font-semibold">Product {{ $i }}</h3>
                <p class="text-on-surface-muted text-sm">$99.00</p>
              </div>
            </div>
          @endfor
          @end_visual_design_mode
        @endif
      </div>
    @endif
  </div>
</div>
