@if (core()->getConfigData('catalog.products.settings.compare_option'))
  <a
    {{ $block->editor_attributes }}
    @class([
      'relative items-center p-2',
      'hidden sm:flex' => $block->settings->hide_on_mobile ?? false,
      'flex' => !($block->settings->hide_on_mobile ?? false),
    ])
    aria-label="@lang('visual-debut::shop.header.compare')"
    title="@lang('visual-debut::shop.header.compare')"
    href="{{ route('shop.compare.index') }}"
  >
    @svg($block->settings->icon ?? 'lucide-arrow-left-right', ['class' => 'hover:text-primary h-5 w-5 transition-colors'])
  </a>
@endif
