@php
  use BagistoPlus\VisualDebut\Tailwind;

  $icon = $block->settings->icon ?? 'lucide-tag';
  $size = $block->settings->size ?? ['_default' => '6'];
  $color = $block->settings->color ?? 'default';

  $colorClasses = [
    'default' => 'text-on-background',
    'primary' => 'text-primary',
    'secondary' => 'text-secondary',
    'accent' => 'text-accent',
    'info' => 'text-info',
    'success' => 'text-success',
    'warning' => 'text-warning',
    'danger' => 'text-danger',
  ];

  $colorClass = $color === 'custom' ? '' : ($colorClasses[$color] ?? 'text-on-background');
  $colorStyle = $color === 'custom' ? ('color: ' . ($block->settings->custom_color ?? '#000000FF')) : '';

  // Generate responsive size classes (w-6 h-6, tablet:w-8 tablet:h-8, etc.)
  $sizeClasses = Tailwind::responsive($size, fn($v) => "w-{$v} h-{$v}");
@endphp

<div {{ $block->editor_attributes }} class="inline-flex items-center justify-center {{ $colorClass }} {{ $sizeClasses }}" @if($colorStyle) style="{{ $colorStyle }}" @endif>
  @svg($icon)
</div>
