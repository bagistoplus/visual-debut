<table class="w-full">
  <thead class="max-sm:hidden">
    <tr class="bg-surface border-on-surface/8 border-b">
      <template x-if="haveMassActions > 0">
        <th class="px-6 py-4 text-left">
          <input
            type="checkbox"
            x-bind:checked="applied.massActions.meta.mode === 'all'"
            x-on:change="toggleSelectAll()"
          >
        </th>
      </template>

      <template x-for="column in available.columns" x-bind:key="column.index">
        <template x-if="column.visibility">
          <th
            x-bind:class="column.sortable ? 'cursor-pointer' : ''"
            x-on:click="changeSort(column)"
            class="text-on-background whitespace-nowrap px-6 py-4 text-left align-middle text-sm font-medium"
          >
            <span x-text="column.label"></span>
            <template x-if="applied.sort.column === column.index">
              <x-lucide-chevron-down class="inline h-4 w-4" x-bind:class="{ 'transform rotate-180': applied.sort.order !== 'asc' }" />
            </template>
          </th>
        </template>
      </template>

      <template x-if="available.actions.length > 0">
        <th class="text-on-background px-6 py-4 align-middle text-sm font-medium">
          @lang('shop::app.components.datagrid.table.actions')
        </th>
      </template>
    </tr>
  </thead>

  <tbody class="divide-surface-alt-600 sm:divide-y">
    <template x-if="haveRecords">
      <template x-for="(record, index) in available.records" x-bind:key="recordKey(record) ?? index">
        <tr x-bind:data-selected="isRecordSelected(record) ? 'true' : 'false'" class="hover:bg-surface max-sm:mb-4 max-sm:block max-sm:rounded max-sm:border">
          <template x-if="haveMassActions">
            <td class="px-6 py-4 text-left max-sm:block">
              <input
                type="checkbox"
                x-bind:checked="isRecordSelected(record)"
                x-bind:value="recordKey(record)"
                x-on:change="toggleRecordSelection(record)"
              >
            </td>
          </template>

          <template x-for="column in available.columns" x-bind:key="column.index">
            <template x-if="column.visibility">
              <td
                class="max-sm:before:text-on-background px-2 py-1 max-sm:flex max-sm:justify-between max-sm:before:pr-2 max-sm:before:text-sm max-sm:before:font-semibold max-sm:before:content-[attr(data-label)] sm:px-6 sm:py-4"
                x-bind:data-label="column.label"
              >
                <span x-html="record[column.index]"></span>
              </td>
            </template>
          </template>

          <template x-if="available.actions.length > 0">
            <td
              class="max-sm:before:text-on-background px-2 py-1 max-sm:flex max-sm:justify-between max-sm:before:text-sm max-sm:before:font-semibold max-sm:before:content-[attr(data-label)] sm:px-6 sm:py-4"
              data-label="@lang('shop::app.components.datagrid.table.actions')"
            >
              <div class="flex justify-center gap-2">
                <template x-for="action in record.actions">
                  <x-shop::ui.button
                    size="xs"
                    variant="ghost"
                    color="secondary"
                    x-on:click="handleAction(action)"
                  >
                    <span class="inline-block h-4 w-4" x-bind:class="action.icon"></span>
                    <span x-text="!action.icon ? action.title : ''"></span>
                  </x-shop::ui.button>
                </template>
              </div>
            </td>
          </template>
        </tr>
      </template>
    </template>
  </tbody>
</table>
