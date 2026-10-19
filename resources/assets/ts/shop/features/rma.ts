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

const PAGE_SIZE = 5;

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
            this.errors = Object.fromEntries(
              Object.entries(error.errors as Record<string, string[]>).map(([field, messages]) => [field, messages[0]])
            );
          } else {
            this.$toaster.error(error.message);
          }
        })
        .finally(() => {
          this.sending = false;
        });
    },
  }));
}
