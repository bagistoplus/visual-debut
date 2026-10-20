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
      <div>
        <h1 class="text-2xl">
          @lang('shop::app.customers.account.gdpr.index.title')
        </h1>

        {{-- The banner opens its own dialog, so this is the way back to a choice once made --}}
        @if (core()->getConfigData('general.gdpr.cookie.enabled'))
          <a
            href="{{ \BagistoPlus\VisualDebut\Support\CookieConsent::preferencesUrl() }}"
            class="text-on-background/70 hover:text-primary mt-1 inline-flex items-center gap-1 text-sm"
          >
            @lang('shop::app.components.layouts.cookie.consent.your-cookie-consent-preferences')
            <x-lucide-arrow-right class="h-4 w-4 rtl:rotate-180" />
          </a>
        @endif
      </div>
      <div class="flex flex-wrap gap-2">
        <x-shop::ui.button
          color="secondary"
          variant="soft"
          icon="lucide-download"
          class="whitespace-nowrap"
          size="sm"
          :href="Gdpr::route('pdf_view')"
        >
          @lang('shop::app.customers.account.gdpr.index.pdf')
        </x-shop::ui.button>
        <x-shop::ui.button
          color="secondary"
          variant="soft"
          icon="lucide-external-link"
          class="whitespace-nowrap"
          size="sm"
          :href="Gdpr::route('html_view')"
          target="_blank"
        >
          @lang('shop::app.customers.account.gdpr.index.html')
        </x-shop::ui.button>

        {{-- A real POST: before 2.3.17 and in 2.4.0-2.4.1 Bagisto only redirects, and validates from 2.4.9 by redirecting back, which reopens this --}}
        <x-shop::ui.modal
          id="gdpr-request"
          :title="trans('shop::app.customers.account.gdpr.index.modal.title')"
          :default-open="$errors->hasAny(['type', 'message'])"
        >
          <x-slot:trigger>
            <x-shop::ui.button
              color="primary"
              variant="soft"
              icon="lucide-plus"
              class="whitespace-nowrap"
              size="sm"
            >
              @lang('shop::app.customers.account.gdpr.index.create-btn')
            </x-shop::ui.button>
          </x-slot:trigger>

          <form
            method="POST"
            action="{{ Gdpr::route('store') }}"
            class="md:w-md mt-4 grid gap-4"
          >
            @csrf

            <x-shop::ui.form.select
              name="type"
              :label="trans('shop::app.customers.account.gdpr.index.modal.type.title')"
              required
            >
              <option
                value=""
                disabled
                @selected(!in_array(old('type'), ['update', 'delete'], true))
              >@lang('shop::app.customers.account.gdpr.index.modal.type.choose')</option>
              <option value="update" @selected(old('type') === 'update')>@lang('shop::app.customers.account.gdpr.index.modal.type.update')</option>
              <option value="delete" @selected(old('type') === 'delete')>@lang('shop::app.customers.account.gdpr.index.modal.type.delete')</option>
            </x-shop::ui.form.select>

            {{-- Bagisto stores at most 500 characters, and before 2.4.9 does not check --}}
            <x-shop::ui.form.textarea
              name="message"
              :label="trans('shop::app.customers.account.gdpr.index.modal.message')"
              rows="4"
              maxlength="500"
              required
            >{{ old('message') }}</x-shop::ui.form.textarea>

            <div class="flex justify-end">
              <x-shop::ui.button type="submit">
                @lang('shop::app.customers.account.gdpr.index.modal.save')
              </x-shop::ui.button>
            </div>
          </form>
        </x-shop::ui.modal>
      </div>
    </div>
  </div>

  <x-shop::datagrid :src="Gdpr::route('index')">
    <div x-data="VisualGdprList(@js($listProps))">
      <x-shop::datagrid.table />
    </div>
  </x-shop::datagrid>
</div>
