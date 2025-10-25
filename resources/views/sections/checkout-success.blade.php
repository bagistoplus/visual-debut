<div {{ $section->editor_attributes }} class="min-h-screen py-12">
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
            <p class="mb-1 text-sm">Order number</p>
            <p class="font-medium">#{{ $order->increment_id }}</p>
          </div>

          <x-shop::ui.button icon="lucide-download" variant="ghost">
            @lang('visual-debut::shop.order.download-invoice')
          </x-shop::ui.button>
        </div>
      </div>

      <div class="border-on-surface/8 space-y-4 border-b p-6">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <div class="mb-1 flex items-center gap-2">
              <x-lucide-calendar class="h-5 w-5" />
              Order Date
            </div>
            <p class="text-on-surface/70">
              {{ $order->created_at->format('F j, Y') }}
            </p>
          </div>
          <div>
            <div class="mb-1 flex items-center gap-2">
              <x-lucide-clock class="h-5 w-5" />
              Order Time
            </div>
            <p class="text-on-surface/70">
              {{ $order->created_at->format('h:i A') }}
            </p>
          </div>
        </div>
        <div>
          <div class="mb-1 flex items-center gap-2">
            <x-lucide-truck class="h-5 w-5" />
            Confirmation sent to
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
              <div class="flex gap-4">
                <div class="bg-surface-alt box h-20 w-20 flex-shrink-0 overflow-hidden border-none">
                  <img
                    src="{{ $item->product->base_image_url }}"
                    alt="{{ $item->name }}"
                    class="h-full w-full object-cover"
                  >
                </div>
                <div class="flex-1">
                  <h3 class="font-medium">{{ $item->name }}</h3>
                  <p class="text-sm">Quantity: {{ $item->qty_ordered }}</p>
                  <p class="text-primary text-sm">
                    <x-shop::formatted-price :price="$item->total_incl_tax" />
                  </p>
                </div>
              </div>
            @endforeach
          </div>

          <div class="border-on-surface/8 border-t pt-4">
            <div class="space-y-2">
              <div class="flex justify-between">
                <span>Subtotal</span>
                <span><x-shop::formatted-price :price="$order->sub_total_incl_tax" /></span>
              </div>
              <div class="flex justify-between">
                <span>Shipping</span>
                <span><x-shop::formatted-price :price="$order->shipping_amount_incl_tax" /></span>
              </div>
              <div class="border-surface/70 flex justify-between border-t pt-2 text-lg font-medium">
                <span>Total</span>
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
          Continue Shopping
        </x-shop::ui.button>

        @auth('customer')
          <x-shop::ui.button
            variant="outline"
            icon="lucide-arrow-right"
            href="{{ route('shop.customers.account.orders.view', $order->id) }}"
          >
            View Order
          </x-shop::ui.button>
        @endauth
      </div>
    </div>
  </div>
