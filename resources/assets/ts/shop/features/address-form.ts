import type { Alpine as AlpineType } from 'alpinejs';

type StatesByCountry = Record<string, { code: string; default_name: string }[]>;

interface Address {
  id?: number;
  company_name?: string;
  vat_id?: string;
  first_name: string;
  last_name: string;
  email: string;
  address: string[];
  country: string;
  state: string;
  city: string;
  postcode: string;
  phone: string;
  save_address?: boolean;
  use_for_shipping?: boolean;
  default_address?: boolean;
}

interface Props {
  selectedCountry?: string;
  statesByCountry?: StatesByCountry;
  name?: 'billingAddress' | 'shippingAddress';
  initialAddress?: Address;
  showAddressFields?: boolean;
}

export default function (Alpine: AlpineType) {
  Alpine.data('VisualAddressForm', (props: Props) => ({
    selectedCountry: props.selectedCountry ?? '',
    statesByCountry: props.statesByCountry ?? {},

    name: props.name ?? 'billingAddress',
    initialAddress: props.initialAddress,
    showAddressFields: props.showAddressFields ?? true,

    get states() {
      return this.statesByCountry[this.selectedCountry] ?? [];
    },

    get haveStates() {
      return this.states.length > 0;
    },

    fillAddressFields(address: Partial<Address>) {
      const newAddress: any = {};

      for (const key of Object.keys(this.initialAddress as any) as (keyof Address)[]) {
        newAddress[key] = address[key] ?? '';
      }

      this.selectedCountry = newAddress.country;
      this.$wire.set(this.name, newAddress, false);
    },

    resetInitialAddress() {
      this.fillAddressFields({ ...this.initialAddress });
    },

    clearAddressFields() {
      this.initialAddress = { ...this.$wire[this.name] };
      this.fillAddressFields({
        address: [],
        use_for_shipping: this.initialAddress?.use_for_shipping,
        save_address: this.initialAddress?.save_address,
      });
    },

    editAddress(address: Address) {
      this.fillAddressFields(address);
      this.showAddressFields = true;
    },

    addAddress() {
      this.showAddressFields = true;
      this.clearAddressFields();
    },

    cancelAddressFields() {
      this.showAddressFields = false;
      this.resetInitialAddress();
    },
  }));
}
