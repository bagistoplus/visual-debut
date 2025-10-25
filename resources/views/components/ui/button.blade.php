@props([
    'variant' => 'solid',
    'color' => 'primary',
    'size' => 'md',
    'icon' => null,
    'href' => null,
    'circle' => false,
    'square' => false,
    'block' => false,
    'loading' => null,
    'additionalAttributes' => '',
])

@php
  $classes = "relative btn btn-{$size} btn-{$color} btn-{$variant}";

  if ($square) {
      $classes .= ' btn-square';
  }

  if ($circle) {
      $classes .= ' btn-circle';
  }

  if ($block) {
      $classes .= ' btn-block';
  }

  $type = $attributes->get('type');
  $wireClick = $attributes->whereStartsWith('wire:click')->first();
  $loading ??= $type === 'submit' || $wireClick || $attributes->has('wire:target');

  if ($wireClick && !$attributes->has('wire:target')) {
      $attributes = $attributes->merge(['wire:target' => $wireClick], escape: false);
  }

  $wireTarget = $attributes->has('wire:target') ? 'wire:target=' . $attributes->get('wire:target') : '';

  $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
  @if ($href) href="{{ $href }}" @endif
  {{ $attributes->merge(['class' => $classes]) }}
  {!! $additionalAttributes !!}
  @if ($loading) wire:loading.attr="loading" @endif
>
  @if ($icon)
    <span @if ($loading) {!! $wireTarget !!} wire:loading.class="opacity-0" @endif
      class="inline-flex h-5 w-5 items-center justify-center transition-opacity duration-200"
    >
      @svg($icon, ['class' => 'size-[1.2em]'])
    </span>
  @endif

  @if (!$square && !$circle)
    @if ($loading)
      <span
        {!! $wireTarget !!}
        wire:loading.class="opacity-0"
        class="transition-opacity duration-200"
      >
        {{ $slot }}
      </span>
    @else
      <span>{{ $slot }}</span>
    @endif
  @endif

  @if ($loading)
    <span
      {!! $wireTarget !!}
      class="absolute top-1/2 -translate-y-1/2 transform"
      wire:loading.class="loading"
    >
    </span>
  @endif
  </{{ $tag }}>
