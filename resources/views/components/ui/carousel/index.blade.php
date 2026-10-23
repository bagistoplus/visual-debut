@props([
    'id',
    // Built by the sections' buildCarouselConfig(): slides-per-page, per-page(-tablet|-mobile), spacing, loop, autoplay, autoplay-delay
    'config' => [],
    'arrows' => false,
    'dots' => false,
    'navShapeClass' => 'rounded-full',
    'arrowIcon' => false,
])

@php
  $slidesPerPage = $config['slides-per-page'] ?? '1';
  $spacing = $config['spacing'] ?? '0px';
  $autoplay = $config['autoplay'] ?? false;
  $navClass = "bg-surface text-on-surface hover:bg-surface-alt {$navShapeClass} absolute top-1/2 z-10 -translate-y-1/2 cursor-pointer p-2 shadow-md transition-colors disabled:cursor-not-allowed";

  // Read by the static classes below until the bundle runs, so the row has the right width at any viewport
  $perPageStyle = collect([
      '--per-page' => $config['per-page'] ?? null,
      '--per-page-tablet' => $config['per-page-tablet'] ?? null,
      '--per-page-mobile' => $config['per-page-mobile'] ?? null,
  ])
      ->filter(fn($value) => $value !== null)
      ->map(fn($value, $property) => "{$property}: {$value};")
      ->implode(' ');
@endphp

<ui-carousel
  id="{{ $id }}"
  translations-prev-trigger="{{ trans('visual-debut::shop.previous') }}"
  slides-per-page="{{ $slidesPerPage }}"
  slides-per-move="1"
  spacing="{{ $spacing }}"
  @if ($config['loop'] ?? false) loop @endif
  @if ($autoplay) autoplay
    autoplay-delay="{{ $config['autoplay-delay'] ?? 3000 }}"
    x-data
    x-on:mouseenter="$el.api?.pause()"
    x-on:mouseleave="$el.api?.play()"
    x-on:focusin="$el.api?.pause()"
    x-on:focusout="$el.contains($event.relatedTarget) || $el.api?.play()" @endif
  translations-next-trigger="{{ trans('visual-debut::shop.next') }}"
  style="--slide-spacing: {{ $spacing }}; {{ $perPageStyle }}"
  {{ $attributes->merge(['class' => 'relative block [--slides-per-page:var(--per-page,1)] tablet:[--slides-per-page:var(--per-page-tablet,var(--per-page,1))] mobile:[--slides-per-page:var(--per-page-mobile,var(--per-page-tablet,var(--per-page,1)))]']) }}
>
  <ui-carousel-item-group id="{{ $id }}-items" class="py-px">
    {{ $slot }}
  </ui-carousel-item-group>

  @if ($arrows)
    <ui-carousel-prev-trigger delegate>
      <button class="{{ $navClass }} inset-s-4 disabled:invisible" @disabled(!($config['loop'] ?? false))>
        @svg($arrowIcon ? 'lucide-arrow-left' : 'lucide-chevron-left', ['class' => 'h-6 w-6 rtl:rotate-180'])
      </button>
    </ui-carousel-prev-trigger>
    <ui-carousel-next-trigger delegate>
      <button class="{{ $navClass }} inset-e-4 disabled:invisible">
        @svg($arrowIcon ? 'lucide-arrow-right' : 'lucide-chevron-right', ['class' => 'h-6 w-6 rtl:rotate-180'])
      </button>
    </ui-carousel-next-trigger>
  @endif

  @if ($dots)
    <ui-carousel-indicator-group id="{{ $id }}-dots" class="mt-4 flex min-h-3 justify-center gap-2 [&:not(:has(ui-carousel-indicator~ui-carousel-indicator))]:invisible">
      <template>
        <ui-carousel-indicator delegate>
          <button class="border-on-surface data-current:bg-on-surface h-3 w-3 rounded-full border-2 bg-transparent transition-colors"></button>
        </ui-carousel-indicator>
      </template>
    </ui-carousel-indicator-group>
  @endif
</ui-carousel>
