<div id="admin-topbar" class="flex justify-between bg-gray-900 px-4 py-2 text-sm text-white">
  <p>
    <a href="https://visual.bagistoplus.com" target="_blank">Bagisto Visual</a>
  </p>
  <a
    href="{{ $section->settings->url }}"
    class="flex items-center gap-2 hover:underline"
    target="_blank"
    {{ $section->liveUpdate('url', 'href') }}
    {{ $section->liveUpdate('text') }}
  >
    {{ $section->settings->text }}
    <x-lucide-arrow-right class="h-5 w-5" />
  </a>
</div>
