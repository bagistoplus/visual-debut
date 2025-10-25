@php
  use BagistoPlus\VisualDebut\Tailwind;

  // Content width
  $widthClass = $section->settings->content_width === 'container' ? 'container mx-auto px-4 sm:px-6 lg:px-8' : 'px-4 sm:px-6 lg:px-8';

  // Responsive padding
  $paddingTopClasses = Tailwind::responsive($section->settings->padding_top, fn($v) => "pt-{$v}");
  $paddingBottomClasses = Tailwind::responsive($section->settings->padding_bottom, fn($v) => "pb-{$v}");
  // Responsive columns
  $columnClasses = Tailwind::responsive($section->settings->columns, fn($v) => "grid-cols-{$v}");
  $gapClass = 'gap-' . ($section->settings->gap ?? 4);

  // Layout type
  $layoutType = Tailwind::responsive($section->settings->layout_type, fn($v) => $v);
  $isCarousel = str_contains($layoutType, 'carousel');
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="{{ $widthClass }} {{ $paddingTopClasses }} {{ $paddingBottomClasses }}"
>
  @children

  @if ($isCarousel)
    {{-- Carousel layout --}}
    <div class="relative">
      <div class="overflow-hidden">
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
      </div>

      @if ($section->settings->nav_style !== 'none' && in_array($section->settings->nav_style, ['arrow', 'both']))
        {{-- Carousel arrows --}}
        @php
          $navShapeClass = match ($section->settings->nav_shape) {
              'circle' => 'rounded-full',
              'square' => 'rounded-md',
              default => '',
          };
        @endphp
        <button class="bg-surface text-on-surface {{ $navShapeClass }} absolute left-0 top-1/2 -translate-y-1/2 p-2 shadow-md" aria-label="Previous">
          <x-lucide-chevron-left class="h-6 w-6" />
        </button>
        <button class="bg-surface text-on-surface {{ $navShapeClass }} absolute right-0 top-1/2 -translate-y-1/2 p-2 shadow-md" aria-label="Next">
          <x-lucide-chevron-right class="h-6 w-6" />
        </button>
      @endif

      @if ($section->settings->nav_style !== 'none' && in_array($section->settings->nav_style, ['dot', 'both']))
        {{-- Carousel dots --}}
        <div class="mt-4 flex justify-center gap-2">
          @for ($i = 0; $i < 3; $i++)
            <button class="bg-on-surface-muted h-2 w-2 rounded-full" aria-label="Go to slide {{ $i + 1 }}"></button>
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
