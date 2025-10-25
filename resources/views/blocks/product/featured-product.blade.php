@if ($block->settings->product && $block->settings->product->url_key)
  <x-shop::product.card :product="$block->settings->product" />
@endif
