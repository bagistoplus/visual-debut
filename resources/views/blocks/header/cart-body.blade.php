{{--
  The cart panel contents. Kept as its own view so the deferred island in cart.blade.php stays a
  thin wrapper. Every value it reads is passed in by Cart::cartBodyData(); an island view cannot
  see the parent view's data, so nothing here may rely on it.
--}}
@if (!$isEmpty)
  <!-- Cart Items -->
  <div class="max-h-64 divide-y overflow-y-auto">
    @foreach ($items as $item)
      <div class="hover:bg-surface-alt not-l px-4 py-2">
        <div class="flex items-start gap-3">
          <!-- Item Image -->
          <div class="shrink-0 overflow-hidden rounded">
            <a class="block h-12 w-12" href="{{ url($item->product_url_key) }}">
              <img
                src="{{ $item->base_image->small_image_url }}"
                alt="{{ $item->name }}"
                class="h-full w-full object-cover"
              />
            </a>
          </div>

          <!-- Item Details -->
          <div class="min-w-0 flex-1">
            <div class="flex items-start justify-between">
              <h4 class="text-on-surface truncate text-sm font-medium">
                <a href="{{ url($item->product_url_key) }}">
                  {{ $item->name }}
                </a>
              </h4>
              <button class="hover:text-danger hover:bg-danger/10 rounded-full p-1 transition-colors" x-on:click="$confirm(() => $wire.removeItem({{ $item->id }}))">
                <x-lucide-trash-2 class="h-4 w-4" />
              </button>
            </div>

            @if (!empty($item->options))
              <x-shop::cart.customizable-items :options="$item->options" />
            @endif

            <div class="mt-1 flex items-start justify-between">
              <!-- Quantity Controls -->
              <div class="flex items-center gap-2 rounded border">
                <button class="hover:bg-surface-alt rounded-full p-1 transition-colors" wire:click="updateItemQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">
                  <x-lucide-minus class="h-3 w-3" />
                </button>

                <span class="text-secondary min-w-5 text-center text-xs">
                  {{ $item->quantity }}
                </span>

                <button class="hover:bg-surface-alt rounded-full p-1 transition-colors" wire:click="updateItemQuantity({{ $item->id }}, {{ $item->quantity + 1 }})">
                  <x-lucide-plus class="h-3 w-3" />
                </button>
              </div>

              <!-- Item Price -->
              <div class="text-right">
                @if ($displayPricesIncludingTax)
                  <div class="text-primary text-sm font-medium">
                    <x-shop::formatted-price :price="$item->price_incl_tax" />
                  </div>
                @elseif ($displayBothPrices)
                  <div class="text-primary text-xs font-medium">
                    <x-shop::formatted-price :price="$item->price_incl_tax" />
                  </div>
                  <div class="text-secondary text-[0.6rem]">
                    @lang('shop::app.checkout.cart.mini-cart.excl-tax')
                    <x-shop::formatted-price :price="$item->price" />
                  </div>
                @else
                  <div class="text-secondary text-xs">
                    <x-shop::formatted-price :price="$item->price" />
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Subtotal and Actions -->
  <div class="mt-3 border-t px-4 pt-3">
    <!-- Subtotal -->
    <div class="mb-3 flex justify-between">
      <span class="text-on-surface font-medium">
        @lang('shop::app.checkout.cart.mini-cart.subtotal')
      </span>
      @if ($displaySubtotalIncludingTax)
        <span class="text-on-background font-bold">
          {{ $subtotalWithTax }}
        </span>
      @elseif ($displayBothSubtotals)
        <div class="flex flex-col justify-end text-right">
          <span class="text-on-background font-bold">
            {{ $subtotalWithTax }}
          </span>
          <span class="text-xs">
            @lang('shop::app.checkout.cart.mini-cart.excl-tax')
            {{ $subtotal }}
          </span>
        </div>
      @else
        <span class="text-on-background font-bold">
          {{ $subtotal }}
        </span>
      @endif
    </div>

    <!-- Action Buttons -->
    <x-shop::ui.button block href="{{ route('shop.checkout.onepage.index') }}">
      @lang('shop::app.checkout.cart.mini-cart.continue-to-checkout')
    </x-shop::ui.button>

    <a href="{{ route('shop.checkout.cart.index') }}" class="mt-4 block w-full cursor-pointer text-center text-sm font-medium hover:underline">
      @lang('shop::app.checkout.cart.mini-cart.view-cart')
    </a>
  </div>
@else
  <!-- Empty Cart Message -->
  <div class="px-4 py-8 text-center">
    <p class="text-secondary mb-4">
      @lang('shop::app.checkout.cart.mini-cart.empty-cart')
    </p>

    <x-shop::ui.button href="/">
      @lang('visual-debut::shop.cart.start-shopping')
    </x-shop::ui.button>

  </div>
@endif
