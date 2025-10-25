@extends('shop::layouts.default')

@section('body')
  <div class="min-h-screen">
    <visual:section name="visual-debut::breadcrumbs" />

    <div class="mx-auto max-w-7xl px-4 sm:px-6 sm:py-8 lg:px-8">
      <div class="flex flex-col gap-8 lg:flex-row">
        <div class="lg:w-[300px] lg:flex-shrink-0" x-data="{
            menuOpen: false,
            activeMenu: '',

            init() {
                this.activeMenu = this.$el.querySelector('.active-menu').textContent.trim().replace(/\s+/g, ' ');
            }
        }">
          <div class="box my-4 md:hidden">
            <button x-on:click="menuOpen = !menuOpen" class="flex w-full items-center justify-between px-6 py-4">
              <div class="flex items-center gap-3">
                <x-lucide-menu class="text-primary h-5 w-5" />
                <span class="font-medium" x-text="activeMenu">Menu</span>
              </div>
              <x-lucide-chevron-down class="lucide-chevron-down h-5 w-5 transition-transform duration-200" x-bind:class="{ 'rotate-180': menuOpen }" />
            </button>
          </div>

          <div class="space-y-6 lg:block" x-bind:class="menuOpen ? 'block' : 'hidden'">
            <div class="bg-surface text-on-surface box p-6 shadow-sm">
              <div class="flex items-center gap-4">
                @if ($customer->image_url)
                  <img
                    src="{{ $customer->image_url }}"
                    alt="Profile"
                    class="h-10 w-10 overflow-hidden rounded-full object-cover"
                  />
                @else
                  <div class="bg-primary/10 flex h-12 w-12 items-center justify-center rounded-full">
                    <x-lucide-user class="text-primary h-6 w-6" />
                  </div>
                @endif
                <div>
                  <h3 class="font-medium">
                    {{ $customer->first_name }}
                    {{ $customer->last_name }}
                  </h3>
                  <p class="text-sm">
                    {{ $customer->email }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Account Navigation Menus -->
            @foreach (menu()->getItems('customer') as $menuItem)
              <div class="bg-surface text-on-surface rounded-lg p-4 shadow-sm">
                <div class="pb-5">
                  <p class="text-xl font-medium max-md:text-lg">
                    {{ $menuItem->getName() }}
                  </p>
                </div>

                <!-- Account Navigation Content -->
                @if ($menuItem->haveChildren())
                  <nav class="space-y-1">
                    @foreach ($menuItem->getChildren() as $subMenuItem)
                      <a class="{{ visual_is_menu_active($subMenuItem) ? 'active-menu bg-primary text-primary-50' : 'hover:bg-surface-600' }} group flex items-center justify-between rounded-lg px-4 py-3 transition-colors"
                        href="{{ $subMenuItem->getUrl() }}"
                      >
                        <div class="flex items-center gap-3">
                          <x-dynamic-component :component="$subMenuItem->getIcon()" class="h-5 w-5" />
                          <span>{{ $subMenuItem->getName() }}</span>
                        </div>
                        <x-lucide-chevron-right class="h-5 w-5 opacity-0 group-hover:opacity-100" />
                      </a>
                    @endforeach
                  </nav>
                @endif
              </div>
            @endforeach

            <form
              method="POST"
              action="{{ route('shop.customer.session.destroy') }}"
              class="mt-6"
            >
              @csrf
              @method('DELETE')
              <button type="submit"
                class="border-danger text-danger hover:bg-danger hover:text-danger-50 flex w-full items-center justify-center gap-2 rounded-lg border-2 px-4 py-3 transition-colors"
              >
                <x-lucide-log-out class="h-5 w-5" />
                @lang('visual-debut::shop.header.logout')
              </button>
            </form>
          </div>
        </div>

        <div class="flex-1">
          @visual_layout_content
        </div>
      </div>
    </div>
  </div>
@endsection
