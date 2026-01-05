import { defineComponent, setup } from 'alpine-define-component';

interface CustomizableOptionPrice {
  id: number;
  label: string | null;
  price: number;
  product_customizable_option_id: number;
  sort_order: number;
}

interface CustomizableOption {
  id: number;
  label: string;
  type: 'text' | 'textarea' | 'file' | 'select' | 'radio' | 'checkbox' | 'multiselect' | 'date' | 'datetime' | 'time';
  is_required: boolean;
  sort_order: number;
  max_characters?: string;
  supported_file_extensions?: string;
  price?: number;
  customizable_option_prices?: CustomizableOptionPrice[];
}

interface Props {
  options?: CustomizableOption[];
  basePrice?: number;
}

export default defineComponent({
  name: 'product-customizable',

  setup: setup((props: Props) => {
    return {
      options: props.options ?? [],
      selectedOptions: {} as Record<number, any>,
      basePrice: parseFloat(String(props.basePrice ?? 0)),
      errors: {} as Record<number, boolean>,
      validated: false,

      get totalPrice() {
        let total = this.basePrice;

        for (const option of this.options) {
          total += (this as any).calculateOptionPrice(option);
        }

        return total;
      },

      get formattedTotalPrice() {
        return (this as any).$formatPrice(this.totalPrice);
      },

      canHaveMultiplePriceOptions(type: string) {
        return ['checkbox', 'radio', 'select', 'multiselect'].includes(type);
      },

      validate(scrollToFirstInvalid = false) {
        this.validated = true;
        this.errors = {};
        let hasErrors = false;

        this.options.forEach((option: CustomizableOption) => {
          if (!option.is_required) {
            this.errors[option.id] = false;
            return;
          }

          const selected = this.selectedOptions[option.id];
          let isEmpty = false;

          if (Array.isArray(selected)) {
            isEmpty = selected.length === 0;
          } else {
            isEmpty = !selected || selected === '';
          }

          this.errors[option.id] = isEmpty;
          if (isEmpty) {
            hasErrors = true;
          }
        });

        if (hasErrors && scrollToFirstInvalid) {
          this.scrollToFirstInvalid();
        }

        return !hasErrors;
      },

      hasError(optionId: number) {
        return this.validated && this.errors[optionId] === true;
      },

      scrollToFirstInvalid() {
        (this as any).$nextTick(() => {
          const firstInvalid = document.querySelector('[data-invalid="true"]');

          if (firstInvalid) {
            firstInvalid.scrollIntoView({
              behavior: 'smooth',
              block: 'center',
              inline: 'nearest',
            });

            setTimeout(() => {
              (firstInvalid as HTMLElement).focus();
            }, 300);
          }
        });
      },

      init() {
        this.options = this.options.map((option: CustomizableOption) => {
          if (!this.canHaveMultiplePriceOptions(option.type)) {
            const price = option.customizable_option_prices?.[0]?.price || 0;
            return {
              ...option,
              price: parseFloat(String(price)),
            };
          }

          return option;
        });

        this.options.forEach((option: CustomizableOption) => {
          const isMultiSelect = ['checkbox', 'multiselect'].includes(option.type);
          this.selectedOptions[option.id] = isMultiSelect ? [] : '';
        });

        if (this.$store.productForm) {
          (this.$store.productForm as any).addValidator(() => this.validate(true));
        }

        this.$watch('selectedOptions', () => {
          if (this.validated) {
            const hasErrors = !this.validate(false);
            if (this.$store.productForm) {
              (this.$store.productForm as any).setDisabled(hasErrors);
            }
          }
        });
      },

      calculateOptionPrice(option: CustomizableOption) {
        let price = 0;
        const selected = this.selectedOptions[option.id];

        if (option.price && selected && !this.canHaveMultiplePriceOptions(option.type)) {
          price = parseFloat(String(option.price));
        }

        if (this.canHaveMultiplePriceOptions(option.type) && option.customizable_option_prices) {
          if (Array.isArray(selected)) {
            selected.forEach((priceId: number) => {
              const priceData = option.customizable_option_prices!.find((p) => p.id === priceId);
              if (priceData) {
                price += parseFloat(String(priceData.price));
              }
            });
          } else if (selected) {
            const priceData = option.customizable_option_prices!.find((p) => p.id === selected);
            if (priceData) {
              price = parseFloat(String(priceData.price));
            }
          }
        }

        return price;
      },
    };
  }),
});
