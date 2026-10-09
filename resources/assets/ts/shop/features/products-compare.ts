import type { Alpine as AlpineType } from 'alpinejs';

interface Props {
  isUserLoggedIn?: boolean;
  messages?: {
    itemRemoved?: string;
    removeAll?: string;
  };
}

export default function (Alpine: AlpineType) {
  Alpine.data('VisualProductsCompare', (props: Props) => {
    const stored = localStorage.getItem('compare_items');
    const productIds: number[] = stored ? JSON.parse(stored) : [];

    return {
      productIds,
      isUserLoggedIn: props.isUserLoggedIn ?? false,

      messages: {
        itemRemoved: props.messages?.itemRemoved || 'Item successfully removed from compare list',
        removeAll: props.messages?.removeAll || 'Compare list successfully cleared',
      },

      init() {
        if (this.productIds.length > 0) {
          this.$wire.loadItems(this.productIds);
        }
      },

      removeItem(id: number) {
        if (this.isUserLoggedIn) {
          this.$wire.removeItem(id);
          return;
        }

        this.productIds = this.productIds.filter((pid) => pid !== id);
        localStorage.setItem('compare_items', JSON.stringify(this.productIds));
        this.$wire.loadItems(this.productIds);

        this.$toaster.success(this.messages.itemRemoved);
      },

      removeAllItems() {
        if (this.isUserLoggedIn) {
          this.$wire.removeAllItems();
          return;
        }

        localStorage.removeItem('compare_items');
        this.productIds = [];
        this.$wire.loadItems([]);

        this.$toaster.success(this.messages.removeAll);
      },
    };
  });
}
