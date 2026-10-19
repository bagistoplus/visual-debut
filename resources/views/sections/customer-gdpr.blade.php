@php
  use BagistoPlus\VisualDebut\Support\Gdpr;

  $listProps = [
      'revokeUrl' => Gdpr::route('revoke', '__id__'),
      'revokeMethod' => Gdpr::revokeMethod(),
      'csrfToken' => csrf_token(),
      'labels' => [
          'revoke' => trans('shop::app.customers.account.gdpr.index.datagrid.revoke-btn'),
      ],
  ];
@endphp

<div {{ $section->editor_attributes }} class="bg-background text-on-background box border-none shadow-sm">
  <div class="border-b p-4">
    <div class="flex flex-wrap items-center justify-between gap-4">
      <h1 class="text-2xl">
        @lang('shop::app.customers.account.gdpr.index.title')
      </h1>
      <div class="flex gap-2">
        <x-shop::ui.button
          color="secondary"
          variant="soft"
          icon="lucide-download"
          size="sm"
          :href="Gdpr::route('pdf_view')"
        >
          @lang('shop::app.customers.account.gdpr.index.pdf')
        </x-shop::ui.button>
        <x-shop::ui.button
          color="secondary"
          variant="soft"
          icon="lucide-external-link"
          size="sm"
          :href="Gdpr::route('html_view')"
          target="_blank"
        >
          @lang('shop::app.customers.account.gdpr.index.html')
        </x-shop::ui.button>
      </div>
    </div>
  </div>

  <x-shop::datagrid :src="Gdpr::route('index')">
    <div x-data="VisualGdprList(@js($listProps))">
      <x-shop::datagrid.table />
    </div>
  </x-shop::datagrid>
</div>
