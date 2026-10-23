import type { Alpine as AlpineType } from 'alpinejs';
import { VisualEvents } from '@visual/shop/events';
import { ProductForm } from './product-form';

interface VariantAttribute {
  id: number;
  label: string;
  swatch_type?: string;
  options: VariantOption[];
}

interface VariantOption {
  id: number;
  label: string;
  swatch_value?: string;
  products: number[];
  isAvailable?: boolean;
}

interface Props {
  variantAttributes?: VariantAttribute[];
  variantPrices?: Record<number, any>;
  variantImages?: Record<number, string[]>;
  variantVideos?: Record<number, string[]>;
}

export default function (Alpine: AlpineType) {
  Alpine.data('VisualVariantPicker', (props: Props) => {
    const variantAttributes = props.variantAttributes ?? [];
    const variantPrices = props.variantPrices ?? {};
    const variantImages = props.variantImages ?? {};
    const variantVideos = props.variantVideos ?? {};

    const selections: Record<number, number> = {};
    const matchingProducts = new Set<number>();

    let onCartUpdated: () => void;

    return {
      variantAttributes,
      variantPrices,
      variantImages,
      variantVideos,

      selections,
      matchingProducts,

      get selectedVariant() {
        // Only return a variant if all attributes have a selection
        if (Object.keys(this.selections).length !== this.variantAttributes.length) {
          return null;
        }

        const [variantId] = this.matchingProducts;

        return variantId ?? null;
      },

      findAttribute(id: number) {
        return this.variantAttributes.find((attr: VariantAttribute) => attr.id === id);
      },

      findOption(attribute: VariantAttribute | undefined, optionId: number) {
        return attribute?.options.find((o: VariantOption) => o.id === optionId);
      },

      isAvailable(attributeId: number, optionId: number) {
        return this.findOption(this.findAttribute(attributeId), optionId)?.isAvailable !== false;
      },

      findMatchingProducts(selections: Record<number, number>) {
        const products = new Set<number>();
        let isFirst = true;

        for (const [id, value] of Object.entries(selections)) {
          const attr = this.findAttribute(Number(id));
          const option = this.findOption(attr, value);

          if (!option) return new Set();

          if (isFirst) {
            option.products.forEach((p: number) => products.add(p));
            isFirst = false;
          } else {
            for (const p of Array.from(products)) {
              if (!option.products.includes(p)) products.delete(p);
            }
          }
        }

        return products;
      },

      updateMatchingProducts() {
        this.matchingProducts = this.findMatchingProducts(this.selections) as Set<number>;
        this.updateOptionAvailability();
      },

      updateOptionAvailability() {
        for (const attr of this.variantAttributes) {
          for (const option of attr.options) {
            const otherSelections = { ...this.selections };
            delete otherSelections[attr.id];

            // If no other selections, all options are available
            if (Object.keys(otherSelections).length === 0) {
              option.isAvailable = true;
              continue;
            }

            // Check if this option is compatible with other selections
            const matching = this.findMatchingProducts(otherSelections);
            option.isAvailable = option.products.some((id: number) => matching.has(id));
          }
        }
      },

      onOptionSelected(attributeId: number, value: number | null) {
        value = Number.isNaN(Number(value)) ? null : Number(value);

        if (value === null || this.selections[attributeId] === value) {
          // Unselect
          delete this.selections[attributeId];
        } else {
          this.selections[attributeId] = value;
        }

        if (this.$wire) {
          this.$wire.set('variantAttributes', this.selections, false);
        }

        this.updateMatchingProducts();
        this.dispatchChange();
      },

      /**
       * Dispatches from the root. Called from an option's handler, `this.$dispatch` would fire on
       * that option instead, and a `change` from the select would re-enter its own handler.
       */
      emit(name: string, detail: unknown) {
        this.$root.dispatchEvent(new CustomEvent(name, { detail, bubbles: true, composed: true, cancelable: true }));
      },

      dispatchChange() {
        const [variantId] = this.matchingProducts;

        this.emit('change', {
          selections: { ...this.selections },
          matchingProducts: Array.from(this.matchingProducts),
        });

        this.emit('variant-medias-change', {
          images: variantId ? this.variantImages[variantId] : [],
          videos: variantId ? this.variantVideos[variantId] : [],
        });

        this.emit('product-variant-change', {
          variant: this.selectedVariant,
          ...(this.selectedVariant && {
            prices: this.variantPrices[this.selectedVariant],
            images: this.variantImages[this.selectedVariant],
            videos: this.variantVideos[this.selectedVariant],
          }),
        });

        (this.$store.productForm as ProductForm).setDisabled(!this.selectedVariant);

        if (this.$wire) {
          this.$wire.set('selectedVariant', this.selectedVariant, false);
        }
      },

      init() {
        this.updateMatchingProducts();

        // The buy buttons wait for a full selection, as they do when the shopper clears one
        (this.$store.productForm as ProductForm).setDisabled(!this.selectedVariant);

        if (this.$wire) {
          this.$wire.set('variantAttributes', this.selections, false);
          this.$wire.set('selectedVariant', this.selectedVariant, false);
        }

        onCartUpdated = () => {
          this.$nextTick(() => {
            this.dispatchChange();
          });
        };

        document.addEventListener(VisualEvents.CART_UPDATED, onCartUpdated);
      },

      destroy() {
        document.removeEventListener(VisualEvents.CART_UPDATED, onCartUpdated);
      },
    };
  });
}
