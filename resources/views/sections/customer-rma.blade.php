@php
  use BagistoPlus\VisualDebut\Support\Rma;
@endphp

<div
  {{ $section->editor_attributes }}
  {{ $section->settings->color_scheme?->attributes() }}
  class="bg-background text-on-background box border-none shadow-sm"
>
  <div class="border-b p-4">
    <div class="flex items-center justify-between gap-4">
      <h1 class="text-2xl">
        @lang('shop::app.rma.customer-rma-index.heading')
      </h1>
      <x-shop::ui.button
        color="primary"
        variant="soft"
        icon="lucide-plus"
        size="sm"
        :href="Rma::route('create')"
      >
        @lang('shop::app.rma.customer.create.heading')
      </x-shop::ui.button>
    </div>
  </div>

  <x-shop::datagrid :src="Rma::route('index')">
    <div x-data="VisualRmaList(@js(['uncancelable' => Rma::uncancelableStatusIds()]))">
      <x-shop::datagrid.table />
    </div>
  </x-shop::datagrid>
</div>
