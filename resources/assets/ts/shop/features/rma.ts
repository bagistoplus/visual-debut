import type { Alpine as AlpineType } from 'alpinejs';

interface RowAction {
  method: string;
}

interface RmaRow {
  rma_status_id: number | string;
  actions?: RowAction[];
}

interface ListProps {
  uncancelable: number[];
}

export default function (Alpine: AlpineType) {
  /**
   * The returns list. Before Bagisto 2.4.10 every row offers Cancel, even on a
   * request that is already solved or refunded, so the row's one POST action
   * is hidden here by the same rule Bagisto applies from 2.4.10.
   */
  Alpine.data('VisualRmaList', (props: ListProps) => ({
    rowActions(record: RmaRow) {
      const cancelable = !props.uncancelable.includes(Number(record.rma_status_id));

      return (record.actions ?? []).filter((action) => action.method.toUpperCase() !== 'POST' || cancelable);
    },
  }));
}
