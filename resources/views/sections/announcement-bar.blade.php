@php
  $variant = $section->settings->variant ?? 'primary';
  $classes = [
      'primary' => 'bg-primary text-on-primary',
      'secondary' => 'bg-secondary text-on-secondary',
      'accent' => 'bg-accent text-on-accent',
      'neutral' => 'bg-neutral text-on-neutral',
  ][$section->settings->variant];
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->scheme?->attributes() }}
  {{-- Padding on both sides keeps the text centered and clear of the close button --}}
  class="{{ $classes }} relative px-10 py-2 text-center text-sm"
  x-data="{ show: true }"
  x-show="show"
>
  @if ($section->settings->link)
    {{-- The text truncates on its own so the arrow stays visible --}}
    <a
      href="{{ $section->settings->link }}"
      class="group flex min-w-0 items-center justify-center gap-1"
      {{ $section->liveUpdate()->attr('link', 'href') }}
    >
      <span class="truncate group-hover:underline" {{ $section->liveUpdate()->text('text') }}>
        {{ $section->settings->text }}
      </span>
      @svg('lucide-arrow-right', ['class' => 'w-4 h-4 shrink-0 rtl:rotate-180', 'aria-hidden' => true])
    </a>
  @else
    <p class="announcement-text truncate" {{ $section->liveUpdate()->text('text') }}>
      {{ $section->settings->text }}
    </p>
  @endif

  <button
    class="absolute right-2 top-1/2 -translate-y-1/2 p-1 hover:opacity-75 rtl:left-2 rtl:right-auto"
    aria-label="{{ trans('visual-debut::shop.close') }}"
    x-on:click="show = false"
  >
    <x-lucide-x class="h-4 w-4" />
  </button>
</div>
