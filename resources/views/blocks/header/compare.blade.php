@if (core()->getConfigData('catalog.products.settings.compare_option'))
  <a
    {{ $block->editor_attributes }}
    class="relative hidden items-center p-2 sm:flex"
    aria-label="@lang('visual-debut::shop.header.compare')"
    title="@lang('visual-debut::shop.header.compare')"
    href="{{ route('shop.compare.index') }}"
  >
    @svg($block->settings->icon ?? 'lucide-arrow-left-right', ['class' => 'hover:text-primary h-5 w-5 transition-colors'])
  </a>
@endif
