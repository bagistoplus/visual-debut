<div class="flex items-center justify-between border-t p-4">
  <p class="text-xs font-medium" x-text="paginationText"></p>
  <nav aria-label="@lang('shop::app.components.datagrid.table.page-navigation')" role="navigation">
    <div class="box inline-flex items-center overflow-hidden">
      <button
        class="text-on-background disabled:text-on-background/30 hover:bg-surface p-1.5 disabled:cursor-not-allowed disabled:hover:bg-transparent lg:p-2"
        x-bind:disabled="isFirstPage"
        x-on:click="changePage(currentPage - 1)"
      >
        <x-lucide-chevron-left class="h-4 w-4 rtl:rotate-180 rtl:transform" />
      </button>

      <template x-for="page in available.meta.last_page">
        <button
          class="data-active:text-primary text-on-background hover:bg-surface border-l px-2 py-1.5 text-sm lg:px-3"
          x-bind:data-active="currentPage === page"
          x-on:click="changePage(page)"
        >
          <span x-text="page"></span>
        </button>
      </template>

      <button
        class="text-on-background disabled:text-on-background/30 hover:bg-surface border-l p-1.5 disabled:cursor-not-allowed disabled:hover:bg-transparent lg:p-2"
        x-bind:disabled="isLastPage"
        x-on:click="changePage(currentPage + 1)"
      >
        <x-lucide-chevron-right class="h-4 w-4 rtl:rotate-180 rtl:transform" />
      </button>
    </div>
  </nav>
</div>
