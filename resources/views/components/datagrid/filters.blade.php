<x-shop::ui.drawer id="datagrid-filters-drawer" {{ $attributes }} :title="trans('shop::app.components.datagrid.toolbar.filter.apply-filter')">
  <x-slot:trigger>
    <x-shop::ui.button
      icon="lucide-filter"
      color="secondary"
      variant="outline"
      size="sm"
    >
      @lang('shop::app.components.datagrid.toolbar.filter.title')
    </x-shop::ui.button>
  </x-slot:trigger>

  <div class="h-full space-y-4 overflow-y-auto border-t p-4">
    <template x-for="column in available.columns" x-bind:key="column.index">
      <template x-if="column.filterable">
        <div>
          <!-- Filter Label and Clear All Button -->
          <div class="mb-1 flex items-center justify-between">
            <label class="text-on-background text-sm font-medium" x-html="column.label"></label>
            <x-shop::ui.button
              variant="link"
              size="xs"
              x-show="hasAnyAppliedColumnValues(column.index)"
              x-on:click="removeAppliedColumnAllValues(column.index)"
            >
              @lang('shop::app.components.datagrid.toolbar.filter.custom-filters.clear-all')
            </x-shop::ui.button>
          </div>

          <!-- Date Filter -->
          <template x-if="column.type === 'date'">
            <div>
              <template x-if="column.filterable_type === 'date_range'">
                <div class="grid grid-cols-2 gap-1.5">
                  <template x-for="option in column.filterable_options">
                    <x-shop::ui.button
                      variant="outline"
                      color="neutral"
                      size="sm"
                      x-on:click="addQuickFilter(column, option)"
                    >
                      <span x-text="option.label"></span>
                    </x-shop::ui.button>
                  </template>
                  <x-shop::ui.form.input
                    type="date"
                    size="sm"
                    x-bind:placeholder="column.label"
                    x-on:change="addDateRangeFilter(column, $event.target.value, 'from')"
                  />
                  <x-shop::ui.form.input
                    type="date"
                    size="sm"
                    x-bind:placeholder="column.label"
                    x-on:change="addDateRangeFilter(column, $event.target.value, 'to')"
                  />
                </div>
              </template>

              <template x-if="column.filterable_type !== 'date_range'">
                <x-shop::ui.form.input
                  type="date"
                  size="sm"
                  x-bind:placeholder="column.label"
                  x-on:change="addFilter($event.target.value, column)"
                />
              </template>
            </div>
          </template>

          <!-- DateTime Filter -->
          <template x-if="column.type === 'datetime'">
            <div>
              <template x-if="column.filterable_type === 'datetime_range'">
                <div class="grid grid-cols-2 gap-1.5">
                  <template x-for="option in column.filterable_options">
                    <x-shop::ui.button
                      variant="outline"
                      color="neutral"
                      size="sm"
                      x-on:click="addQuickFilter(column, option)"
                    >
                      <span x-text="option.label"></span>
                    </x-shop::ui.button>
                  </template>
                  <x-shop::ui.form.input
                    type="datetime-local"
                    size="sm"
                    x-bind:placeholder="column.label"
                    x-on:change="addDateRangeFilter(column, $event.target.value, 'from')"
                  />
                  <x-shop::ui.form.input
                    type="datetime-local"
                    size="sm"
                    x-bind:placeholder="column.label"
                    x-on:change="addDateRangeFilter(column, $event.target.value, 'to')"
                  />
                </div>
              </template>

              <template x-if="column.filterable_type !== 'datetime_range'">
                <x-shop::ui.form.input
                  type="datetime-local"
                  size="sm"
                  x-bind:placeholder="column.label"
                  x-on:change="addFilter($event.target.value, column)"
                />
              </template>
            </div>
          </template>

          <!-- Other Filter Types -->
          <template x-if="!['date', 'datetime'].includes(column.type)">
            <div>
              <template x-if="column.filterable_type === 'dropdown'">
                <x-shop::ui.form.select size="sm" x-on:change="addFilter($event.target.value, column)">
                  <option
                    value=""
                    disabled
                    x-bind:selected="getAppliedColumnValues(column.index).length === 0"
                  >
                    @lang('shop::app.components.datagrid.toolbar.filter.dropdown.select')
                  </option>
                  <template x-for="option in column.filterable_options">
                    <option
                      x-text="option.label"
                      x-bind:value="option.value"
                      x-bind:selected="getAppliedColumnValues(column.index).includes(option.value)"
                    ></option>
                  </template>
                </x-shop::ui.form.select>
              </template>

              <template x-if="column.filterable_type !== 'dropdown'">
                <x-shop::ui.form.input
                  size="sm"
                  x-bind:placeholder="column.label"
                  x-on:blur="addFilter($event.target.value, column); $event.target.value = ''"
                  x-on:keyup.enter="addFilter($event.target.value, column); $event.target.value = ''"
                />
              </template>
            </div>
          </template>

          <!-- Display Applied Filter Values -->
          <div class="mt-2 flex flex-wrap gap-2">
            <template x-for="value in getAppliedColumnValues(column.index)" :key="value.toString()">
              <div class="bg-secondary text-on-secondary border-on-secondary/8 box inline-flex items-center gap-2 px-2 py-0.5 text-sm">
                <span x-text="getColumnValueLabel(column, value)"></span>
                <button class="hover:bg-secondary-400 rounded-full p-px" x-on:click="removeAppliedColumnValue(column.index, value)">
                  <x-lucide-x class="h-3 w-3" />
                </button>
              </div>
            </template>
          </div>
        </div>
      </template>
    </template>

    <div>
      <x-shop::ui.modal.close>
        <x-shop::ui.button
          class="w-full"
          x-bind:disabled="!isFilterDirty"
          x-on:click="applyFilters()"
        >
          @lang('shop::app.components.datagrid.toolbar.filter.apply-filter')
        </x-shop::ui.button>
      </x-shop::ui.modal.close>
    </div>
  </div>
</x-shop::ui.drawer>
