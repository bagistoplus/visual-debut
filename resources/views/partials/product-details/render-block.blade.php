@switch($block->type)
  @case('text')
    <div class="prose max-w-none">
      {!! $block->settings->text !!}
    </div>
  @break

  @case('separator')
    <hr class="">
  @break

  @case('title')
    <{{ $block->settings->tag }} class="text leading-tight" style="font-size: calc(1.875rem*{{ $block->settings->size / 100 }})">
      {{ $product->name }}
      </{{ $block->settings->tag }}>
    @break

    @case('price')
      <x-shop::product.prices :product="$product" />
    @break

    @case('rating')
      @if ($totalReviews > 0)
        <div class="flex items-center space-x-4">
          <x-shop::star-rating :rating="$averageRating" />
          <span class="text-secondary text-sm">({{ $totalReviews }})</span>
        </div>
      @endif
    @break

    @case('short-description')
      <div class="prose">
        {!! visual_clear_inline_styles($product->short_description) !!}
      </div>
    @break

    @case('quantity-selector')
      @if ($showQuantitySelector)
        <x-shop::quantity-selector label="{{ trans('Quantity') }}" x-on:change="$wire.quantity = $event.detail" />
      @endif
    @break

    @case('buy-buttons')
      <x-shop::product.buy-buttons :product="$product" :showBuyNowButton="$block->settings->enable_buy_now" />
    @break

    @case('description')
      @if ($block->settings->show_in_panel)
        <x-shop::ui.accordion
          class="border-b"
          :value="$block->settings->should_open_panel ? ['description'] : []"
          x-on:visual:setting:updated.window="
          const ctx = $event.detail.data;
          if (ctx.section?.type === 'visual-debut::product-details' &&
              ctx.block?.type === 'description' &&
              ctx.settingId === 'should_open_panel') {
            $accordion.toggle('description');
            $event.detail.skipRefresh();
          }"
        >
          <x-shop::ui.accordion.item id="description" title="Description">
            <div class="prose max-w-none">
              {!! visual_clear_inline_styles($product->description) !!}
            </div>
          </x-shop::ui.accordion.item>
        </x-shop::ui.accordion>
      @else
        <div class="prose max-w-none">
          {!! visual_clear_inline_styles($product->description) !!}
        </div>
      @endif
    @break

    @case('collapsible')
      <x-shop::ui.accordion
        class="border-b"
        :value="$block->settings->should_open_panel ? [$block->id] : []"
        x-on:visual:setting:updated.window="
        const ctx = $event.detail.data;
        if (ctx.section?.type === 'visual-debut::product-details' &&
            ctx.block?.id === '{{ $block->id }}' &&
            ctx.settingId === 'should_open_panel') {
          $accordion.toggle('{{ $block->id }}');
          $event.detail.skipRefresh();
        }"
      >
        <x-shop::ui.accordion.item :id="$block->id">
          <x-shop::ui.accordion.item-trigger class="w-full data-[state=open]:border-b">
            <div class="flex items-center gap-2">
              @if ($block->settings->icon)
                {{ $block->settings->icon->render('w-5 h-5') }}
              @endif
              <span {{ $block->liveUpdate('heading') }}>
                {{ $block->settings->heading }}
              </span>
            </div>
          </x-shop::ui.accordion.item-trigger>
          <x-shop::ui.accordion.item-content class="py-3">
            {!! $block->settings->content !!}
          </x-shop::ui.accordion.item-content>
        </x-shop::ui.accordion.item>
      </x-shop::ui.accordion>
    @break

    @case('variant-picker')
      @if ($hasVariants)
        <x-visual-debut::product-variant-picker :product="$product" />
      @endif
    @break

    @case('grouped-options')
      @if ($product->type === 'grouped')
        <x-shop::product.grouped-options :product="$product" />
      @endif
    @break

    @case('bundle-options')
      @if ($product->type === 'bundle')
        <x-shop::product.bundle-options :product="$product" />
      @endif
    @break

    @case('downloadable-options')
      @if ($product->type === 'downloadable')
        <x-shop::product.downloadable-options :product="$product" />
      @endif
    @break

    @case('customizable-options')
      <x-shop::product.customizable-options :product="$product" />
    @break

  @endswitch
