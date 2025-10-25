@php
  use BagistoPlus\VisualDebut\Tailwind;

  // Content width
  $widthClass = $section->settings->content_width === 'container' ? 'container mx-auto px-4 sm:px-6 lg:px-8' : 'px-4 sm:px-6 lg:px-8';

  // Responsive padding
  $paddingTopClasses = Tailwind::responsive($section->settings->padding_top, fn($v) => "pt-{$v}");
  $paddingBottomClasses = Tailwind::responsive($section->settings->padding_bottom, fn($v) => "pb-{$v}");
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="{{ $widthClass }} {{ $paddingTopClasses }} {{ $paddingBottomClasses }}"
>
  {{-- Responsive grid layout --}}
  @php
    $columnClasses = Tailwind::responsive($section->settings->columns, fn($v) => "grid-cols-{$v}");
    $gapClass = 'gap-' . ($section->settings->gap ?? 4);
  @endphp

  @children

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
            alt="Category {{ $i }}"
            class="h-full w-full object-cover object-center brightness-75 transition-all group-hover:brightness-90"
          />
          <div class="absolute inset-0 flex items-center justify-center">
            <h3 class="text-center text-xl font-bold text-white">Category {{ $i }}</h3>
          </div>
        </div>
      @endfor
      @end_visual_design_mode
    @endif
  </div>
</div>
