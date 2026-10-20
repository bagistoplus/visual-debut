{{--
  A full screen loader for work that outlives a click, such as a payment being captured.
  Show it with window.dispatchEvent(new CustomEvent('page-loader:show')) and hide it with
  'page-loader:hide'. A page restored from the back/forward cache comes back without it.
--}}
<div
  x-data="{ active: false }"
  x-show="active"
  x-cloak
  x-transition.opacity
  x-on:page-loader:show.window="active = true"
  x-on:page-loader:hide.window="active = false"
  x-on:pageshow.window="if ($event.persisted) active = false"
  class="z-1000 fixed inset-0 flex flex-col items-center justify-center gap-3 bg-black/50 backdrop-blur-sm"
  role="status"
  aria-live="polite"
>
  <x-lucide-loader-2 class="h-12 w-12 animate-spin text-white" aria-hidden="true" />
  <p class="text-sm font-medium text-white">@lang('visual-debut::shop.please-wait')</p>
</div>
