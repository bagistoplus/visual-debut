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

interface RentalHour {
  from: string;
  to: string;
  from_timestamp: number;
  to_timestamp: number;
  window: number;
}

interface RentalWindow {
  slots: Omit<RentalHour, 'window'>[];
}

interface BookingRentalProps {
  rentingType: 'daily' | 'hourly' | 'daily_hourly';
  slotsUrl: string;
  availableFrom: string | null;
  availableTo: string | null;
  basePrice: number;
  dailyPrice: number;
  hourlyPrice: number;
  oneHourOnly: boolean;
  messages: {
    loading: string;
    empty: string;
    failed: string;
    baseLine: string;
    daysLine: string;
    hoursLine: string;
    quantityLine: string;
  };
}

interface SummaryLine {
  id: number;
  label: string;
  amount: string;
}

interface BookingSlotsProps {
  type: string;
  slotsUrl: string;
  availableFrom: string | null;
  availableTo: string | null;
  preventDays: number;
  perTable?: boolean;
  price?: number;
  messages: { loading: string; empty: string; failed: string; guestLine: string; tableLine: string };
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
 * The first day the shopper can book: today, or the product's first day.
 */
function firstDay(availableFrom: string | null, daysAhead = 0): string {
  const earliest = new Date();
  earliest.setDate(earliest.getDate() + daysAhead);

  const first = isoDate(earliest);

  return availableFrom && availableFrom > first ? availableFrom : first;
}

/**
 * Fills a translated line such as ':name × :count'.
 */
function fill(template: string, values: Record<string, string | number>): string {
  return Object.entries(values).reduce((text, [key, value]) => text.replace(`:${key}`, String(value)), template);
}

export default function (Alpine: AlpineType) {
  /**
   * A booking taken as one slot on one day: default, appointment and table
   * booking products. Bagisto lists the free slots of a day on request. A
   * table also takes a party, which Bagisto reads as the quantity, and a note.
   */
  Alpine.data('VisualBookingSlots', (props: BookingSlotsProps) => ({
    date: '',
    slot: '',
    slots: [] as BookingSlot[],
    status: 'idle' as SlotsStatus,
    showErrors: false,
    request: 0,
    party: 1,
    note: '',

    // Worked out here rather than on the server, which may serve a cached page
    get minDate(): string {
      return firstDay(props.availableFrom, props.preventDays);
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

    get partyLine(): SummaryLine {
      const line = props.perTable ? props.messages.tableLine : props.messages.guestLine;

      return {
        id: 0,
        label: fill(line, { count: this.party }),
        amount: this.$formatPrice((props.price ?? 0) * this.party),
      };
    },

    init() {
      (this.$store.productForm as ProductForm).addValidator(() => this.validate());

      this.$watch('slot', () => {
        this.sync();

        if (this.showErrors) {
          this.validate();
        }
      });

      this.$watch('note', () => this.sync());
    },

    setParty(party: number) {
      this.party = party;
      this.sync();
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
      if (props.type !== 'table') {
        this.$wire.set('booking', this.slot ? { date: this.date, slot: this.slot } : [], false);

        return;
      }

      // Bagisto 2.3 and 2.4 read the note without checking it is there
      this.$wire.set('booking', this.slot ? { date: this.date, slot: this.slot, note: this.note } : [], false);
      this.$wire.set('quantity', this.party, false);
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

  /**
   * A rental, by the day between two dates or by the hour on one day.
   * Bagisto charges the product's price plus the rate for each day or hour,
   * per item, and counts both the first and the last day.
   */
  Alpine.data('VisualBookingRental', (props: BookingRentalProps) => ({
    mode: (props.rentingType === 'hourly' ? 'hourly' : 'daily') as 'daily' | 'hourly',
    dateFrom: '',
    dateTo: '',
    date: '',
    hours: [] as RentalHour[],
    hourFrom: '',
    hourTo: '',
    status: 'idle' as SlotsStatus,
    showErrors: false,
    request: 0,

    get minDate(): string {
      return firstDay(props.availableFrom);
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

    // A rental runs through one window, so it ends in the window it starts in
    get toHours(): RentalHour[] {
      const from = this.hours.find((hour) => String(hour.from_timestamp) === this.hourFrom);

      if (!from) return [];

      return this.hours.filter((hour) => hour.window === from.window && hour.to_timestamp > from.from_timestamp);
    },

    get units(): number {
      if (this.mode === 'daily') {
        if (!this.dateFrom || !this.dateTo || this.dateTo < this.dateFrom) return 0;

        const days = (Date.parse(this.dateTo) - Date.parse(this.dateFrom)) / 86400000;

        return Math.round(days) + 1;
      }

      if (!this.hourFrom || !this.hourTo) return 0;

      return Math.round((Number(this.hourTo) - Number(this.hourFrom)) / 3600);
    },

    get quantity(): number {
      return Math.max(1, Number(this.$wire.quantity) || 1);
    },

    get lines(): SummaryLine[] {
      const rate = this.mode === 'daily' ? props.dailyPrice : props.hourlyPrice;
      const unitLine = this.mode === 'daily' ? props.messages.daysLine : props.messages.hoursLine;
      const lines: SummaryLine[] = [];

      if (props.basePrice > 0) {
        lines.push({ id: 1, label: props.messages.baseLine, amount: this.$formatPrice(props.basePrice) });
      }

      lines.push({ id: 2, label: fill(unitLine, { count: this.units }), amount: this.$formatPrice(rate * this.units) });

      if (this.quantity > 1) {
        lines.push({ id: 3, label: fill(props.messages.quantityLine, { count: this.quantity }), amount: '' });
      }

      return lines;
    },

    get total(): string {
      const rate = this.mode === 'daily' ? props.dailyPrice : props.hourlyPrice;

      return this.$formatPrice((props.basePrice + rate * this.units) * this.quantity);
    },

    init() {
      (this.$store.productForm as ProductForm).addValidator(() => this.validate());

      this.$watch('hourFrom', () => {
        // Before Bagisto 2.5 a rental is one hour, so the hour picked is the whole span
        if (props.oneHourOnly) {
          const hour = this.hours.find((item) => String(item.from_timestamp) === this.hourFrom);
          this.hourTo = hour ? String(hour.to_timestamp) : '';
        } else if (!this.toHours.some((hour) => String(hour.to_timestamp) === this.hourTo)) {
          this.hourTo = '';
        }
      });

      for (const field of ['mode', 'dateFrom', 'dateTo', 'hourTo']) {
        this.$watch(field, () => {
          this.sync();

          if (this.showErrors) {
            this.validate();
          }
        });
      }
    },

    async loadHours() {
      this.hours = [];
      this.hourFrom = '';
      this.hourTo = '';

      if (!this.date) {
        this.status = 'idle';

        return;
      }

      const request = ++this.request;
      this.status = 'loading';

      try {
        const response = await this.$request(props.slotsUrl, 'GET', { date: this.date });

        if (request !== this.request) return;

        const windows = Object.values(response?.data ?? {}) as RentalWindow[];

        this.hours = windows.flatMap((window, index) =>
          (window.slots ?? []).map((hour) => ({ ...hour, window: index }))
        );
        this.status = this.hours.length ? 'ready' : 'empty';
      } catch {
        if (request === this.request) {
          this.status = 'failed';
        }
      }
    },

    sync() {
      let booking: Record<string, unknown> | [] = [];

      if (this.units > 0 && this.mode === 'daily') {
        booking = { renting_type: 'daily', date_from: this.dateFrom, date_to: this.dateTo };
      } else if (this.units > 0) {
        booking = {
          renting_type: 'hourly',
          date: this.date,
          slot: { from: Number(this.hourFrom), to: Number(this.hourTo) },
        };
      }

      this.$wire.set('booking', booking, false);
    },

    validate(): boolean {
      this.showErrors = this.units === 0;

      return !this.showErrors;
    },
  }));
}
