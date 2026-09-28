import type { Alpine as AlpineType } from 'alpinejs';
import { VisualEvents } from '@visual/shop/events';

type Action = 'cart' | 'wishlist' | 'compare';

interface Props {
  action: Action;
  productId: number;
  url: string;
  loggedIn?: boolean;
  inWishlist?: boolean;
  loginUrl?: string;
  messages: {
    failed: string;
    alreadyInCompare?: string;
    addedToCompare?: string;
  };
}

type BagistoResponse = {
  message?: string;
  data?: { message?: string };
  redirect_uri?: string;
  status?: number;
};

function responseMessage(body: BagistoResponse): string | undefined {
  return body.data?.message ?? body.message;
}

/**
 * The three card buttons, posting to Bagisto's rest api.
 */
export default function (Alpine: AlpineType) {
  Alpine.data('VisualProductAction', (props: Props) => ({
    pending: false,
    inWishlist: props.inWishlist ?? false,

    async handle() {
      if (this.pending) {
        return;
      }

      if (props.action === 'compare' && !props.loggedIn) {
        this.compareLocally();

        return;
      }

      if (props.action === 'wishlist' && !props.loggedIn) {
        window.location.assign(props.loginUrl ?? '/customer/login');

        return;
      }

      this.pending = true;

      try {
        const body =
          props.action === 'cart' ? { product_id: props.productId, quantity: 1 } : { product_id: props.productId };

        const response: BagistoResponse = await this.$request(props.url, 'POST', body);

        // Bagisto's wishlist endpoint toggles, and answers with a message alone.
        if (props.action === 'wishlist') {
          this.inWishlist = !this.inWishlist;
        }

        const message = responseMessage(response);

        if (message) {
          this.$toaster.success(message);
        }

        this.announce();
      } catch (error) {
        if (error instanceof Error) {
          this.$toaster.error(props.messages.failed);
          return;
        }

        const response = error as BagistoResponse;

        // A session that ended while the page was open.
        if (props.action === 'wishlist' && response.status === 401) {
          window.location.assign(props.loginUrl ?? '/customer/login');

          return;
        }

        // A product that needs options answers with the page to choose them on.
        if (response.redirect_uri) {
          window.location.assign(response.redirect_uri);

          return;
        }

        this.$toaster.error(responseMessage(response) ?? props.messages.failed);
      } finally {
        this.pending = false;
      }
    },

    /**
     * The header cart, the wishlist and the compare pages already listen for
     * these, so the button keeps the contract the Livewire components had.
     */
    announce() {
      const livewire = (window as Window & { Livewire?: { dispatch(name: string): void } }).Livewire;

      const event = {
        cart: VisualEvents.CART_UPDATED,
        wishlist: VisualEvents.WISHLIST_UPDATED,
        compare: VisualEvents.COMPARE_UPDATED,
      }[props.action];

      livewire?.dispatch(event);
    },

    /**
     * A guest keeps the compare list in the browser, as Bagisto's own theme does.
     */
    compareLocally() {
      const stored = JSON.parse(localStorage.getItem('compare_items') || '[]') as number[];

      if (stored.includes(props.productId)) {
        this.$toaster.warning(props.messages.alreadyInCompare ?? 'The product is already in compare list');

        return;
      }

      stored.push(props.productId);
      localStorage.setItem('compare_items', JSON.stringify(stored));

      this.$toaster.success(props.messages.addedToCompare ?? 'Successfully added product to compare list');
    },
  }));
}
