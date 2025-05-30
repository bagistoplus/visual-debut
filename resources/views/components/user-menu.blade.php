@props(['block'])

<div
  id="user-menu"
  x-data
  x-dropdown
  class="relative"
  @visual_design_mode
  x-on:visual:block:select:{{ $block->id }}.window="$dropdown.open = true"
  x-on:visual:block:deselect:{{ $block->id }}.window="$dropdown.open = false"
  @end_visual_design_mode
>
  <button
    x-dropdown:trigger
    class="relative p-2"
    aria-label="user menu"
  >
    @svg($block->settings->icon, ['class' => 'hover:text-primary h-5 w-5 transition-colors'])
  </button>
  <div
    x-cloak
    x-dropdown:content
    class="bg-surface border-on-surface/8 text-on-surface box absolute end-0 mt-2 border py-2 shadow-lg"
  >
    @guest('customer')
      <div class="w-max">
        <div class="border-on-surface/8 border-b px-4 py-3">
          <p class="text-lg font-semibold" {{ $block->liveUpdate('guest_heading') }}>
            {{ $block->settings->guest_heading }}
          </p>
          <div class="text-on-surface/80 prose prose-sm mt-1 text-sm" {{ $block->liveUpdate('guest_description') }}>
            {!! $block->settings->guest_description !!}
          </div>
        </div>
        <div class="p-4">
          <div class="grid grid-cols-2 gap-2">
            <x-shop::ui.button icon="lucide-log-in" href="{{ route('shop.customer.session.create') }}">
              @lang('visual-debut::sections.header.blocks.user.sign-in')
            </x-shop::ui.button>
            <x-shop::ui.button
              variant="outline"
              icon="lucide-log-in"
              href="{{ route('shop.customers.register.index') }}"
            >
              @lang('visual-debut::sections.header.blocks.user.sign-up')
            </x-shop::ui.button>
          </div>
        </div>
      </div>
    @endguest

    @auth('customer')
      @php
        $menuItems = collect([
            [
                'route' => 'shop.customers.account.profile.index',
                'text' => __('shop::app.components.layouts.header.profile'),
                'icon' => 'lucide-user-circle-2',
                'show' => true,
            ],
            [
                'route' => 'shop.customers.account.orders.index',
                'text' => __('shop::app.components.layouts.header.orders'),
                'icon' => 'lucide-package',
                'show' => true,
            ],
            [
                'route' => 'shop.customers.account.wishlist.index',
                'text' => __('shop::app.components.layouts.header.wishlist'),
                'icon' => 'lucide-heart',
                'show' => !!core()->getConfigData('customer.settings.wishlist.wishlist_option'),
            ],
        ])->filter(fn($item) => $item['show']);
      @endphp

      <div class="w-64">
        <div class="border-on-surface/8 border-b px-4 py-3">
          <div class="flex items-center gap-3">
            <div class="bg-primary-50 flex h-10 w-10 items-center justify-center rounded-full">
              <x-lucide-user class="text-primary h-5 w-5" />
            </div>
            <div>
              <p class="text-on-surface font-medium">
                {{ auth()->guard('customer')->user()->first_name }}
                {{ auth()->guard('customer')->user()->last_name }}
              </p>
              <p class="text-secondary text-sm">
                {{ auth()->guard('customer')->user()->email }}
              </p>
            </div>
          </div>
        </div>

        <div class="py-2">
          @foreach ($menuItems as $item)
            <a href="{{ route($item['route']) }}" class="hover:text-primary hover:bg-surface-alt flex items-center gap-3 px-4 py-2 transition-colors">
              @svg($item['icon'], ['class' => 'h-5 w-5'])
              {{ $item['text'] }}
            </a>
          @endforeach
        </div>

        <div class="border-on-surface/8 border-t pt-2">
          <form method="POST" action="{{ route('shop.customer.session.destroy') }}">
            @csrf
            @method('delete')
            <button type="submit" class="hover:text-danger hover:bg-surface-alt flex w-full items-center gap-3 px-4 py-2 transition-colors">
              <x-lucide-log-out class="h-5 w-5" />
              @lang('shop::app.components.layouts.header.logout')
            </button>
          </form>
        </div>
      </div>
    @endauth
  </div>
</div>
