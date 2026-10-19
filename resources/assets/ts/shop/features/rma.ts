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

interface RequestProps {
  cancelUrl: string;
}

interface Message {
  id: number;
  message: string | null;
  is_admin: boolean | number;
  attachment: string | null;
  attachment_path: string | null;
  attachment_url?: string | null;
  created_at: string;
}

interface ConversationProps {
  rmaId: number;
  messagesUrl: string;
  sendUrl: string;
  storageUrl: string;
  customerName: string;
  allowedTypes: string[];
  labels: {
    admin: string;
    invalidType: string;
  };
}

interface OrderRow {
  id: number;
  increment_id: string;
  status: string;
  grand_total: string;
  created_at: string;
  order_currency_code: string;
}

interface ItemAttribute {
  attribute_name: string;
  option_label: string;
}

interface OrderItem {
  order_item_id: number;
  name: string;
  sku: string;
  price: string | number;
  qty_ordered: number;
  qty_invoiced: number;
  qty_refunded: number;
  qty_canceled: number | null;
  currentQuantity: number;
  forReturnQuantity: number;
  forCancelQuantity: number;
  rma_return_period: number;
  created_at: string;
  base_image: string | null;
  base_image_url?: string | null;
  attributes: ItemAttribute[] | Record<string, ItemAttribute> | string | null;
}

interface Reason {
  id: number;
  title: string;
}

interface CreateProps {
  ordersUrl: string;
  itemsUrl: string;
  reasonsUrl: string;
  storeUrl: string;
  storageUrl: string;
  preselectedOrder: number | null;
  allowedTypes: string[];
  requiredGroups: Record<string, string>;
  labels: {
    invalidType: string;
  };
}

const PAGE_SIZE = 5;

// Enough for every order still inside a return window
const ORDERS_PAGE_SIZE = 100;

const firstErrors = (errors: Record<string, string[]>) =>
  Object.fromEntries(
    Object.entries(errors).map(([field, messages]) => [field.replace(/^images\.\d+$/, 'images'), messages[0]])
  );

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

  Alpine.data('VisualRmaRequest', (props: RequestProps) => ({
    canceling: false,

    cancel() {
      this.canceling = true;

      this.$request(props.cancelUrl, 'POST')
        .then((data) => {
          this.$toaster.success(data.message);
          setTimeout(() => window.location.reload(), 1000);
        })
        .catch((error) => {
          this.$toaster.error(error.message);
          this.canceling = false;
        });
    },
  }));

  /**
   * The request's conversation with the store, newest message last. Bagisto
   * pages it newest first, so showing older messages asks for a longer page.
   */
  Alpine.data('VisualRmaConversation', (props: ConversationProps) => ({
    allowedTypes: props.allowedTypes,
    messages: [] as Message[],
    total: 0,
    limit: PAGE_SIZE,
    loaded: false,
    loading: false,
    sending: false,
    message: '',
    file: null as File | null,
    errors: {} as Record<string, string>,

    init() {
      this.load();
    },

    get thread() {
      return [...this.messages].reverse();
    },

    get hasOlder() {
      return this.messages.length < this.total;
    },

    load() {
      this.loading = true;

      return this.$request(props.messagesUrl, 'GET', { id: props.rmaId, limit: this.limit })
        .then((data) => {
          this.messages = data.messages.data;
          this.total = data.messages.total;
        })
        .finally(() => {
          this.loaded = true;
          this.loading = false;
        });
    },

    loadOlder() {
      this.limit += PAGE_SIZE;
      this.load();
    },

    isAdmin(message: Message) {
      return Number(message.is_admin) === 1;
    },

    author(message: Message) {
      return this.isAdmin(message) ? props.labels.admin : props.customerName;
    },

    date(value: string) {
      return new Intl.DateTimeFormat(document.documentElement.lang || undefined, {
        dateStyle: 'medium',
        timeStyle: 'short',
      }).format(new Date(value));
    },

    // 2.5 serves attachments through a route; 2.4 from the public disk
    attachmentUrl(message: Message) {
      return message.attachment_url ?? props.storageUrl + message.attachment_path;
    },

    pickFile(event: Event) {
      const input = event.target as HTMLInputElement;
      const file = input.files?.[0] ?? null;

      if (file && this.allowedTypes.length && !this.allowedTypes.includes(file.type)) {
        const extensions = this.allowedTypes.map((type) => type.split('/').pop()).join(', ');

        this.$toaster.warning(`${props.labels.invalidType}: ${extensions}`);
        this.clearFile();

        return;
      }

      this.file = file;
    },

    clearFile() {
      this.file = null;
      (this.$refs.file as HTMLInputElement).value = '';
    },

    send() {
      // Bagisto's admin renders messages as HTML before 2.4.10
      const text = this.message.replace(/[<>]/g, '').trim();

      if (!text) {
        return;
      }

      const data = new FormData();
      data.append('rma_id', String(props.rmaId));
      data.append('message', text);
      data.append('is_admin', '0');

      if (this.file) {
        data.append('file', this.file);
      }

      this.sending = true;
      this.errors = {};

      this.$request(props.sendUrl, 'POST', data)
        .then((response) => {
          this.$toaster.success(response.messages);
          this.message = '';
          this.clearFile();

          return this.load();
        })
        .catch((error) => {
          if (error.errors) {
            this.errors = firstErrors(error.errors);
          } else {
            this.$toaster.error(error.message);
          }
        })
        .finally(() => {
          this.sending = false;
        });
    },
  }));

  /**
   * A new return request, on one page: an order, then one of its items and
   * what to do with it, then the details. Bagisto takes one item per request.
   */
  Alpine.data('VisualRmaCreate', (props: CreateProps) => ({
    allowedTypes: props.allowedTypes,
    orders: [] as OrderRow[],
    ordersLoaded: false,
    orderId: null as number | null,
    currency: 'USD',
    items: [] as OrderItem[],
    itemId: null as number | null,
    resolution: '',
    reasons: [] as Reason[],
    reasonId: '',
    quantity: 1,
    images: [] as File[],
    errors: {} as Record<string, string>,
    submitting: false,

    init() {
      this.$watch('resolution', () => this.loadReasons());

      this.$request(props.ordersUrl, 'GET', { pagination: { page: 1, per_page: ORDERS_PAGE_SIZE } })
        .then((data) => {
          this.orders = data.records;

          const preselected = this.orders.find((order: OrderRow) => order.id === props.preselectedOrder);

          if (preselected) {
            this.selectOrder(preselected);
          }
        })
        .finally(() => {
          this.ordersLoaded = true;
        });
    },

    get item(): OrderItem | null {
      return this.items.find((item) => item.order_item_id === this.itemId) ?? null;
    },

    get maxQuantity() {
      const item = this.item;

      if (!item) {
        return 1;
      }

      const forResolution = { return: item.forReturnQuantity, cancel_items: item.forCancelQuantity }[this.resolution];

      return Math.max(1, Math.min(forResolution ?? item.currentQuantity, item.currentQuantity));
    },

    selectOrder(order: OrderRow) {
      this.orderId = order.id;
      this.currency = order.order_currency_code;
      this.items = [];
      this.itemId = null;
      this.resolution = '';

      this.$request(props.itemsUrl.replace('__order__', String(order.id))).then((items: OrderItem[]) => {
        this.items = items;

        const available = items.filter((item) => this.available(item));

        if (available.length === 1) {
          this.selectItem(available[0]);
        }
      });
    },

    selectItem(item: OrderItem) {
      this.itemId = item.order_item_id;
      this.quantity = 1;
      this.resolution = '';

      // A choice of one is made for the customer, once its select exists
      const resolutions = [this.canReturn(item) && 'return', this.canCancel(item) && 'cancel_items'].filter(Boolean);

      if (resolutions.length === 1) {
        this.$nextTick(() => (this.resolution = resolutions[0] as string));
      }
    },

    loadReasons() {
      this.reasons = [];
      this.reasonId = '';

      if (!this.resolution) {
        return;
      }

      this.$request(props.reasonsUrl.replace('__type__', this.resolution)).then((reasons: Reason[]) => {
        this.reasons = reasons;
      });
    },

    available(item: OrderItem) {
      return Number(item.currentQuantity) > 0;
    },

    canReturn(item: OrderItem) {
      return Number(item.qty_invoiced) > Number(item.qty_refunded);
    },

    canCancel(item: OrderItem) {
      return Number(item.qty_ordered) - Number(item.qty_invoiced) - Number(item.qty_canceled ?? 0) > 0;
    },

    // 2.4.11 added base_image_url; before it the image sits on the public disk
    imageUrl(item: OrderItem) {
      return item.base_image_url ?? (item.base_image ? props.storageUrl + item.base_image : null);
    },

    attributes(item: OrderItem): ItemAttribute[] {
      if (!item.attributes || typeof item.attributes === 'string') {
        return [];
      }

      return Object.values(item.attributes).filter((attribute) => attribute?.attribute_name);
    },

    returnWindow(item: OrderItem) {
      const until = new Date(item.created_at);
      until.setDate(until.getDate() + Number(item.rma_return_period));

      return new Intl.DateTimeFormat(document.documentElement.lang || undefined, { dateStyle: 'medium' }).format(until);
    },

    price(value: string | number) {
      return new Intl.NumberFormat(document.documentElement.lang || undefined, {
        style: 'currency',
        currency: this.currency,
      }).format(Number(value));
    },

    // Bagisto's grid sends its cells as markup
    text(html: string) {
      return new DOMParser().parseFromString(html, 'text/html').body.textContent?.trim() ?? '';
    },

    pickImages(event: Event) {
      const input = event.target as HTMLInputElement;
      const files = Array.from(input.files ?? []);
      const allowed = files.filter((file) => !this.allowedTypes.length || this.allowedTypes.includes(file.type));

      if (allowed.length < files.length) {
        const extensions = this.allowedTypes.map((type) => type.split('/').pop()).join(', ');

        this.$toaster.warning(`${props.labels.invalidType}: ${extensions}`);
      }

      this.images = [...this.images, ...allowed];
      input.value = '';
    },

    removeImage(index: number) {
      this.images = this.images.filter((_, position) => position !== index);
    },

    submit(form: HTMLFormElement) {
      this.errors = {};

      if (!form.reportValidity()) {
        return;
      }

      // A required group of checkboxes needs one ticked, which the browser cannot check
      for (const [id, message] of Object.entries(props.requiredGroups)) {
        if (!form.querySelector(`[name="customAttributes[${id}][]"]:checked`)) {
          this.errors[`customAttributes.${id}`] = message;
        }
      }

      if (Object.keys(this.errors).length) {
        return;
      }

      const data = new FormData(form);

      // As Bagisto's own form does: its admin renders this as HTML before 2.4.10
      data.set('information', String(data.get('information') ?? '').replace(/[<>]/g, ''));

      this.images.forEach((image) => data.append('images[]', image));

      this.submitting = true;

      this.$request(props.storeUrl, 'POST', data)
        .then((response) => {
          // 2.4 answers with the message; 2.5 flashes it for the next page
          if (response.messages) {
            this.$toaster.success(response.messages);
            setTimeout(() => (window.location.href = response.redirect), 1000);
          } else {
            window.location.href = response.redirect;
          }
        })
        .catch((error) => {
          if (error.errors) {
            this.errors = firstErrors(error.errors);
          } else {
            this.$toaster.error(error.message);
          }

          this.submitting = false;
        });
    },
  }));
}
