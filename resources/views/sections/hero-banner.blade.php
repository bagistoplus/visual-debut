@php
  $scheme = $section->settings->scheme;
  $bgImage = $section->settings->background;
  $opacity = $section->settings->overlay_opacity ?? 80;
  $height = match ($section->settings->height) {
      'small' => 'h-96',
      'medium' => 'h-[32rem]',
      'large' => 'h-[40rem]',
      'fullheight' => 'h-screen',
      default => 'h-96',
  };
@endphp

<div {{ $scheme?->attributes() }} class="{{ $height }} wrapper relative w-full px-4 text-center">
  @if ($bgImage)
    <div class="absolute inset-0 z-0 bg-cover bg-center" aria-hidden="true">
      <img
        src="{{ $section->settings->background->large() }}"
        alt="Summer collection background"
        class="h-full w-full object-cover"
        {{ $section->liveUpdate()->attr('background', 'src') }}
      />
    </div>
  @endif
  <div class="z-5 pointer-events-none absolute inset-0 bg-black" style="opacity: {{ $opacity }}%"></div>

  <div class="z-5 relative mx-auto flex h-full max-w-3xl flex-col items-center justify-center gap-8 bg-transparent text-white/85">
    @foreach ($section->blocks as $block)
      @if ($block->type === 'heading')
        <h1 class="text-4xl font-bold sm:text-5xl lg:text-6xl" {{ $block->liveUpdate()->text('text') }}>
          {{ $block->settings->text }}
        </h1>
      @elseif ($block->type === 'subtext')
        <p class="text-lg text-white/80" {{ $block->liveUpdate()->text('text') }}>
          {{ $block->settings->text }}
        </p>
      @endif
    @endforeach

    @php
      $buttons = collect($section->blocks)->filter(fn($block) => $block->type === 'button');
    @endphp

    @if ($buttons->isNotEmpty())
      <div class="flex gap-4">
        @foreach ($buttons as $button)
          <x-shop::ui.button
            size="lg"
            color="{{ $button->settings->color }}"
            href="{{ $button->settings->link }}"
          >
            <span {{ $button->liveUpdate()->text('text') }}>
              {{ $button->settings->text }}
            </span>
          </x-shop::ui.button>
        @endforeach
      </div>
    @endif
  </div>
</div>

@visual_design_mode
@pushOnce('scripts')
  <script>
    document.addEventListener('visual:editor:init', function() {
      window.Visual.handleLiveUpdate('{{ $section->type }}', {
        section: {
          height: {
            target: '.wrapper',
            transform: (value) => ({
              'small': 'h-96',
              'medium': 'h-[32rem]',
              'large': 'h-[40rem]',
              'fullheight': 'h-screen',
            })[value] || 'h-96',
            handler: (el, value) => {
              ['h-96', 'h-[32rem]', 'h-[40rem]', 'h-screen'].forEach(heightClass => {
                el.classList.remove(heightClass);
              });
              el.classList.add(value);
            }
          },
        }
      });
    });
  </script>
@endpushOnce
@end_visual_design_mode
