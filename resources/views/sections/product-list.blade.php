<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="relative"
>
  <div class="{{ $widthClass }}">
    <div class="{{ $paddingClasses }}">
      @children

      @if ($isCarousel)
        {{-- Carousel layout --}}
        <x-shop::ui.carousel
          :id="'product-list-' . $section->id"
          :config="$carouselConfig"
          :arrows="$showArrowNavigation"
          :dots="$showDotNavigation"
          :nav-shape-class="$navShapeClass"
          :arrow-icon="$useArrowIcon"
        >
          @foreach ($products as $product)
            <x-shop::ui.carousel.item>
              @visualBlock('@visual-debut/product-card', 'static-product-card', [
                  'product' => $product,
              ])
            </x-shop::ui.carousel.item>
          @endforeach

          @if ($products->isEmpty())
            @visual_design_mode
            @for ($i = 1; $i <= 4; $i++)
              <x-shop::ui.carousel.item>
                <div class="bg-surface-alt group relative overflow-hidden rounded-md">
                  <div class="aspect-square bg-gray-200"></div>
                  <div class="p-4">
                    <h3 class="text-lg font-semibold">@lang('visual-debut::sections.product-list.placeholder.product', ['index' => $i])</h3>
                    <p class="text-on-surface-muted text-sm">$99.00</p>
                  </div>
                </div>
              </x-shop::ui.carousel.item>
            @endfor
            @end_visual_design_mode
          @endif
        </x-shop::ui.carousel>
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
                  <h3 class="text-lg font-semibold">@lang('visual-debut::sections.product-list.placeholder.product', ['index' => $i])</h3>
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
</div>
