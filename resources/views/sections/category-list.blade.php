<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="{{ $paddingClasses }}"
>
  <div class="{{ $widthClass }}">
    @children

    @if ($isCarousel)
      <div x-carousel="@js($carouselConfig)" class="relative">
        <div x-carousel:viewport class="py-px">
          <div x-carousel:track>
            @foreach ($categoryItems as $category)
              <div x-carousel:slide>
                @visualBlock('@visual-debut/category-card', 'static-category-card', [
                    'category' => $category,
                ])
              </div>
            @endforeach

            @if ($categoryItems->isEmpty())
              @visual_design_mode
              @for ($i = 1; $i <= 4; $i++)
                <div x-carousel:slide>
                  <div class="bg-surface-alt group relative aspect-square cursor-pointer overflow-hidden rounded-md">
                    <img
                      src="https://placehold.co/400x400?text=Category+{{ $i }}"
                      alt="{{ trans('visual-debut::sections.category-list.placeholder.category', ['index' => $i]) }}"
                      class="h-full w-full object-cover object-center brightness-75 transition-all group-hover:brightness-90"
                    />
                    <div class="absolute inset-0 flex items-center justify-center">
                      <h3 class="text-center text-xl font-bold text-white">@lang('visual-debut::sections.category-list.placeholder.category', ['index' => $i])</h3>
                    </div>
                  </div>
                </div>
              @endfor
              @end_visual_design_mode
            @endif
          </div>
        </div>

        @if ($showArrowNavigation)
          <button
            x-carousel:prev-button
            class="bg-surface text-on-surface hover:bg-surface-alt {{ $navShapeClass }} inset-s-4 absolute top-1/2 z-10 -translate-y-1/2 cursor-pointer p-2 shadow-md transition-colors disabled:cursor-not-allowed disabled:opacity-10"
            aria-label="{{ trans('visual-debut::shop.previous') }}"
          >
            @if ($useArrowIcon)
              <x-lucide-arrow-left class="inline h-6 w-6 rtl:hidden" />
              <x-lucide-arrow-right class="hidden h-6 w-6 rtl:inline" />
            @else
              <x-lucide-chevron-left class="inline h-6 w-6 rtl:hidden" />
              <x-lucide-chevron-right class="hidden h-6 w-6 rtl:inline" />
            @endif
          </button>
          <button
            x-carousel:next-button
            class="bg-surface text-on-surface hover:bg-surface-alt {{ $navShapeClass }} inset-e-4 absolute top-1/2 z-10 -translate-y-1/2 cursor-pointer p-2 shadow-md transition-colors disabled:cursor-not-allowed disabled:opacity-30"
            aria-label="{{ trans('visual-debut::shop.next') }}"
          >
            @if ($useArrowIcon)
              <x-lucide-arrow-right class="inline h-6 w-6 rtl:hidden" />
              <x-lucide-arrow-left class="hidden h-6 w-6 rtl:inline" />
            @else
              <x-lucide-chevron-right class="inline h-6 w-6 rtl:hidden" />
              <x-lucide-chevron-left class="hidden h-6 w-6 rtl:inline" />
            @endif
          </button>
        @endif

        @if ($showDotNavigation)
          <div class="mt-4 flex justify-center gap-2">
            <template x-for="i in $carousel.totalPages" :key="i">
              <button x-carousel:pagination="i-1" class="border-on-surface data-active:bg-on-surface h-3 w-3 rounded-full border-2 bg-transparent transition-colors"></button>
            </template>
          </div>
        @endif
      </div>
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
            <div class="bg-surface-alt group relative aspect-square cursor-pointer overflow-hidden rounded-md">
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
