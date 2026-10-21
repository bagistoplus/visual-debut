@props(['categories'])

<ul class="divide-y border-t pt-2" role="navigation">
  @foreach ($categories as $category)
    @if ($category->children->isEmpty())
      <li>
        <a href="{{ $category->url }}" class="text-on-background block rounded px-3 py-2 text-sm font-medium hover:bg-surface-alt hover:text-on-surface-alt">
          {{ $category->name }}
        </a>
      </li>
    @else
      <li>
        <x-shop::ui.collapsible :id="'mobile-menu-category-' . $category->id">
          <x-shop::ui.collapsible.trigger class="text-on-background flex w-full items-center justify-between rounded px-3 py-2 text-sm font-medium hover:bg-surface-alt hover:text-on-surface-alt">
            <span>{{ $category->name }}</span>
            <x-shop::ui.collapsible.indicator class="transition-transform data-[state=open]:rotate-90">
              <x-lucide-chevron-right class="h-4 w-4" />
            </x-shop::ui.collapsible.indicator>
          </x-shop::ui.collapsible.trigger>
          <x-shop::ui.collapsible.content>
            <div class="space-y-2 p-3">
              @foreach ($category->children as $subCategory)
                <a href="{{ $subCategory->url }}" class="text-on-background block text-sm hover:underline">
                  {{ $subCategory->name }}
                </a>
              @endforeach
            </div>
          </x-shop::ui.collapsible.content>
        </x-shop::ui.collapsible>
      </li>
    @endif
  @endforeach
</ul>

<!-- Currency Selector - Mobile -->
<div class="mt-4 border-t px-4 py-3">
  <x-shop::currency-selector mobile />
</div>

<!-- Language Selector - Mobile -->
<div class="mt-4 border-t px-4 py-3">
  <x-shop::language-selector mobile />
</div>

<div class="absolute bottom-0 left-0 right-0 border-t p-4">
  <a href="@auth('customer') {{ route('shop.customers.account.profile.index') }}  @else {{ route('shop.customer.session.create') }} @endauth"
    class="hover:text-primary hover:bg-surface-600/50 flex items-center justify-between rounded-lg px-4 py-3 transition-colors"
  >
    <span class="flex items-center">
      <x-lucide-user class="mr-3 h-5 w-5" />
      @auth('customer')
        @lang('visual-debut::shop.header.profile')
      @else
        @lang('visual-debut::shop.header.sign-in')
      @endauth
    </span>
    <x-lucide-chevron-right class="h-5 w-5" />
  </a>
</div>
