<x-shop::text-block :block="$block" :additionalAttributes="$block->liveUpdate()->html('text')">
  {!! $block->settings->text !!}
</x-shop::text-block>
