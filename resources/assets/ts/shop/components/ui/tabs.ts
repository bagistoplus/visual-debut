import { defineScope, defineComponent, setup } from 'alpine-define-component';

interface Props {
  selected?: string;
}

interface TabScope {
  name: string;
  isSelected: boolean;
  select(): void;
  tabId: string;
  panelId: string;
}

interface PanelScope {
  name: string;
  isSelected: boolean;
  tabId: string;
  panelId: string;
}

export default defineComponent({
  name: 'tabs',

  setup: setup((props: Props) => {
    const tabMap = new Map<string, HTMLElement>();
    const panelMap = new Map<string, HTMLElement>();

    return {
      selected: props.selected ?? '',

      get names() {
        return Array.from(tabMap.keys());
      },

      select(name: string) {
        this.selected = name;
        this.$dispatch('tab:change', name);
        this.focusTab(name);
      },

      isSelected(name: string) {
        return this.selected === name;
      },

      focusTab(name: string) {
        tabMap.get(name)?.focus();
      },

      _registerTab(el: HTMLElement, name?: string) {
        const tabName = name || `tab-${tabMap.size}`;

        if (!tabMap.has(tabName)) {
          tabMap.set(tabName, el);

          if (!this.selected) {
            this.selected = tabName;
          }
        }

        return tabName;
      },

      _registerPanel(el: HTMLElement, name?: string) {
        const panelName = name || `tab-${panelMap.size}`;

        if (!panelMap.has(panelName)) {
          panelMap.set(panelName, el);
        }

        return panelName;
      },

      _unregisterTab(name: string) {
        tabMap.delete(name);

        if (this.selected === name && this.names.length > 0) {
          this.selected = this.names[0];
        }
      },

      _unregisterPanel(name: string) {
        panelMap.delete(name);
      },
    };
  }),

  parts: {
    tablist: () => ({
      role: 'tablist',
    }),

    tab: defineScope({
      name: 'tab',
      setup(api, el, { value, generateId, cleanup }) {
        const name = api._registerTab(el, value);
        const tabId = generateId(`tab-${name}`);
        const panelId = generateId(`panel-${name}`);

        cleanup(() => {
          api._unregisterTab(name);
        });

        return {
          name,
          tabId,
          panelId,
          get isSelected() {
            return api.isSelected(name);
          },
          select() {
            api.select(name);
          },
        };
      },

      bindings(api, scope) {
        const index = api.names.indexOf(scope.name);

        return {
          id: scope.tabId,
          role: 'tab',
          type: 'button',
          tabindex: () => (scope.isSelected ? 0 : -1),
          'aria-selected': () => scope.isSelected,
          'aria-controls': scope.panelId,
          'x-on:click': () => scope.select(),
          'x-on:keydown.arrow-right.prevent': () => api.select(api.names[(index + 1) % api.names.length]),
          'x-on:keydown.arrow-left.prevent': () =>
            api.select(api.names[(index - 1 + api.names.length) % api.names.length]),
          'x-on:keydown.home.prevent': () => api.select(api.names[0]),
          'x-on:keydown.end.prevent': () => api.select(api.names.at(-1)!),
          'x-bind:data-state': () => (scope.isSelected ? 'active' : 'inactive'),
        };
      },
    }),

    panel: defineScope({
      name: 'panel',
      setup(api, el, { value, generateId, cleanup }) {
        const name = api._registerPanel(el, value);
        const tabId = generateId(`tab-${name}`);
        const panelId = generateId(`panel-${name}`);

        cleanup(() => {
          api._unregisterPanel(name);
        });

        return {
          name,
          tabId,
          panelId,
          get isSelected() {
            return api.isSelected(name);
          },
        };
      },

      bindings(_, scope) {
        return {
          id: scope.panelId,
          role: 'tabpanel',
          'aria-labelledby': scope.tabId,
          'x-show': () => scope.isSelected,
          'x-bind:data-state': () => (scope.isSelected ? 'active' : 'inactive'),
        };
      },
    }),
  },
});
