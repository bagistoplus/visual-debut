<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="flex items-center justify-center px-4 py-16"
>
  <div class="w-full max-w-md">
    <div class="bg-surface text-on-surface box space-y-8 border-0 p-8">
      <div class="text-center">
        <h1 class="text-3xl font-semibold">
          @lang('shop::app.eu-withdrawal.lookup.heading')
        </h1>
        <p class="mt-2">
          @lang('shop::app.eu-withdrawal.lookup.intro')
        </p>
      </div>

      {{-- The same notice whether or not an order matched, so the form cannot tell which order numbers exist --}}
      @if (session('lookup_sent'))
        <div role="status" class="bg-success/10 border-success/30 rounded-(--box-radius) flex items-start gap-3 border p-4 text-sm">
          <x-lucide-mail-check class="text-success mt-0.5 h-5 w-5 shrink-0" />
          <p>@lang('shop::app.eu-withdrawal.lookup.sent-notice')</p>
        </div>
      @endif

      <form
        method="POST"
        action="{{ route('shop.eu_withdrawal.guest.lookup.submit') }}"
        class="grid gap-4"
      >
        @csrf

        <div>
          <label
            for="order_increment_id"
            class="block text-sm font-medium"
            required
          >
            @lang('shop::app.eu-withdrawal.lookup.order-number')
          </label>
          <div class="relative mt-1">
            <div class="inset-s-0 pointer-events-none absolute inset-y-0 flex items-center ps-3">
              <x-lucide-hash class="h-5 w-5" />
            </div>
            <input
              id="order_increment_id"
              required
              type="text"
              name="order_increment_id"
              autocomplete="off"
              value="{{ old('order_increment_id') }}"
              class="py-3 pe-12 ps-10"
            >
          </div>
          @error('order_increment_id')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label
            for="email"
            class="block text-sm font-medium"
            required
          >
            @lang('shop::app.eu-withdrawal.lookup.email')
          </label>
          <div class="relative mt-1">
            <div class="inset-s-0 pointer-events-none absolute inset-y-0 flex items-center ps-3">
              <x-lucide-mail class="h-5 w-5" />
            </div>
            <input
              id="email"
              required
              type="email"
              name="email"
              autocomplete="email"
              value="{{ old('email') }}"
              class="py-3 pe-12 ps-10"
              placeholder="email@example.com"
            >
          </div>
          @error('email')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>

        <x-shop::ui.button
          type="submit"
          block
          :loading="false"
        >
          @lang('shop::app.eu-withdrawal.lookup.submit')
        </x-shop::ui.button>
      </form>
    </div>

    <p class="mt-6 text-center text-xs opacity-70">
      @lang('shop::app.eu-withdrawal.lookup.legal-note')
    </p>
  </div>
</div>
