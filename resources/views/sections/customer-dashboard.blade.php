@php
  $customer = auth()->guard('customer')->user();
  $orderCount = $customer->orders()->count();
  $recentOrders = $customer->orders()->latest()->limit(3)->get();
  $address = $customer->default_address;
  $hasAddresses = $address || $customer->addresses()->exists();
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="space-y-6"
>
  <!-- Greeting -->
  <div class="bg-background text-on-background box flex flex-wrap items-center gap-4 border-none p-6 shadow-sm">
    <div class="bg-primary/10 text-primary grid h-14 w-14 shrink-0 place-items-center rounded-full text-xl font-semibold" aria-hidden="true">
      {{ mb_strtoupper(mb_substr($customer->first_name, 0, 1) . mb_substr($customer->last_name, 0, 1)) }}
    </div>

    <div class="min-w-0 flex-1 basis-52">
      <h1 class="text-2xl">
        @lang('visual-debut::shop.account-dashboard.hello', ['name' => $customer->first_name])
      </h1>
      <p class="text-sm opacity-70">
        @lang('visual-debut::shop.account-dashboard.member-since', ['date' => core()->formatDate($customer->created_at, 'F Y')])
        · {{ trans_choice('visual-debut::shop.account-dashboard.orders-count', $orderCount, ['count' => $orderCount]) }}
      </p>
    </div>

    <x-shop::ui.button
      variant="soft"
      color="secondary"
      size="sm"
      icon="lucide-pencil"
      :href="route('shop.customers.account.profile.edit')"
    >
      @lang('shop::app.customers.account.profile.index.edit')
    </x-shop::ui.button>
  </div>

  <div class="grid gap-6 lg:grid-cols-3">
    <!-- Recent orders -->
    <div class="bg-background text-on-background box border-none shadow-sm lg:col-span-2">
      <div class="flex items-center justify-between gap-4 border-b p-4">
        <h2 class="text-lg font-semibold">@lang('visual-debut::shop.account-dashboard.recent-orders')</h2>
        @if ($orderCount)
          <a href="{{ route('shop.customers.account.orders.index') }}" class="text-primary text-sm hover:underline">
            @lang('visual-debut::shop.account-dashboard.view-all')
          </a>
        @endif
      </div>

      @forelse ($recentOrders as $order)
        <a
          href="{{ route('shop.customers.account.orders.view', $order->id) }}"
          class="hover:bg-surface flex flex-wrap items-center gap-x-4 gap-y-2 border-b px-4 py-3 transition-colors last:border-b-0"
        >
          <div class="min-w-0 flex-1">
            <p class="font-medium">#{{ $order->increment_id }}</p>
            <p class="text-xs opacity-70">{{ core()->formatDate($order->created_at, 'd M Y') }}</p>
          </div>
          <span class="{{ 'label-' . $order->status }}">
            @lang('shop::app.customers.account.orders.status.options.' . str_replace('_', '-', $order->status))
          </span>
          <span class="min-w-24 text-end font-medium">
            {{ core()->formatPrice($order->grand_total, $order->order_currency_code) }}
          </span>
        </a>
      @empty
        <p class="p-6 text-sm opacity-70">@lang('visual-debut::shop.account-dashboard.no-orders')</p>
      @endforelse
    </div>

    <!-- Default address -->
    <div class="bg-background text-on-background box border-none shadow-sm">
      <div class="flex items-center justify-between gap-4 border-b p-4">
        <h2 class="text-lg font-semibold">@lang('shop::app.customers.account.addresses.index.default-address')</h2>
        @if ($hasAddresses)
          <a href="{{ route('shop.customers.account.addresses.index') }}" class="text-primary text-sm hover:underline">
            @lang('visual-debut::shop.account-dashboard.manage')
          </a>
        @endif
      </div>

      <div class="p-4 text-sm">
        @if ($address)
          <x-shop::order.address :address="$address" />
        @elseif ($hasAddresses)
          <p class="opacity-70">@lang('visual-debut::shop.account-dashboard.no-default-address')</p>
        @else
          <p class="opacity-70">@lang('shop::app.customers.account.addresses.index.empty-address')</p>
          <a href="{{ route('shop.customers.account.addresses.create') }}" class="text-primary mt-2 inline-block hover:underline">
            @lang('shop::app.customers.account.addresses.index.add-address')
          </a>
        @endif
      </div>
    </div>
  </div>
</div>
