@php
  $layout = $block->settings->layout ?? 'inline';
  $gap = $block->settings->gap ?? 2;
  $alignment = $block->settings->alignment ?? 'start';
  $size = $block->settings->size ?? 'sm';
  $variant = $block->settings->variant ?? 'solid';
  $cornerRadius = $block->settings->corner_radius ?? 'md';

  // Layout classes
  $layoutClass = $layout === 'stack' ? 'flex-col items-start' : 'flex-row items-center';

  // Alignment classes
  $alignmentMap = [
    'start' => 'justify-start',
    'center' => 'justify-center',
    'end' => 'justify-end',
  ];
  $alignmentClass = $alignmentMap[$alignment] ?? 'justify-start';

  // Size classes
  $sizeMap = [
    'xs' => 'px-1.5 py-0.5 text-xs',
    'sm' => 'px-2 py-1 text-xs',
    'md' => 'px-3 py-1.5 text-sm',
    'lg' => 'px-4 py-2 text-base',
  ];
  $sizeClass = $sizeMap[$size] ?? $sizeMap['sm'];

  // Corner radius classes
  $radiusMap = [
    'none' => 'rounded-none',
    'sm' => 'rounded-sm',
    'md' => 'rounded-md',
    'lg' => 'rounded-lg',
    'full' => 'rounded-full',
  ];
  $radiusClass = $radiusMap[$cornerRadius] ?? 'rounded-md';

  // Function to get variant classes for a specific color
  $getVariantClass = function($color) use ($variant) {
    return match($variant) {
      'solid' => "bg-{$color} text-{$color}-100",
      'outline' => "bg-transparent border border-{$color} text-{$color}",
      'soft' => "bg-{$color}/10 text-{$color}",
      default => "bg-{$color} text-{$color}-100",
    };
  };
@endphp

<div
  {{ $block->editor_attributes }}
  {!! $block->settings->color_scheme?->attributes() !!}
  class="flex {{ $layoutClass }} gap-{{ $gap }} {{ $alignmentClass }}"
>
  @forelse($labels as $label)
    <span class="{{ $sizeClass }} {{ $getVariantClass($label['color']) }} {{ $radiusClass }} inline-block whitespace-nowrap">
      {{ $label['text'] }}
    </span>
  @empty
    @visual_design_mode
      <span class="{{ $sizeClass }} {{ $getVariantClass('primary') }} {{ $radiusClass }} inline-block whitespace-nowrap">
        New
      </span>
    @end_visual_design_mode
  @endforelse
</div>
