<form class="space-y-2" wire:submit.prevent="applyCoupon">
  <label for="coupon" class="block text-sm font-medium">
    @lang('shop::app.checkout.coupon.apply')
  </label>

  @if ($cart->coupon_code)
    <div class="bg-success-100 box flex items-center justify-between border-none p-3">
      <div>
        <span class="text-success text-sm font-medium">
          @lang('shop::app.checkout.coupon.applied'): {{ $cart->coupon_code }}
        </span>
      </div>
      <button
        type="button"
        class="text-success hover:opacity-80"
        wire:click="removeCoupon"
      >
        <x-lucide-trash-2 class="h-5 w-5" />
      </button>
    </div>
  @else
    <div class="flex items-start gap-2">
      <div class="flex-1">
        <div class="relative">
          <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
            <x-lucide-ticket class="text-on-background h-5 w-5" />
          </div>
          <input
            id="coupon"
            type="text"
            placeholder="{{ trans('visual-debut::shop.enter-code') }}"
            class="pl-10 focus:ring-2"
            wire:model="couponCode"
          >
        </div>
        @error('code')
          <p class="text-danger text-xs italic">{{ $message }}</p>
        @enderror
      </div>

      <x-shop::ui.button type="submit">
        @lang('shop::app.checkout.coupon.button-title')
      </x-shop::ui.button>
    </div>
  @endif
</form>
