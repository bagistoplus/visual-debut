@php
  $socials = [
      'facebook_url' => 'lucide-facebook',
      'instagram_url' => 'lucide-instagram',
      'youtube_url' => 'lucide-youtube',
      'tiktok_url' => 'ri-tiktok-line',
      'twitter_url' => 'ri-twitter-x-line',
      'snapchat_url' => 'ri-snapchat-line',
  ];
@endphp

<div class="bg-surface-alt text-on-surface-alt/80">
  <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
      <div>
        <h3 class="heading text-on-surface-alt mb-4 text-lg font-bold" {{ $section->liveUpdate()->text('heading') }}>
          {{ $section->settings->heading ?? config('app.name') }}
        </h3>
        <div class="prose description text-sm" {{ $section->liveUpdate()->html('description') }}>
          {!! $section->settings->description !!}
        </div>
      </div>

      @foreach ($getLinks() as $linksGroup)
        <div>
          <h4 class="text-on-surface-alt mb-4 font-bold">{{ $linksGroup['group'] }}</h4>
          <ul class="space-y-2">
            @foreach ($linksGroup['links'] as $item)
              <li><a class="" href="{{ $item['url'] }}">{{ $item['text'] }}</a></li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>

    <div class="border-on-surface-alt/10 mt-12 border-t pt-8">
      <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
        <p class="text-sm">
          © {{ now()->year }} {{ config('app.name') }}. All rights reserved.
        </p>

        @if ($section->settings->show_social_links)
          <div class="flex space-x-4">
            @foreach ($socials as $key => $icon)
              @if ($theme->settings->get($key))
                <a
                  href="{{ $theme->settings->get($key) }}"
                  aria-label="{{ $key }}"
                  class="hover:text-secondary-200"
                >
                  @svg($icon, ['class' => 'h-5 w-5'])
                </a>
              @endif
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

@visual_design_mode
@pushOnce('scripts')
  <script>
    document.addEventListener('visual:editor:init', () => {
      window.Visual.handleLiveUpdate('{{ $section->type }}', {
        section: {
          heading: {
            target: '.heading',
            text: true
          },
          description: {
            target: '.description',
            html: true
          }
        }
      })
    })
  </script>
@endPushOnce
@end_visual_design_mode
