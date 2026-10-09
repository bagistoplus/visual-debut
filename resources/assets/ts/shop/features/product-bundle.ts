import type { Alpine as AlpineType } from 'alpinejs';

interface Product {
  id: number;
  name: string;
  qty: number;
  price: { final: { price: number } };
  is_default: boolean;
}

interface BundleOption {
  id: number;
  label: string;
  type: 'select' | 'radio' | 'checkbox' | 'multiselect';
  is_required: boolean;
  products: Product[];
}

interface Props {
  options?: BundleOption[];
}

export default function (Alpine: AlpineType) {
  Alpine.data('VisualProductBundle', (props: Props) => {
    return {
      options: props.options ?? [],
      selectedProducts: {} as Record<number, any>,
      quantities: {} as Record<number, number>,

      get totalPrice() {
        let total = 0;

        for (const option of this.options) {
          const selected = Array.isArray(this.selectedProducts[option.id])
            ? (this.selectedProducts[option.id] as number[])
            : [this.selectedProducts[option.id]];

          for (const product of option.products) {
            if (selected.includes(product.id)) {
              total += product.qty * product.price.final.price;
            }
          }
        }

        return total;
      },

      get formattedTotalPrice() {
        return (this as any).$formatPrice(this.totalPrice);
      },

      init() {
        this.options.forEach((option: BundleOption) => {
          const isMultiSelect = ['checkbox', 'multiselect'].includes(option.type);
          this.selectedProducts[option.id] = isMultiSelect ? [] : '';

          option.products.forEach((product: Product) => {
            if (product.is_default) {
              if (isMultiSelect) {
                (this.selectedProducts[option.id] as number[]).push(product.id);
              } else {
                this.selectedProducts[option.id] = product.id;
              }
            }
          });

          if (['select', 'radio'].includes(option.type)) {
            const selected = option.products.find((p: Product) => p.id === this.selectedProducts[option.id]);
            this.quantities[option.id] = selected ? selected.qty : 0;
          }
        });
      },

      optionHasSelection(option: BundleOption) {
        return option.products.some((product: Product) => this.productIsSelected(option.id, product.id));
      },

      productIsSelected(optionId: number, productId: number) {
        const selected = this.selectedProducts[optionId];
        return Array.isArray(selected) ? selected.includes(productId) : selected === productId;
      },

      onQuantityChange(optionId: number, quantity: number) {
        this.quantities[optionId] = quantity;

        const option = this.options.find((opt: BundleOption) => opt.id === optionId);
        const selected = option?.products.find((p: Product) => p.id === this.selectedProducts[optionId]);

        if (selected) {
          selected.qty = quantity;
        }

        this.$wire.set('bundleProductQuantities', this.quantities, false);
      },

      onSelectionChange(optionId: number) {
        const option = this.options.find((opt: BundleOption) => opt.id === optionId);

        if (option?.type === 'checkbox') {
          (this.$store.productForm as any).setDisabled((this.selectedProducts[optionId] as number[]).length === 0);
        }
      },
    };
  });
}
