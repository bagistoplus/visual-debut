<div {{ $section->editor_attributes }} class="bg-background box border-none shadow-sm">
  <div class="border-b p-4">
    <div class="flex items-center justify-between">
      <h1 class="text-secondary text-2xl">
        @lang('shop::app.customers.account.orders.title')
      </h1>
    </div>
  </div>

  <x-shop::datagrid :src="route('shop.customers.account.orders.index')">
    {{-- <x-slot:mobile>
      hey
    </x-slot:mobile> --}}
  </x-shop::datagrid>
</div>
