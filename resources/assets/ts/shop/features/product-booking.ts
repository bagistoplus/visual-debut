import type { Alpine as AlpineType } from 'alpinejs';
import type { ProductForm } from './product-form';

interface BookingSlot {
  from: string;
  to: string;
  timestamp: string;
}

type SlotsStatus = 'idle' | 'loading' | 'ready' | 'empty' | 'failed';

interface EventTicket {
  id: number;
  name: string;
  price: number;
}

interface BookingEventProps {
  tickets: EventTicket[];
  basePrice: number;
  messages: { ticketLine: string; feeLine: string };
}

interface SummaryLine {
  id: number;
  label: string;
  amount: string;
}

interface BookingSlotsProps {
  slotsUrl: string;
  availableFrom: string | null;
  availableTo: string | null;
  messages: { loading: string; empty: string; failed: string };
}

/**
 * A date as the native date input writes it, in the shopper's own calendar.
 */
function isoDate(date: Date): string {
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');

  return `${date.getFullYear()}-${month}-${day}`;
}

/**
 * Fills a translated line such as ':name × :count'.
 */
function fill(template: string, values: Record<string, string | number>): string {
  return Object.entries(values).reduce((text, [key, value]) => text.replace(`:${key}`, String(value)), template);
}

export default function (Alpine: AlpineType) {
  /**
   * A booking taken as one slot on one day: default and appointment booking
   * products. Bagisto lists the free slots of a day on request.
   */
  Alpine.data('VisualBookingSlots', (props: BookingSlotsProps) => ({
    date: '',
    slot: '',
    slots: [] as BookingSlot[],
    status: 'idle' as SlotsStatus,
    showErrors: false,
    request: 0,

    // Worked out here rather than on the server, which may serve a cached page
    get minDate(): string {
      const today = isoDate(new Date());

      return props.availableFrom && props.availableFrom > today ? props.availableFrom : today;
    },

    get maxDate(): string {
      return props.availableTo ?? '';
    },

    get statusMessage(): string {
      switch (this.status) {
        case 'loading':
          return props.messages.loading;
        case 'empty':
          return props.messages.empty;
        case 'failed':
          return props.messages.failed;
        default:
          return '';
      }
    },

    init() {
      (this.$store.productForm as ProductForm).addValidator(() => this.validate());

      this.$watch('slot', () => {
        this.sync();

        if (this.showErrors) {
          this.validate();
        }
      });
    },

    async loadSlots() {
      this.slot = '';
      this.slots = [];

      if (!this.date) {
        this.status = 'idle';

        return;
      }

      // Only the answer for the latest date counts
      const request = ++this.request;
      this.status = 'loading';

      try {
        const response = await this.$request(props.slotsUrl, 'GET', { date: this.date });

        if (request !== this.request) return;

        this.slots = Object.values(response?.data ?? {});
        this.status = this.slots.length ? 'ready' : 'empty';
      } catch {
        if (request === this.request) {
          this.status = 'failed';
        }
      }
    },

    sync() {
      this.$wire.set('booking', this.slot ? { date: this.date, slot: this.slot } : [], false);
    },

    validate(): boolean {
      this.showErrors = !this.date || !this.slot;

      return !this.showErrors;
    },
  }));

  /**
   * An event: tickets bought by the number. Bagisto charges each ticket its
   * own price plus the product's, so the total counts the product once per
   * ticket. Prices arrive in the shop's currency.
   */
  Alpine.data('VisualBookingEvent', (props: BookingEventProps) => ({
    quantities: {} as Record<number, number>,
    showErrors: false,

    get count(): number {
      return Object.values(this.quantities).reduce((sum, quantity) => sum + quantity, 0);
    },

    get lines(): SummaryLine[] {
      return props.tickets
        .filter((ticket) => (this.quantities[ticket.id] ?? 0) > 0)
        .map((ticket) => ({
          id: ticket.id,
          label: fill(props.messages.ticketLine, { name: ticket.name, count: this.quantities[ticket.id] }),
          amount: this.$formatPrice(ticket.price * this.quantities[ticket.id]),
        }));
    },

    get fee(): SummaryLine | null {
      if (props.basePrice <= 0 || this.count === 0) return null;

      return {
        id: 0,
        label: fill(props.messages.feeLine, { count: this.count }),
        amount: this.$formatPrice(props.basePrice * this.count),
      };
    },

    get total(): string {
      const tickets = props.tickets.reduce(
        (sum, ticket) => sum + ticket.price * (this.quantities[ticket.id] ?? 0),
        0
      );

      return this.$formatPrice(tickets + props.basePrice * this.count);
    },

    init() {
      (this.$store.productForm as ProductForm).addValidator(() => this.validate());
    },

    setQuantity(ticketId: number, quantity: number) {
      this.quantities = { ...this.quantities, [ticketId]: quantity };

      this.$wire.set('booking', this.count ? { qty: this.quantities } : [], false);

      if (this.showErrors) {
        this.validate();
      }
    },

    validate(): boolean {
      this.showErrors = this.count === 0;

      return !this.showErrors;
    },
  }));
}
