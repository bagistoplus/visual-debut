<a
  href="{{ $block->settings->url }}"
  class="btn btn-lg btn-{{ $block->settings->variant ?? 'primary' }} btn-{{ $block->settings->style ?? 'solid' }}"
  {{ $block->liveUpdate()->text('text')->attr('url', 'href') }}
>
  {{ $block->settings->text }}
</a>
