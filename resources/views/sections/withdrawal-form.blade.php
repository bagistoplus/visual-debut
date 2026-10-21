@php
  $orderNumber = $order->increment_id ?? $order->id;
  $backUrl = $isGuest ? route('shop.home.index') : route('shop.customers.account.orders.view', $order->id);
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  @class(['mx-auto max-w-3xl px-4 py-12' => $isGuest])
>
  <div class="bg-background text-on-background box border-none shadow-sm">
    <div class="border-b p-4">
      <div class="flex items-center justify-between gap-4">
        <h1 class="text-2xl">
          @lang('shop::app.eu-withdrawal.form.heading')
        </h1>
        @unless ($isGuest)
          <x-shop::ui.button
            variant="soft"
            color="secondary"
            icon="lucide-arrow-left"
            size="sm"
            :href="$backUrl"
          >
            @lang('shop::app.checkout.onepage.address.back')
          </x-shop::ui.button>
        @endunless
      </div>
    </div>

    <form
      method="POST"
      action="{{ $formUrl }}"
      class="space-y-6 p-6"
    >
      @csrf

      <div role="note" class="bg-warning-100 border-warning text-warning-900 rounded-(--box-radius) flex items-start gap-3 border p-4">
        @svg('lucide-triangle-alert', ['class' => 'mt-0.5 h-5 w-5 shrink-0', 'aria-hidden' => true])

        <div>
          <p class="text-sm font-semibold">
            @lang('shop::app.eu-withdrawal.form.legal-notice-title')
          </p>
          <p class="mt-1 text-sm">
            @lang('shop::app.eu-withdrawal.form.legal-effect', ['order_id' => $orderNumber])
          </p>
        </div>
      </div>

      <div class="grid gap-6 md:grid-cols-3">
        <!-- Order -->
        <aside class="bg-surface text-on-surface rounded-(--box-radius) p-5">
          <p class="text-xs font-medium uppercase tracking-wide opacity-70">
            @lang('shop::app.eu-withdrawal.form.order-summary')
          </p>
          <p class="mt-2 text-lg font-semibold">#{{ $orderNumber }}</p>
          <p class="mt-1 text-sm opacity-80">
            @lang('shop::app.eu-withdrawal.form.placed-on', ['date' => core()->formatDate($order->created_at, 'd M Y')])
          </p>

          <dl class="border-on-surface/10 mt-4 grid gap-2 border-t pt-4 text-sm">
            <div class="flex items-center justify-between gap-4">
              <dt class="opacity-80">@lang('shop::app.eu-withdrawal.form.order-total')</dt>
              <dd class="font-medium">{{ core()->formatPrice($order->grand_total, $order->order_currency_code) }}</dd>
            </div>
            <div class="flex items-center justify-between gap-4">
              <dt class="opacity-80">@lang('shop::app.eu-withdrawal.form.order-items')</dt>
              <dd class="font-medium">{{ $order->total_qty_ordered }}</dd>
            </div>
          </dl>
        </aside>

        <!-- Reason -->
        <div class="md:col-span-2">
          <label for="reason_text" class="block font-medium">
            @lang('shop::app.eu-withdrawal.form.reason-label')
            <span class="ms-1 text-xs font-normal opacity-70">
              @lang('shop::app.eu-withdrawal.form.reason-optional')
            </span>
          </label>
          <p class="mt-1 text-xs opacity-70">
            @lang('shop::app.eu-withdrawal.form.reason-help')
          </p>
          <textarea
            id="reason_text"
            name="reason_text"
            rows="6"
            maxlength="5000"
            class="mt-3 w-full py-2"
            placeholder="{{ trans('shop::app.eu-withdrawal.form.reason-placeholder') }}"
          >{{ old('reason_text') }}</textarea>
          @error('reason_text')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="flex flex-wrap items-center justify-end gap-3">
        <x-shop::ui.button variant="outline" :href="$backUrl">
          @lang('shop::app.eu-withdrawal.form.cancel')
        </x-shop::ui.button>
        <x-shop::ui.button type="submit" :loading="false">
          @lang('shop::app.eu-withdrawal.form.submit')
        </x-shop::ui.button>
      </div>
    </form>
  </div>
</div>
