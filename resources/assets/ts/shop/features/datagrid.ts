import type { Alpine as AlpineType } from 'alpinejs';

interface Column {
  index: string;
  label: string;
  visibility: boolean;
  sortable: boolean;
  filterable: boolean;
  type: 'string' | 'number' | 'boolean' | 'date' | 'datetime';
  filterable_type?: 'dropdown' | 'text' | 'date_range' | 'datetime_range';
  filterable_options?: { label: string; value: any; name?: string }[]; // name for date ranges
  allow_multiple_values?: boolean;
}

interface Action {
  title: string;
  url: string;
  method: string;
  icon?: string;
}

interface MassAction extends Action {
  options?: Array<{ label: string; value: any }>;
}

interface DataGridMeta {
  current_page: number;
  from: number;
  to: number;
  last_page: number;
  total: number;
  per_page: number;
  per_page_options: number[];
  primary_column: string;
}

interface AppliedFilter {
  index: string;
  label?: string;
  type?: string;
  value: any | any[];
  allow_multiple_values?: boolean;
}

interface ItemRecord {
  [key: string]: any; // Data for each column index
  actions?: Action[]; // Row-specific actions
}

interface Messages {
  pagination: {
    showing: string;
    to: string;
    of: string;
  };
  results: string;
}

interface Props {
  src?: string;
  messages?: Partial<Messages>;
}

export default function (Alpine: AlpineType) {
  Alpine.data('VisualDatagrid', (props: Props) => {
    return {
      src: props.src || '',
      isLoading: false,
      isFilterDirty: false,

      messages: {
        pagination: { showing: 'Showing :firstItem', to: 'to :lastItem', of: 'of :total' },
        results: ':total results',
        ...props.messages,
      },

      available: {
        id: null as string | null,
        columns: [] as Column[],
        actions: [] as Action[],
        massActions: [] as MassAction[],
        records: [] as ItemRecord[],
        meta: {} as DataGridMeta,
      },

      applied: {
        massActions: {
          meta: {
            mode: 'none' as 'none' | 'all' | 'partial',
            action: null as MassAction | null,
          },
          indices: [] as number[],
          value: null,
        },
        pagination: {
          page: 1,
          perPage: 10,
        },
        sort: {
          column: null as string | null,
          order: null as 'asc' | 'desc' | null,
        },
        filters: {
          columns: [
            {
              index: 'all',
              value: [] as any[],
            } as AppliedFilter,
          ] as AppliedFilter[],
        },
      },

      // Computed properties
      get haveRecords() {
        return this.available.records.length > 0;
      },

      get haveMassActions() {
        return this.available.massActions.length > 0;
      },

      get haveSelection() {
        return this.applied.massActions.indices.length > 0;
      },

      get totalResultsText() {
        return this.messages.results.replace(':total', (this.available.meta.total ?? 0).toString());
      },

      get searchValue() {
        return this.findAppliedColumn('all')?.value?.[0] ?? '';
      },

      get pageSizeOptions() {
        return this.available.meta.per_page_options || [10, 25, 50, 100];
      },

      get currentPage() {
        return this.applied.pagination.page;
      },

      get isFirstPage() {
        return this.currentPage <= 1;
      },

      get isLastPage() {
        return this.currentPage >= (this.available.meta.last_page ?? 0);
      },

      get paginationText() {
        return [
          this.messages.pagination.showing.replace(':firstItem', this.available.meta.from?.toString()),
          this.messages.pagination.to.replace(':lastItem', this.available.meta.to?.toString()),
          this.messages.pagination.of.replace(':total', this.available.meta.total?.toString()),
        ].join(' ');
      },

      init() {
        this.loadSavedState();
        this.applyUrlParams();
        this.setupWatchers();

        this.fetchData();
      },

      loadSavedState() {
        const datagrids = this.getFromStorage('datagrids') || [];
        const url = this.src.split('?')[0];
        const savedGrid = datagrids.find((grid: any) => grid.src === url);

        if (savedGrid?.applied) {
          if (savedGrid.applied.sort) {
            this.applied.sort = { ...this.applied.sort, ...savedGrid.applied.sort };
          }

          if (savedGrid.applied.pagination) {
            this.applied.pagination = { ...this.applied.pagination, ...savedGrid.applied.pagination };
          }

          if (savedGrid.applied.filters) {
            this.applied.filters = { ...this.applied.filters, ...savedGrid.applied.filters };
          }
        }
      },

      applyUrlParams() {
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('search')) {
          const searchValue = urlParams.get('search')!;
          const searchColumn = this.findAppliedColumn('all');

          if (searchColumn) {
            searchColumn.value = [searchValue];
          } else {
            this.applied.filters.columns.push({ index: 'all', value: [searchValue] });
          }
        }
      },

      setupWatchers() {
        this.$watch('applied.massActions.indices', () => {
          this.setCurrentSelectionMode();
        });

        this.$watch('available.records', () => {
          this.setCurrentSelectionMode();
          this.updateDatagrids();
          this.notifyExportComponent();
        });
      },

      // Filter utilities
      findAppliedColumn(index: string) {
        return this.applied.filters.columns.find((column: AppliedFilter) => column.index === index);
      },

      hasAnyAppliedColumnValues(index: string) {
        const appliedColumn = this.findAppliedColumn(index);
        return appliedColumn ? this.hasAnyValue(appliedColumn) : false;
      },

      hasAnyValue(column: AppliedFilter) {
        return column.allow_multiple_values ? column.value.length > 0 : !!column.value;
      },

      getAppliedColumnValues(columnIndex: string) {
        const appliedColumn = this.findAppliedColumn(columnIndex);

        if (!appliedColumn || !this.hasAnyValue(appliedColumn)) {
          return [];
        }

        return Array.isArray(appliedColumn.value) ? appliedColumn.value : [appliedColumn.value];
      },

      removeAppliedColumnValue(columnIndex: string, value: any) {
        const appliedColumn = this.findAppliedColumn(columnIndex);

        if (!appliedColumn) {
          return;
        }

        if (['date', 'datetime'].includes(appliedColumn.type as string)) {
          appliedColumn.value = [];
        } else if (appliedColumn.allow_multiple_values) {
          if (Array.isArray(appliedColumn.value)) {
            appliedColumn.value = appliedColumn.value.filter((v: any) => v !== value);
          } else {
            appliedColumn.value = [];
          }
        } else {
          appliedColumn.value = '';
        }

        if (!appliedColumn.value?.length) {
          this.applied.filters.columns = this.applied.filters.columns.filter(
            (column: AppliedFilter) => column.index !== columnIndex
          );
        }

        this.isFilterDirty = true;
      },

      removeAppliedColumnAllValues(columnIndex: string) {
        this.applied.filters.columns = this.applied.filters.columns.filter(
          (column: AppliedFilter) => column.index !== columnIndex
        );
        this.isFilterDirty = true;
      },

      getColumnValueLabel(column: Column, value: any) {
        if (column.filterable_options!.length > 0) {
          const option = column.filterable_options!.find((option) => {
            if (
              ['date_range', 'datetime_range'].includes(column.filterable_type!) ||
              (['date', 'datetime'].includes(column.type) && typeof value === 'string')
            ) {
              return option.name === value;
            }

            if (column.filterable_type === 'dropdown') {
              return option.value === value;
            }

            return false;
          });

          return option?.label ?? value;
        }

        return value;
      },

      // Filter & search handlers
      updateGlobalSearch(value: string) {
        let searchColumn = this.findAppliedColumn('all');

        if (searchColumn) {
          searchColumn.value = value ? [value] : [];
        } else if (value) {
          this.applied.filters.columns.unshift({
            index: 'all',
            value: [value],
          } as AppliedFilter);
        }

        this.applied.pagination.page = 1;
        this.fetchData();
      },

      addQuickFilter(column: Column, option: NonNullable<Column['filterable_options']>[number]) {
        this.addFilter(option.name, column, { quickFilter: option });
      },

      addDateRangeFilter(column: Column, value: any, rangeName: 'from' | 'to') {
        this.addFilter(value, column, { range: { name: rangeName } });
      },

      addFilter(value: any, column: Column | null = null, additional: any = {}) {
        if (additional.quickFilter && ['date', 'datetime'].includes(column?.type as string)) {
          this.applyColumnValues(column!, value);
          return;
        }

        this.applyColumnValues(column!, value, additional);
      },

      applyColumnValues(column: Column, requestedValue: any, additional: any = {}) {
        if (!column) {
          return;
        }

        const appliedColumn = this.findAppliedColumn(column.index);
        if (this.shouldSkipValue(appliedColumn, requestedValue)) {
          return;
        }

        if (['date', 'datetime'].includes(column.type as string)) {
          this.handleDateFilter(column, appliedColumn, requestedValue, additional.range);
        } else {
          this.updateOrCreateColumn(column, appliedColumn, requestedValue);
        }

        this.isFilterDirty = true;
      },

      handleDateFilter(column: Column, appliedColumn: AppliedFilter | undefined, value: any, range: any) {
        if (!range) {
          this.updateOrCreateColumn(column, appliedColumn, value);
          return;
        }

        let rangeValues = ['', ''];
        if (appliedColumn && Array.isArray(appliedColumn.value)) {
          rangeValues = [...appliedColumn.value[0]];
        }

        if (range.name === 'from') {
          rangeValues[0] = value;
        }

        if (range.name === 'to') {
          rangeValues[1] = value;
        }

        this.updateOrCreateColumn(column, appliedColumn, [rangeValues]);
      },

      updateOrCreateColumn(column: Column, appliedColumn: AppliedFilter | undefined, value: any) {
        const isDateType = ['date', 'datetime'].includes(column.type as string);
        const shouldBeArray = !isDateType && column.allow_multiple_values;

        if (appliedColumn) {
          if (shouldBeArray && !Array.isArray(value)) {
            appliedColumn.value.push(value);
          } else {
            appliedColumn.value = value;
          }
        } else {
          const formattedValue = shouldBeArray && !Array.isArray(value) ? [value] : value;

          this.applied.filters.columns.push({
            index: column.index,
            label: column.label,
            type: column.type,
            value: formattedValue,
            allow_multiple_values: column.allow_multiple_values,
          } as AppliedFilter);
        }
      },

      shouldSkipValue(appliedColumn: AppliedFilter | undefined, requestedValue: any) {
        if (!requestedValue) {
          return true;
        }

        if (appliedColumn?.allow_multiple_values) {
          return appliedColumn.value.includes(requestedValue);
        } else {
          return appliedColumn?.value === requestedValue;
        }
      },

      applyFilters() {
        this.applied.pagination.page = 1;
        this.isFilterDirty = false;
        this.fetchData();
      },

      // Sorting
      changeSort(column: Column) {
        if (!column.sortable) return;

        this.applied.sort.column = column.index;
        this.applied.sort.order = this.applied.sort.order === 'asc' ? 'desc' : 'asc';

        this.applied.pagination.page = 1;
        this.fetchData();
      },

      // Pagination handler
      changePagination(perPage: number) {
        this.applied.pagination.perPage = perPage;

        this.applied.pagination.page = 1;

        this.fetchData();
      },

      changePage(page: number) {
        if (page === this.applied.pagination.page) {
          return;
        }

        this.applied.pagination.page = page;
        this.fetchData();
      },

      // Data fetching
      fetchData() {
        this.isLoading = true;
        this.$request(this.src, 'GET', this.buildRequestParams())
          .then((data) => {
            Object.assign(this.available, {
              id: data.id,
              columns: data.columns,
              actions: data.actions,
              massActions: data.mass_actions,
              records: data.records,
              meta: data.meta,
            });
          })
          .finally(() => {
            this.isLoading = false;
          });
      },

      buildRequestParams() {
        const params: {
          pagination: {
            page: number;
            per_page: number;
          };
          sort: {
            column?: string | null;
            order?: 'asc' | 'desc' | null;
          };
          filters: Record<string, any>;
        } = {
          pagination: {
            page: this.applied.pagination.page,
            per_page: this.applied.pagination.perPage,
          },
          sort: {},
          filters: {},
        };

        if (this.applied.sort.column && this.applied.sort.order) {
          params.sort = this.applied.sort;
        }

        this.applied.filters.columns.forEach((column) => {
          params.filters[column.index] = column.value;
        });

        return params;
      },

      // A list's own x-data can override these to hide a column or add row actions
      columnVisible(column: Column) {
        return column.visibility;
      },

      hasRowActions() {
        return this.available.actions.length > 0;
      },

      clampColumn(_column: Column) {
        return false;
      },

      rowActions(record: ItemRecord) {
        return record.actions ?? [];
      },

      // Mass actions (bulk operations)
      recordKey(record: ItemRecord) {
        return record[this.available.meta.primary_column];
      },

      isRecordSelected(record: ItemRecord) {
        return this.applied.massActions.indices.includes(this.recordKey(record));
      },

      toggleRecordSelection(record: ItemRecord) {
        const id = this.recordKey(record);
        const indices = this.applied.massActions.indices;

        this.applied.massActions.indices = indices.includes(id) ? indices.filter((i) => i !== id) : [...indices, id];
      },

      toggleSelectAll() {
        const primaryColumn = this.available.meta.primary_column!;
        const currentMode = this.applied.massActions.meta.mode;
        const currentIds = this.available.records.map((record: ItemRecord) => record[primaryColumn]);

        if (currentMode === 'none') {
          this.applied.massActions.indices = [...this.applied.massActions.indices, ...currentIds];
          this.applied.massActions.meta.mode = 'all';
        } else {
          this.applied.massActions.indices = this.applied.massActions.indices.filter(
            (id: number) => !currentIds.includes(id)
          );
          this.applied.massActions.meta.mode = 'none';
        }
      },

      setCurrentSelectionMode() {
        this.applied.massActions.meta.mode = 'none';

        if (this.available.records.length === 0) return;

        const primaryColumn = this.available.meta.primary_column!;
        const selectedCount = this.available.records.filter((record: ItemRecord) =>
          this.applied.massActions.indices.includes(record[primaryColumn])
        ).length;

        if (selectedCount > 0) {
          this.applied.massActions.meta.mode = selectedCount === this.available.records.length ? 'all' : 'partial';
        }
      },

      handleAction(action: Action) {
        const method = action.method.toLowerCase();

        if (['post', 'put', 'patch', 'delete'].includes(method)) {
          this.$triggerConfirm({
            onConfirm: () => {
              this.$request(action.url, method as any)
                .then((data) => {
                  this.$toaster.success(data.message);
                  this.fetchData();
                })
                .catch((error) => {
                  if (error.message) {
                    this.$toaster.error(error.message);
                  }
                });
            },
          });
        } else if (method === 'get') {
          window.location.href = action.url;
        } else {
          console.error('Method not supported.');
        }
      },

      handleMassAction(action: MassAction, option: any = null) {
        this.applied.massActions.meta.action = action;
        this.applied.massActions.value = option ? option.value : null;

        if (!this.validateMassAction()) {
          return;
        }

        const method = action.method.toLowerCase();

        this.$triggerConfirm({
          onConfirm: () => {
            if (['post', 'put', 'patch', 'delete'].includes(method)) {
              const params: { indices: number[]; value?: any } = {
                indices: this.applied.massActions.indices,
              };

              if (method !== 'delete') {
                params.value = this.applied.massActions.value;
              }

              this.$request(action.url, method as any, params)
                .then((data: any) => {
                  this.$toaster.success(data.message);
                  this.fetchData();
                })
                .catch((error: any) => {
                  if (error.message) {
                    this.$toaster.error(error.message);
                  }
                });
            } else {
              console.error('Method not supported.');
            }
          },
        });
      },

      validateMassAction() {
        if (!this.applied.massActions.indices.length) {
          this.$toaster.warning('No records selected');
          return false;
        }

        if (!this.applied.massActions.meta.action) {
          this.$toaster.warning('Must select a mass action');
          return false;
        }

        if (this.applied.massActions.meta.action?.options?.length && this.applied.massActions.value === null) {
          this.$toaster.warning('Must select a mass action option');
          return false;
        }

        return true;
      },

      // Storage & notifications
      saveToStorage(key: string, value: any) {
        localStorage.setItem(key, JSON.stringify(value));
      },

      getFromStorage(key: string) {
        const value = localStorage.getItem(key);
        return value ? JSON.parse(value) : null;
      },

      updateDatagrids() {
        let datagrids = this.getFromStorage('datagrids') || [];
        const src = this.src.split('?')[0];
        const gridData = {
          src,
          requestCount: 0,
          available: this.available,
          applied: this.applied,
        };

        const existingIndex = datagrids.findIndex((grid: { src: string }) => grid.src === src);

        if (existingIndex >= 0) {
          gridData.requestCount = datagrids[existingIndex].requestCount + 1;
          datagrids[existingIndex] = gridData;
        } else {
          datagrids.push(gridData);
        }

        this.saveToStorage('datagrids', datagrids);
      },

      notifyExportComponent() {
        document.dispatchEvent(
          new CustomEvent('change-datagrid', {
            detail: {
              available: this.available,
              applied: this.applied,
            },
          })
        );
      },
    };
  });
}
