<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
>
  <div class="{{ $widthClass }}">
    <div class="{{ $paddingClasses }}">
      @children

      @if ($isCarousel)
        <x-shop::ui.carousel
          :id="'category-list-' . $section->id"
          :config="$carouselConfig"
          :arrows="$showArrowNavigation"
          :dots="$showDotNavigation"
          :nav-shape-class="$navShapeClass"
          :arrow-icon="$useArrowIcon"
        >
          @foreach ($categoryItems as $category)
            <x-shop::ui.carousel.item>
              @visualBlock('@visual-debut/category-card', 'static-category-card', [
                  'category' => $category,
              ])
            </x-shop::ui.carousel.item>
          @endforeach

          @if ($categoryItems->isEmpty())
            @visual_design_mode
            @for ($i = 1; $i <= 4; $i++)
              <x-shop::ui.carousel.item>
                <div class="bg-surface-alt group relative aspect-square cursor-pointer overflow-hidden rounded-(--box-radius)">
                  <img
                    src="https://placehold.co/400x400?text=Category+{{ $i }}"
                    alt="{{ trans('visual-debut::sections.category-list.placeholder.category', ['index' => $i]) }}"
                    class="h-full w-full object-cover object-center brightness-75 transition-all group-hover:brightness-90"
                  />
                  <div class="absolute inset-0 flex items-center justify-center">
                    <h3 class="text-center text-xl font-bold text-white">@lang('visual-debut::sections.category-list.placeholder.category', ['index' => $i])</h3>
                  </div>
                </div>
              </x-shop::ui.carousel.item>
            @endfor
            @end_visual_design_mode
          @endif
        </x-shop::ui.carousel>
      @else
        <div class="{{ $columnClasses }} {{ $gapClass }} grid">
          @foreach ($categoryItems as $category)
            @visualBlock('@visual-debut/category-card', 'static-category-card', [
                'category' => $category,
            ])
          @endforeach

          @if ($categoryItems->isEmpty())
            @visual_design_mode
            @for ($i = 1; $i <= 4; $i++)
              <div class="bg-surface-alt group relative aspect-square cursor-pointer overflow-hidden rounded-(--box-radius)">
                <img
                  src="https://placehold.co/400x400?text=Category+{{ $i }}"
                  alt="{{ trans('visual-debut::sections.category-list.placeholder.category', ['index' => $i]) }}"
                  class="h-full w-full object-cover object-center brightness-75 transition-all group-hover:brightness-90"
                />
                <div class="absolute inset-0 flex items-center justify-center">
                  <h3 class="text-center text-xl font-bold text-white">@lang('visual-debut::sections.category-list.placeholder.category', ['index' => $i])</h3>
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
