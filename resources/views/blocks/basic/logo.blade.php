@php
  $logoDesktop = $theme->settings->logo_desktop;
  $logoMobile = $theme->settings->logo_mobile;
  $logoText = $block->settings->logo_text ?: config('app.name');
@endphp

<div {{ $block->editor_attributes }} {{ $block->settings->color_scheme?->attributes() }} class="flex items-center">
  <a href="{{ url('/') }}" class="truncate text-2xl font-medium">
    @if ($logoDesktop)
      <span class="sr-only">{{ $logoText }}</span>

      <img
        src="{{ $logoDesktop }}"
        alt="{{ $logoText }}"
        @class(['h-8 w-auto', 'hidden sm:inline' => $logoMobile])
      />

      @if ($logoMobile)
        <img
          src="{{ $logoMobile }}"
          alt="{{ $logoText }}"
          class="h-8 w-auto sm:hidden"
        />
      @endif
    @elseif ($logo = core()->getCurrentChannel()->logo_url)
      <span class="sr-only">{{ $logoText }}</span>
      <img
        src="{{ $logo }}"
        alt="{{ $logoText }}"
        class="h-8 w-auto"
      />
    @else
      <span>
        {{ $logoText }}
      </span>
    @endif
  </a>
</div>
