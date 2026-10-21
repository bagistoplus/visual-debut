@php
  if (!isset($scrollTo)) {
      $scrollTo = 'body';
  }

  $scrollIntoViewJsSnippet = $scrollTo !== false ? "(\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()" : '';
@endphp

@if ($paginator->hasPages())
  <nav
    role="navigation"
    aria-label="{{ __('Pagination Navigation') }}"
    class="flex items-center justify-between"
  >
    <div class="flex flex-1 justify-between sm:hidden">
      @if ($paginator->onFirstPage())
        <span class="text text-neutral relative inline-flex cursor-default items-center rounded-md border bg-neutral-50 px-4 py-2 text-sm font-medium leading-5">
          {!! __('pagination.previous') !!}
        </span>
      @else
        <button
          type="button"
          href="{{ $paginator->previousPageUrl() }}"
          wire:click.prevent="previousPage('{{ $paginator->getPageName() }}')"
          x-on:click.prevent="{{ $scrollIntoViewJsSnippet }}"
          dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
          class="bg-surface text-on-surface border-on-surface/8 focus:ring-primary focus:border-primary hover:border-primary active:bg-surface-100 active:text-on-background relative inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none"
        >
          {!! __('pagination.previous') !!}
        </button>
      @endif

      @if ($paginator->hasMorePages())
        <button
          type="button"
          href="{{ $paginator->nextPageUrl() }}"
          wire:click.prevent="nextPage('{{ $paginator->getPageName() }}')"
          x-on:click.prevent="{{ $scrollIntoViewJsSnippet }}"
          dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
          class="bg-surface text-on-surface border-on-surface/8 focus:ring-primary focus:border-primary hover:border-primary active:bg-surface-100 active:text-on-background relative inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none"
        >
          {!! __('pagination.next') !!}
        </button>
      @else
        <span class="relative inline-flex cursor-default items-center rounded-md border bg-neutral-50 px-4 py-2 text-sm font-medium leading-5">
          {!! __('pagination.next') !!}
        </span>
      @endif
    </div>

    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm leading-5">
          {!! __('Showing') !!}
          @if ($paginator->firstItem())
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
          @else
            {{ $paginator->count() }}
          @endif
          {!! __('of') !!}
          <span class="font-medium">{{ $paginator->total() }}</span>
          {!! __('results') !!}
        </p>
      </div>

      <div>
        <span class="relative z-0 inline-flex gap-1.5 rounded-md">
          {{-- Previous Page Link --}}
          @if ($paginator->onFirstPage())
            <span
              role="button"
              aria-disabled="true"
              aria-label="{{ __('pagination.previous') }}"
            >
              <span class="text-on-background/50 hover:bg-surface-alt relative inline-flex cursor-default items-center rounded-md px-2 py-2 text-sm font-medium leading-5"
                aria-hidden="true"
              >
                <x-lucide-chevron-left class="h-4 w-4 rtl:rotate-180 rtl:transform" />
              </span>
            </span>
          @else
            <button
              rel="prev"
              type="button"
              href="{{ $paginator->previousPageUrl() }}"
              wire:click.prevent="previousPage('{{ $paginator->getPageName() }}')"
              x-on.prevent:click="{{ $scrollIntoViewJsSnippet }}"
              dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
              class="text-on-background/70 hover:bg-surface-alt active:bg-surface-alt-600 relative inline-flex items-center rounded-md px-2 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:z-10 focus:outline-none"
              aria-label="{{ __('pagination.previous') }}"
            >
              <x-lucide-chevron-left class="h-4 w-4 rtl:rotate-180 rtl:transform" />
            </button>
          @endif

          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
              <span aria-disabled="true">
                <span class="relative -ml-px inline-flex cursor-default items-center bg-neutral-50 px-4 py-2 text-sm font-medium leading-5">{{ $element }}</span>
              </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
              @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                  <span aria-current="page" wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                    <span
                      class="bg-primary text-on-primary relative inline-flex cursor-default items-center rounded-md px-4 py-2 text-sm font-medium leading-5">{{ $page }}</span>
                  </span>
                @else
                  <button
                    type="button"
                    href="{{ $url }}"
                    wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}"
                    wire:click.prevent="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                    x-on:click.prevent="{{ $scrollIntoViewJsSnippet }}"
                    class="text-on-background/70 hover:bg-surface-alt active:bg-surface-alt-600 active:text-on-background relative inline-flex items-center rounded-md px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:z-10 focus:outline-none"
                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                  >
                    {{ $page }}
                  </button>
                @endif
              @endforeach
            @endif
          @endforeach

          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
            <button
              rel="next"
              type="button"
              href="{{ $paginator->nextPageUrl() }}"
              wire:click.prevent="nextPage('{{ $paginator->getPageName() }}')"
              x-on:click.prevent="{{ $scrollIntoViewJsSnippet }}"
              dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
              class="text-on-background/70 hover:bg-surface-alt active:bg-surface-alt-600 relative inline-flex items-center rounded-md px-2 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:z-10 focus:outline-none"
              aria-label="{{ __('pagination.next') }}"
            >
              <x-lucide-chevron-right class="h-4 w-4 rtl:rotate-180 rtl:transform" />
            </button>
          @else
            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
              <span class="text-on-background/60 hover:bg-surface-alt relative inline-flex cursor-default items-center rounded-md px-2 py-2 text-sm font-medium leading-5"
                aria-hidden="true"
              >
                <x-lucide-chevron-right class="h-4 w-4 rtl:rotate-180 rtl:transform" />
              </span>
            </span>
          @endif
        </span>
      </div>
    </div>
  </nav>
@endif
