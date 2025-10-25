<div {{ $section->editor_attributes }} class="flex items-center justify-center px-4 py-12">
  <div class="bg-surface text-on-surface box w-full max-w-md space-y-8 p-8 shadow-sm">
    <div class="text-center">
      <h2 class="text-3xl font-semibold">
        @lang('shop::app.customers.login-form.page-title')
      </h2>
      <p class="text-on-surface-alt/80 mt-2">
        @lang('shop::app.customers.login-form.form-login-text')
      </p>
    </div>
    <form
      method="POST"
      action="{{ route('shop.customer.session.create') }}"
      class="grid gap-4"
      x-data="{ passwordType: 'password' }"
    >
      @csrf
      <div class="space-y-4">
        <div>
          <label for="email" class="block text-sm font-medium">
            @lang('shop::app.customers.login-form.email')
          </label>
          <div class="relative mt-1">
            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
              <x-lucide-mail class="h-5 w-5" />
            </div>
            <input
              id="email"
              type="email"
              name="email"
              autocomplete="email"
              class="py-3 pe-12 ps-10"
              placeholder="email@example.com"
            >
          </div>
          @error('email')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="password" class="block text-sm font-medium">
            @lang('shop::app.customers.login-form.password')
          </label>
          <div class="relative mt-1">
            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
              <x-lucide-lock class="h-5 w-5" />
            </div>
            <input
              id="password"
              name="password"
              autocomplete="current-password"
              placeholder="{{ trans('shop::app.customers.login-form.password') }}"
              class="py-3 pe-12 ps-10"
              x-bind:type="passwordType"
            >
            <button
              type="button"
              class="absolute inset-y-0 end-0 flex items-center pe-3"
              x-on:click="passwordType = passwordType === 'password' ? 'text' : 'password'"
            >
              <x-lucide-eye x-show="passwordType === 'password'" class="h-5 w-5" />
              <x-lucide-eye-off x-show="passwordType === 'text'" class="h-5 w-5" />
            </button>
          </div>
          @error('password')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="flex items-center justify-end">
        <div class="text-sm">
          <a class="text-primary hover:opacity-80" href="{{ route('shop.customers.forgot_password.create') }}">
            @lang('shop::app.customers.login-form.forgot-pass')
          </a>
        </div>
      </div>

      <!-- Captcha -->
      @if (core()->getConfigData('customer.captcha.credentials.status'))
        <div class="[&_.control-error]:text-danger mt-4 flex flex-col items-center gap-2 [&_.control-error]:text-xs">
          {!! \Webkul\Customer\Facades\Captcha::render() !!}
        </div>
      @endif

      <x-shop::ui.button block>
        @lang('shop::app.customers.login-form.button-title')
      </x-shop::ui.button>

      <p class="text-center text-sm">
        @lang('shop::app.customers.login-form.new-customer')
        <a class="text-primary hover:opacity-80" href="{{ route('shop.customers.register.index') }}">
          @lang('shop::app.customers.login-form.create-your-account')
        </a>
      </p>
    </form>
  </div>
</div>

@push('scripts')
  {!! \Webkul\Customer\Facades\Captcha::renderJS() !!}
@endpush
