<div
  id="cart-preview"
  x-data="{
      syncPanel(open) {
          this.$root.querySelector('ui-popover')?.api?.setOpen(open);
      },
  }"
  x-effect="syncPanel($wire.open)"
  x-on:ui-popover:open-change="$wire.open = $event.detail.open"
  @class([
      'relative',
      'hidden sm:block' => $block->settings->hide_on_mobile ?? false,
  ])
  @visual_design_mode
  x-on:visual:block:select:{{ $block->id }}.window="$wire.open = true"
  x-on:visual:block:deselect:{{ $block->id }}.window="$wire.open = false"
  @end_visual_design_mode
  {{ $block->editor_attributes }}
>
  <x-shop::ui.dropdown id="cart-preview-popover" placement="bottom-end">
    <x-slot:trigger>
      <!-- Cart Button -->
      <button class="relative p-2" aria-label="{{ trans('visual-debut::shop.cart.preview') }}">
        <x-lucide-shopping-cart class="hover:text-primary h-5 w-5 transition-colors" />

        @island(name: 'cart-badge', defer: $this->shouldDeferCartBody(), always: true)
          @placeholder
            <span></span>
          @endplaceholder

          @include('visual-debut::blocks.header.cart-badge', ['count' => $this->getItemsCount()])
        @endisland
      </button>
    </x-slot:trigger>

    <!-- Cart Preview -->
    <div class="bg-surface text-on-surface border-on-surface/8 box w-80 py-4 shadow-lg">
      <!-- Header -->
      <div class="px-4">
        <p class="mb-1 text-xl font-medium" {!! $block->liveUpdate()->text('heading')->toHtml() !!}>
          {{ $block->settings->heading }}
        </p>
        <div class="text-on-surface/80 prose prose-sm mb-4 text-sm" {!! $block->liveUpdate()->html('description')->toHtml() !!}>
          {!! $block->settings->description !!}
        </div>
      </div>

      @island(name: 'cart-body', defer: $this->shouldDeferCartBody(), always: true)
        @placeholder
          @include('visual-debut::blocks.header.cart-skeleton')
        @endplaceholder

        @include('visual-debut::blocks.header.cart-body', $this->cartBodyData())
      @endisland
    </div>
  </x-shop::ui.dropdown>
</div>
