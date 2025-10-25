@isset($product)
  <div {{ $block->editor_attributes }} x-data="VisualBuyButtons" class="flex w-full max-w-sm flex-col gap-4">
    <x-shop::ui.button
      wire:target="addToCart"
      icon="lucide-shopping-cart"
      :disabled="!$product->isSaleable(1)"
      variant="{{ $block->settings->enable_buy_now ? 'outline' : 'primary' }}"
      x-bind:disabled="disableButtons"
      x-on:click.prevent="submit('addToCart')"
    >
      {{ trans('shop::app.products.view.add-to-cart') }}
    </x-shop::ui.button>

    @if ($block->settings->enable_buy_now)
      <x-shop::ui.button
        wire:target="buyNow"
        icon="lucide-shopping-cart"
        :disabled="!$product->isSaleable(1)"
        variant="primary"
        x-bind:disabled="disableButtons"
        x-on:click.prevent="submit('buyNow')"
      >
        {{ trans('shop::app.products.view.buy-now') }}
      </x-shop::ui.button>
    @endif
  </div>
@endisset
