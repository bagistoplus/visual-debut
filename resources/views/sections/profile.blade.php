<div {{ $section->editor_attributes }} class="bg-background box border-none shadow-sm">
  <div class="border-b p-4">
    <div class="flex items-center justify-between">
      <h1 class="text-on-background text-2xl">
        @lang('shop::app.customers.account.profile.index.title')
      </h1>
      <x-shop::ui.button
        color="primary"
        variant="soft"
        icon="lucide-edit"
        size="sm"
        href="{{ route('shop.customers.account.profile.edit') }}"
      >
        @lang('shop::app.customers.account.profile.index.edit')
      </x-shop::ui.button>
    </div>
  </div>
  <div class="p-6">
    <div>
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div>
          <label class="text-on-background mb-1 block text-sm font-medium">
            @lang('shop::app.customers.account.profile.index.first-name')
          </label>
          <p>{{ $customer->first_name }}</p>
        </div>

        <div>
          <label class="text-on-background mb-1 block text-sm font-medium">
            @lang('shop::app.customers.account.profile.index.last-name')
          </label>
          <p>{{ $customer->last_name }}</p>
        </div>

        <div>
          <label class="text-on-background mb-1 block text-sm font-medium">
            @lang('shop::app.customers.account.profile.index.email')
          </label>
          <div class="flex items-center gap-2">
            <x-lucide-mail class="h-5 w-5" />

            <p>{{ $customer->email }}</p>
          </div>
        </div>

        <div>
          <label class="text-on-background mb-1 block text-sm font-medium">
            @lang('shop::app.customers.account.profile.index.dob')
          </label>
          <div class="flex items-center gap-2">
            <x-lucide-calendar class="h-5 w-5" />

            <p>{{ $customer->date_of_birth ?? '-' }}</p>
          </div>
        </div>

        <div>
          <label class="text-on-background mb-1 block text-sm font-medium">
            @lang('shop::app.customers.account.profile.index.gender')
          </label>
          <div class="flex items-center gap-2">
            <x-lucide-user-circle class="h-5 w-5" />

            <p>{{ $customer->gender ?? '-' }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
