@php
  $menuId = 'nav-' . $block->id;
  $itemClass = 'group inline-flex h-10 w-max items-center justify-center gap-1 box border-none px-3 py-2 text-sm font-medium xl:px-4 transition-colors hover:bg-surface-alt data-[state=open]:bg-surface-alt focus:outline-none';
  $parents = $categoryList->filter(fn ($category) => $category->children->isNotEmpty());
@endphp

<nav
  {{ $block->editor_attributes }}
  aria-label="@lang('visual-debut::shop.main-navigation')"
  class="hidden h-full items-center lg:flex"
>
  <ui-navigation-menu id="{{ $menuId }}" class="relative">
    <ui-navigation-menu-list id="{{ $menuId }}-list">
      <ul class="text-on-background flex flex-1 list-none items-center justify-center space-x-2 rounded-md p-1.5">
        @foreach ($categoryList as $category)
          <li>
            @if ($category->children->isEmpty())
              <ui-navigation-menu-item value="{{ $category->id }}" delegate>
                <ui-navigation-menu-link delegate>
                  <a
                    id="{{ $menuId }}-link-{{ $category->id }}"
                    href="{{ $category->url }}"
                    class="{{ $itemClass }}"
                  >
                    {{ $category->name }}
                  </a>
                </ui-navigation-menu-link>
              </ui-navigation-menu-item>
            @else
              <ui-navigation-menu-item
                id="{{ $menuId }}-item-{{ $category->id }}"
                value="{{ $category->id }}"
              >
                <ui-navigation-menu-trigger delegate>
                  <button
                    id="{{ $menuId }}-trigger-{{ $category->id }}"
                    type="button"
                    class="{{ $itemClass }}"
                  >
                    {{ $category->name }}
                    @if ($block->settings->show_chevron)
                      <x-lucide-chevron-down class="h-4 w-4 transition-transform group-data-[state=open]:rotate-180" />
                    @endif
                  </button>
                </ui-navigation-menu-trigger>
                <ui-navigation-menu-trigger-proxy></ui-navigation-menu-trigger-proxy>
                <ui-navigation-menu-viewport-proxy></ui-navigation-menu-viewport-proxy>
              </ui-navigation-menu-item>
            @endif
          </li>
        @endforeach
      </ul>
    </ui-navigation-menu-list>

    @if ($parents->isNotEmpty())
      <ui-navigation-menu-viewport-positioner class="absolute left-0 top-full z-20 pt-1 translate-x-(--viewport-x) transition-transform duration-200">
        <ui-navigation-menu-viewport
          id="{{ $menuId }}-viewport"
          class="bg-surface border-on-surface/8 box relative h-(--viewport-height) w-(--viewport-width) origin-top overflow-hidden shadow transition-[width,height] duration-200 data-[state=closed]:animate-popover-out data-[state=open]:animate-popover-in"
        >
          @foreach ($parents as $category)
            @php
              $image = $category->logo_url ?? $category->banner_url;
              $categoryDescription = str(strip_tags($category->description ?? ''))
                  ->squish()
                  ->limit(150);
            @endphp
            <ui-navigation-menu-content
              id="{{ $menuId }}-content-{{ $category->id }}"
              value="{{ $category->id }}"
              presence
              @class([
                  'absolute inset-s-0 top-0 flex items-stretch gap-x-3 p-4 data-[state=closed]:animate-fade-out data-[state=open]:animate-fade-in',
                  'w-3xl' => $image,
                  'w-xl' => !$image,
              ])
            >
              @if ($image)
                <ui-navigation-menu-link delegate>
                  <a
                    href="{{ $category->url }}"
                    class="text-white box relative flex min-h-64 w-40 shrink-0 items-end overflow-hidden border-none p-4"
                  >
                    <img src="{{ $image }}" alt="" class="absolute inset-0 h-full object-cover brightness-50" loading="lazy" decoding="async">
                    <span class="relative space-y-1.5">
                      <span class="block text-lg font-bold">{{ $category->name }}</span>
                      <span class="text-white/80 block text-sm">{{ $categoryDescription }}</span>
                    </span>
                  </a>
                </ui-navigation-menu-link>
              @endif

              <div class="flex-1">
                <div class="grid grid-cols-2 gap-4">
                  @foreach ($category->children as $subCategory)
                    <div class="min-w-60">
                      <ui-navigation-menu-link delegate>
                        <a
                          href="{{ $subCategory->url }}"
                          class="hover:bg-surface-alt box block h-full border-none px-3.5 py-3 text-sm"
                        >
                          <span class="text-on-background mb-1 block font-semibold">
                            {{ $subCategory->name }}
                          </span>
                          @if ($subCategory->description)
                            <span class="text-on-background/70 block leading-5">
                              {{ str(strip_tags($subCategory->description ?? ''))->squish()->limit(70) }}
                            </span>
                          @endif
                        </a>
                      </ui-navigation-menu-link>
                    </div>
                  @endforeach
                </div>

                <ui-navigation-menu-link delegate>
                  <a
                    href="{{ $category->url }}"
                    class="text-primary hover:text-primary/80 mt-3 inline-flex items-center gap-1 px-3.5 py-2 text-sm font-medium"
                  >
                    @lang('visual-debut::shop.view-all', ['name' => $category->name])
                    <x-lucide-arrow-right class="h-4 w-4 rtl:rotate-180" />
                  </a>
                </ui-navigation-menu-link>
              </div>
            </ui-navigation-menu-content>
          @endforeach
        </ui-navigation-menu-viewport>
      </ui-navigation-menu-viewport-positioner>
    @endif
  </ui-navigation-menu>
</nav>
