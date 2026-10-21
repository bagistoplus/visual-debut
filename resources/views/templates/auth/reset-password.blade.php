<div class="flex items-center justify-center px-4 py-16">
  <div class="bg-surface text-on-surface box w-full max-w-md space-y-8 border-0 p-8">
    <div class="text-center">
      <h2 class="text-3xl font-semibold">
        @lang('shop::app.customers.reset-password.title')
      </h2>
    </div>

    <form
      method="POST"
      action="{{ route('shop.customers.reset_password.store') }}"
      class="grid gap-4"
      x-data="{ passwordType: 'password', confirmType: 'password' }"
    >
      @csrf
      <input
        type="hidden"
        name="token"
        value="{{ $token }}"
      >

      <div class="space-y-4">
        <div>
          <label
            for="email"
            class="block text-sm font-medium"
            required
          >
            @lang('shop::app.customers.reset-password.email')
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

        <div>
          <label
            for="password"
            class="block text-sm font-medium"
            required
          >
            @lang('shop::app.customers.reset-password.password')
          </label>
          <div class="relative mt-1">
            <div class="inset-s-0 pointer-events-none absolute inset-y-0 flex items-center ps-3">
              <x-lucide-lock class="h-5 w-5" />
            </div>
            <input
              id="password"
              name="password"
              autocomplete="current-password"
              required
              placeholder="{{ trans('shop::app.customers.reset-password.password') }}"
              class="py-3 pe-12 ps-10"
              x-bind:type="passwordType"
            >
            <button
              type="button"
              class="inset-e-0 absolute inset-y-0 flex items-center pe-3"
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

        <div>
          <label
            for="password_confirmation"
            class="block text-sm font-medium"
            required
          >
            @lang('shop::app.customers.reset-password.confirm-password')
          </label>
          <div class="relative mt-1">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <x-lucide-lock class="h-5 w-5" />
            </div>
            <input
              id="password_confirmation"
              name="password_confirmation"
              autocomplete="current-password"
              required
              placeholder="{{ trans('shop::app.customers.reset-password.confirm-password') }}"
              class="py-3 pl-10 pr-12"
              x-bind:type="confirmType"
            >
            <button
              type="button"
              class="absolute inset-y-0 right-0 flex items-center pr-3"
              x-on:click="confirmType = confirmType === 'password' ? 'text' : 'password'"
            >
              <x-lucide-eye x-show="confirmType === 'password'" class="h-5 w-5" />
              <x-lucide-eye-off x-show="confirmType === 'text'" class="h-5 w-5" />
            </button>
          </div>
          @error('password_confirmation')
            <span class="text-danger text-xs">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <button type="submit"
        class="bg-primary focus:ring-primary text-on-primary w-full rounded-(--btn-radius) border border-transparent px-4 py-3 shadow-sm hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2"
      >
        <span>
          @lang('shop::app.customers.reset-password.submit-btn-title')
        </span>
      </button>
    </form>
  </div>
</div>
