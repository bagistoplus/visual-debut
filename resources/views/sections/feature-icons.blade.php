<div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">

  @if ($section->settings->heading)
    <h2 class="mb-2 text-center text-xl font-bold" {{ $section->liveUpdate('heading') }}>
      {{ $section->settings->heading }}
    </h2>
  @endif

  @if ($section->settings->description)
    <p class="text-on-background/80 mb-6 text-center text-sm" {{ $section->liveUpdate('description') }}>
      {{ $section->settings->description }}
    </p>
  @endif

  @php
    $columns = $section->settings->columns ?? 4;
    $iconSize = $section->settings->icon_size ?? 24;
    $layout = $section->settings->layout ?? 'vertical';
    $isRow = $layout === 'horizontal';
    $features = $getFeatures();

    $gridClass =
        [
            1 => 'md:grid-cols-1',
            2 => 'md:grid-cols-2',
            3 => 'md:grid-cols-3',
            4 => 'md:grid-cols-4',
            5 => 'md:grid-cols-5',
            6 => 'md:grid-cols-6',
        ][$columns] ?? 'md:grid-cols-4';
  @endphp

  <div class="{{ $gridClass }} grid grid-cols-1 gap-6">
    @foreach ($features as $feature)
      <div class="{{ $isRow ? 'flex flex-row items-start gap-4 text-left' : 'flex flex-col gap-4 items-center text-center' }} text-sm text-gray-600">

        <div class="border-on-background/70 flex flex-none items-center justify-center rounded-full border" style="width: {{ $iconSize + 24 }}px; height: {{ $iconSize + 24 }}px;">
          @svg($feature['icon'] ?? 'lucide-tag', ['class' => 'text-on-background', 'style' => "width: {$iconSize}px; height: {$iconSize}px;"])
        </div>

        <div>
          <h3 class="text-on-background mb-1 text-base font-semibold">{{ $feature['title'] }}</h3>
          <p class="text-on-background/90 text-xs">{{ $feature['text'] }}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>
