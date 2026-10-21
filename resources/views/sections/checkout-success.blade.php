@php
  $pricesIncludeTax = core()->getConfigData('sales.taxes.sales.display_prices') == 'including_tax';
@endphp

<div {{ $section->editor_attributes }} {{ $section->settings->color_scheme?->attributes() }} class="min-h-screen py-12">
  <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
    <div class="mb-12 text-center">
      <div class="bg-success/10 mb-6 inline-flex h-16 w-16 items-center justify-center rounded-full">
        <x-lucide-check-circle class="text-success h-8 w-8" />
      </div>
      <h1 class="mb-4 text-3xl">
        @lang('shop::app.checkout.success.thanks')
      </h1>

      <p class="text-on-background/80">
        @if (!empty($order->checkout_message))
          {!! nl2br($order->checkout_message) !!}
        @else
          @lang('shop::app.checkout.success.info')
        @endif
      </p>
    </div>

    <div class="bg-surface text-on-surface box mb-8 overflow-hidden border-none shadow-sm">
      <div class="border-on-surface/8 border-b p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <p class="mb-1 text-sm">@lang('visual-debut::shop.order.order-number')</p>
            <p class="font-medium">#{{ $order->increment_id }}</p>
          </div>
        </div>
      </div>

      <div class="border-on-surface/8 space-y-4 border-b p-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <div class="mb-1 flex items-center gap-2">
              <x-lucide-calendar class="h-5 w-5" />
              @lang('visual-debut::shop.order.order-date')
            </div>
            <p class="text-on-surface/70">
              {{ $order->created_at->format('F j, Y') }}
            </p>
          </div>
          <div>
            <div class="mb-1 flex items-center gap-2">
              <x-lucide-clock class="h-5 w-5" />
              @lang('visual-debut::shop.order.order-time')
            </div>
            <p class="text-on-surface/70">
              {{ $order->created_at->format('h:i A') }}
            </p>
          </div>
        </div>
        <div>
          <div class="mb-1 flex items-center gap-2">
            <x-lucide-truck class="h-5 w-5" />
            @lang('visual-debut::shop.order.confirmation-sent-to')
          </div>
          <p class="text-on-surface/70">
            {{ $order->customer_email }}
          </p>
        </div>
      </div>

      <div class="space-y-6 p-6">
        <div class="space-y-4">
          <div class="grid gap-4">
            @foreach ($order->items as $item)
              @php
                // The type instance picks the chosen variant's image for a configurable item.
                $image = $item->product ? $item->getTypeInstance()->getBaseImage($item) : null;
              @endphp

              <div class="flex gap-4">
                <div class="bg-surface-alt box h-20 w-20 shrink-0 overflow-hidden border-none">
                  @if ($image)
                    <img
                      src="{{ $image['small_image_url'] }}"
                      alt="{{ $item->name }}"
                      class="h-full w-full object-cover"
                    >
                  @endif
                </div>
                <div class="flex-1">
                  <h3 class="text-base font-medium">{{ $item->name }}</h3>

                  @foreach ($item->additional['attributes'] ?? [] as $attribute)
                    <p class="text-sm">
                      <span class="font-medium">{{ $attribute['attribute_name'] }}:</span>
                      {{ $attribute['option_label'] }}
                    </p>
                  @endforeach

                  <p class="text-sm">@lang('visual-debut::shop.order.quantity'): {{ $item->qty_ordered }}</p>
                  <p class="text-primary text-sm">
                    <x-shop::formatted-price :price="$pricesIncludeTax ? $item->total_incl_tax : $item->total" />
                  </p>
                </div>
              </div>
            @endforeach
          </div>

          <div class="border-on-surface/8 border-t pt-4">
            <div class="space-y-2">
              <div class="flex justify-between">
                <span>@lang('visual-debut::shop.order.subtotal')</span>
                <span>
                  <x-shop::formatted-price :price="$pricesIncludeTax ? $order->sub_total_incl_tax : $order->sub_total" />
                </span>
              </div>

              @if ($order->haveStockableItems())
                <div class="flex justify-between">
                  <span>@lang('visual-debut::shop.order.shipping')</span>
                  <span>
                    <x-shop::formatted-price :price="$pricesIncludeTax ? $order->shipping_amount_incl_tax : $order->shipping_amount" />
                  </span>
                </div>
              @endif

              @unless ($pricesIncludeTax)
                <div class="flex justify-between">
                  <span>@lang('shop::app.customers.account.orders.view.information.tax')</span>
                  <span><x-shop::formatted-price :price="$order->tax_amount" /></span>
                </div>
              @endunless

              @if ($order->base_discount_amount > 0)
                <div class="flex justify-between">
                  <span>
                    @lang('shop::app.customers.account.orders.view.information.discount')
                    @if ($order->coupon_code)
                      ({{ $order->coupon_code }})
                    @endif
                  </span>
                  <span>-<x-shop::formatted-price :price="$order->discount_amount" /></span>
                </div>
              @endif
              <div class="border-surface/70 flex justify-between border-t pt-2 text-lg font-medium">
                <span>@lang('visual-debut::shop.order.total')</span>
                <span class="text-primary">
                  <x-shop::formatted-price :price="$order->grand_total" />
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="border-on-surface/8 flex flex-col justify-center gap-4 border-t py-6 lg:flex-row">
        <x-shop::ui.button icon="lucide-arrow-right" href="{{ route('shop.home.index') }}">
          @lang('visual-debut::shop.cart.continue-shopping')
        </x-shop::ui.button>

        @auth('customer')
          <x-shop::ui.button
            variant="outline"
            icon="lucide-arrow-right"
            href="{{ route('shop.customers.account.orders.view', $order->id) }}"
          >
            @lang('visual-debut::shop.order.view-order')
          </x-shop::ui.button>
        @endauth
      </div>
    </div>
  </div>
