<div {{ $section->editor_attributes }} class="bg-background box border-none shadow-sm">
  <div class="border-b p-4">
    <div class="flex items-center justify-between">
      <h1 class="text-on-background text-2xl">
        @lang('shop::app.customers.account.addresses.edit.edit')
        @lang('shop::app.customers.account.addresses.edit.title')
      </h1>
    </div>
  </div>

  <div class="p-6">
    <x-shop::customer-address-form :address="$address" :action="route('shop.customers.account.addresses.update', $address->id)" />
  </div>
</div>
