@php
  $tag = $block->settings->heading_level ?? 'h2';
@endphp

<x-shop::text-block :block="$block" :tag="$tag" :additionalAttributes="$block->liveUpdate()->text('text')">
  {{ $block->settings->text }}
</x-shop::text-block>
