import { defineComponent, setup } from 'alpine-define-component';

interface Props {}

export default defineComponent({
  name: 'collapsible',

  setup: setup((_props: Props, { generateId }) => {
    const triggerId = generateId('trigger');
    const contentId = generateId('content');

    return {
      triggerId,
      contentId,
      expanded: false,

      toggle() {
        this.expanded = !this.expanded;
        this.$dispatch('toggle', this.expanded);
      },
    };
  }),

  parts: {
    trigger(api) {
      return {
        id: api.triggerId,
        role: 'button',
        'x-on:click': () => api.toggle(),
        'aria-controls': api.contentId,
        'x-bind:aria-expanded': () => api.expanded,
        'x-bind:data-state': () => (api.expanded ? 'open' : 'closed'),
      };
    },

    content(api) {
      return {
        id: api.contentId,
        'x-collapse': '',
        'x-show': () => api.expanded,
        'x-bind:data-state': () => (api.expanded ? 'open' : 'closed'),
      };
    },

    indicator(api) {
      return {
        'x-bind:data-state': () => (api.expanded ? 'open' : 'closed'),
      };
    },
  },
});
