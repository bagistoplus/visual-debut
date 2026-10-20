@props(['cookie', 'redirect' => null])

@php
  // Cookie name => [Bagisto's label key, the admin's description field]
  $categories = [
      'basic_interaction' => ['basic-interactions', 'basic_interaction'],
      'experience_enhancement' => ['experience-enhancement', 'experience_enhancement'],
      'measurements' => ['measurements', 'measurements'],
      'targeting_advertising' => ['targeting-and-advertising', 'targeting_advertising'],
  ];

  $props = ['cookie' => $cookie, 'redirect' => $redirect];
@endphp

<form
  x-data="VisualCookiePreferences(@js($props))"
  x-on:submit.prevent="save()"
  class="grid gap-4 md:w-xl"
>
  <label class="flex items-start gap-3">
    <input type="checkbox" class="mt-1 shrink-0" checked disabled>
    <span>
      <span class="block font-semibold">@lang('shop::app.components.layouts.cookie.consent.strictly-necessary')</span>
      <span class="text-on-background/70 block text-sm">{!! core()->getConfigData('general.gdpr.cookie_consent.strictly_necessary') !!}</span>
    </span>
  </label>

  @foreach ($categories as $name => [$label, $field])
    <label class="flex cursor-pointer items-start gap-3">
      <input type="checkbox" class="mt-1 shrink-0" x-model="choices.{{ $name }}">
      <span>
        <span class="block font-semibold">@lang('shop::app.components.layouts.cookie.consent.' . $label)</span>
        <span class="text-on-background/70 block text-sm">{!! core()->getConfigData('general.gdpr.cookie_consent.' . $field) !!}</span>
      </span>
    </label>
  @endforeach

  <div class="flex flex-wrap justify-end gap-2 pt-2">
    <x-shop::ui.button variant="outline" size="sm" type="button" x-on:click="rejectAll()">
      @lang('shop::app.components.layouts.cookie.index.reject')
    </x-shop::ui.button>
    <x-shop::ui.button variant="outline" size="sm" type="button" x-on:click="acceptAll()">
      @lang('shop::app.components.layouts.cookie.index.accept')
    </x-shop::ui.button>
    <x-shop::ui.button size="sm" type="submit" :loading="false">
      @lang('shop::app.components.layouts.cookie.consent.save-and-continue')
    </x-shop::ui.button>
  </div>
</form>
