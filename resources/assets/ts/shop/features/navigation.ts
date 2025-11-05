import { defineScope, defineComponent, setup } from 'alpine-define-component';

interface Props {}

interface NavigationItemScope {
  id: number;
  isActive: boolean;
  open(): void;
}

interface NavigationSectionScope {
  id: number;
  isActive: boolean;
}

export default defineComponent({
  name: 'navigation',

  setup: setup((props: Props) => ({
      dropdownOpen: false,
      activeItem: null as number | null,
      hideDelay: 200,
      hideTimer: null as ReturnType<typeof setTimeout> | null,

      openDropdown(triggerEl: HTMLElement, id: number) {
        this.dropdownOpen = true;
        this.activeItem = id;
        this.$nextTick(() => {
          this.positionDropdown(triggerEl);
        });
      },

      closeDropdown() {
        this.dropdownOpen = false;
        this.activeItem = null;
      },

      startHideTimer() {
        this.hideTimer = setTimeout(() => {
          this.closeDropdown();
        }, this.hideDelay) as any;
      },

      cancelHideTimer() {
        if (this.hideTimer) {
          clearTimeout(this.hideTimer);
        }
      },

      positionDropdown(triggerEl: HTMLElement) {
        this.cancelHideTimer();

        requestAnimationFrame(() => {
          const triggerRect = triggerEl.getBoundingClientRect();
          const dropdown = this.$refs.menuDropdown as HTMLElement;
          const dropdownWidth = dropdown.offsetWidth;
          const triggerCenter = triggerRect.left + triggerRect.width / 2;
          let left = triggerCenter - dropdownWidth / 2;

          const minLeft = 100;
          const maxLeft = window.innerWidth - dropdownWidth - 16;

          if (left < minLeft) left = minLeft;
          if (left > maxLeft) left = maxLeft;

          dropdown.style.left = `${left}px`;
        });
      },

      isActive(id: number) {
        return this.activeItem === id;
      },
    })),

  parts: {
    item: defineScope({
      name: 'item',

      setup(api, el, { value }) {
        const id = Number(value);

        return {
          id,
          get isActive() {
            return api.isActive(id);
          },

          open() {
            api.openDropdown(el, id);
          },
        };
      },

      bindings(api, scope) {
        return {
          'aria-haspopup': 'true',
          'x-on:mouseover': () => scope.open(),
          'x-on:mouseleave': () => api.startHideTimer(),
          'x-bind:aria-expanded': () => api.dropdownOpen && scope.isActive,
          'x-bind:data-state': () => (scope.isActive ? 'active' : 'inactive'),
        };
      },
    }),

    section: defineScope({
      name: 'section',

      setup(api, el, { value }) {
        const id = Number(value);

        return {
          id,
          get isActive() {
            return api.isActive(id);
          },
        };
      },

      bindings(_, scope) {
        return {
          'x-show': () => scope.isActive,
          'x-bind:data-state': () => (scope.isActive ? 'open' : 'closed'),
        };
      },
    }),

    dropdown(api) {
      return {
        'x-ref': 'menuDropdown',
        'x-show': () => api.dropdownOpen,
        'x-on:mouseover': () => api.cancelHideTimer(),
        'x-on:mouseleave': () => api.startHideTimer(),
      };
    },

    subItem(api) {
      return {
        'x-on:click': () => api.closeDropdown(),
      };
    },
  },
});
