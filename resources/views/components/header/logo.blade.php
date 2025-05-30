@props(['block'])

@php
  $settings = $block->settings;

  $classes = $block->settings->push_to_left ? ' mr-auto' : '';
  $classes .= $block->settings->push_to_right ? ' ml-auto' : '';
@endphp

<div class="{{ $classes }} flex items-center" {{ $block->liveUpdate()->toggleClass('push_to_left', 'mr-auto')->toggleClass('push_to_right', 'ml-auto') }}>
  <a href="{{ url('/') }}" class="truncate text-2xl font-medium">
    @if ($settings->logo)
      <span class="sr-only">{{ $settings->logo_text ?? config('app.name') }}</span>

      <img
        {{ $block->liveUpdate()->attr('logo', 'src') }}
        src="{{ $settings->logo }}"
        alt="{{ $settings->logo_text ?? config('app.name') }}"
        @class(['h-8 w-auto', 'hidden sm:inline' => $settings->mobile_logo])
      />

      @if ($settings->mobile_logo)
        <img
          {{ $block->liveUpdate()->attr('mobile_logo', 'src') }}
          src="{{ $settings->mobile_logo }}"
          alt="{{ $settings->logo_text ?? config('app.name') }}"
          class="h-8 w-auto sm:hidden"
        />
      @endif
    @elseif ($logo = core()->getCurrentChannel()->logo_url)
      <span class="sr-only">{{ config('app.name') }}</span>
      <img
        src="{{ $logo }}"
        alt="{{ config('app.name') }}"
        class="h-8 w-auto"
      />
    @else
      <span {{ $block->liveUpdate()->text('logo_text') }}>
        {{ $settings->logo_text ?: config('app.name') }}
      </span>
    @endif
  </a>
</div>
