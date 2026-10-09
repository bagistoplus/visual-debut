import type { Alpine as AlpineType } from 'alpinejs';

declare namespace Alpine {
  interface Magics<T> {
    toaster: {
      create: (toast: Partial<Toast>) => void;
      info: (toast: string | Partial<Toast>) => void;
      success: (toast: string | Partial<Toast>) => void;
      warning: (toast: string | Partial<Toast>) => void;
      error: (toast: string | Partial<Toast>) => void;
    };
  }
}

type Placement = 'top-start' | 'top-center' | 'top-end' | 'bottom-start' | 'bottom-center' | 'bottom-end';

export interface Toast {
  id: string;
  title: string;
  description?: string;
  placement?: Placement;
  type?: 'info' | 'success' | 'warning' | 'error';
  duration?: number;
  dismissed?: boolean;
}

interface Props {
  placement?: Placement;
}

let nextId = 0;

export default function (Alpine: AlpineType) {
  Alpine.data('VisualToasts', (props: Props) => {
    let onCreate: (e: Event) => void;

    return {
      placement: props.placement || 'top-end',
      store: [] as Toast[],

      get placements() {
        return Array.from(new Set(this.store.map((t: Toast) => t.placement))) as Placement[];
      },

      init() {
        onCreate = (e: Event) => this.create((e as CustomEvent).detail);
        window.addEventListener('toasts:create', onCreate);
      },

      destroy() {
        window.removeEventListener('toasts:create', onCreate);
      },

      toastsFor(placement: Placement) {
        return this.store.filter((t: Toast) => t.placement === placement);
      },

      side(placement?: Placement) {
        return placement?.split('-')[0];
      },

      align(placement?: Placement) {
        return placement?.split('-')[1];
      },

      create(toast: Partial<Toast>) {
        const newToast: Toast = {
          // Flash messages arrive in the same millisecond, so the time alone would repeat x-for keys
          id: `${Date.now()}-${nextId++}`,
          type: toast.type || 'info',
          title: toast.title || '',
          description: toast.description || '',
          placement: toast.placement || this.placement,
          duration: toast.duration || 3000,
          dismissed: false,
        };

        this.store.push(newToast);

        if (newToast.duration && newToast.duration > 0) {
          setTimeout(() => {
            this.dismiss(newToast.id);
          }, newToast.duration);
        }
      },

      dismiss(id: string) {
        const toast = this.store.find((t: Toast) => t.id === id);

        if (!toast || toast.dismissed) {
          return;
        }

        // Plays the closed animation before the toast leaves the store
        toast.dismissed = true;

        setTimeout(() => {
          this.store = this.store.filter((t: Toast) => t.id !== id);
        }, 300);
      },
    };
  });
}

export function toaster(Alpine: AlpineType) {
  const create = (toast: Partial<Toast>) => {
    window.dispatchEvent(new CustomEvent('toasts:create', { detail: toast }));
  };

  const createToster = (type: Toast['type']) => (toast: string | Partial<Toast>) => {
    const detail = typeof toast === 'string' ? { title: toast } : toast;
    create({ ...detail, type });
  };

  Alpine.magic('toaster', () => ({
    create,
    info: createToster('info'),
    warning: createToster('warning'),
    success: createToster('success'),
    error: createToster('error'),
  }));
}
