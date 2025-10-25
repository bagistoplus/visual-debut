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
  class="{{ $classes }} relative truncate px-4 py-2 text-center text-sm"
  x-data="{ show: true }"
  x-show="show"
>
  @if ($section->settings->link)
    <a
      href="{{ $section->settings->link }}"
      class="hover:underline"
      {{ $section->liveUpdate()->text('text')->attr('link', 'href') }}
    >
      {{ $section->settings->text }}
    </a>
    @svg('lucide-arrow-right', ['class' => 'w-4 h-4 inline-block', 'aria-hidden' => true])
  @else
    <p class="announcement-text" {{ $section->liveUpdate()->text('text') }}>
      {{ $section->settings->text }}
    </p>
  @endif

  <button
    class="absolute right-2 top-1/2 -translate-y-1/2 p-1 hover:opacity-75 rtl:left-2 rtl:right-auto"
    aria-label="Close"
    x-on:click="show = false"
  >
    <x-lucide-x class="h-4 w-4" />
  </button>
</div>
