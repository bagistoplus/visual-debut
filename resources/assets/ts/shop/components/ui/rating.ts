import { defineScope, defineComponent, setup } from 'alpine-define-component';

interface Props {
  value?: number;
  max?: number;
}

interface RatingStarScope {
  index: number;
  isActive: boolean;
  isHovered: boolean;
  select(): void;
  hover(): void;
  leave(): void;
}

export default defineComponent({
  name: 'rating',

  setup: setup((props: Props) => {
    const initial = Number(props.value ?? 0);
    const max = Number(props.max ?? 5);

    return {
      value: initial,
      hover: null as number | null,
      max,

      set(value: number) {
        this.value = value;
        this.hover = null;
        this.$dispatch('change', value);
      },

      onHover(value: number | null) {
        this.hover = value;
      },

      isActive(index: number) {
        return index <= this.value;
      },

      isHovered(index: number) {
        return this.hover !== null && index <= this.hover;
      },
    };
  }),

  parts: {
    root: () => ({
      role: 'radiogroup',
      'aria-label': 'Star rating',
    }),

    star: defineScope({
      name: 'star',

      setup(api, _el, { value }) {
        const index = Number(value);

        return {
          index,

          get isActive() {
            return api.isHovered(index) || (!api.hover && api.isActive(index));
          },

          get isHovered() {
            return api.isHovered(index);
          },

          select() {
            api.set(index);
          },

          hover() {
            api.onHover(index);
          },

          leave() {
            api.onHover(null);
          },
        };
      },

      bindings(_, scope) {
        return {
          'x-bind:data-active': () => (scope.isActive ? 'true' : null),
          'x-bind:data-hovered': () => (scope.isHovered ? 'true' : null),
          'x-on:click': () => scope.select(),
          'x-on:mouseenter': () => scope.hover(),
          'x-on:mouseleave': () => scope.leave(),
          role: 'radio',
          tabindex: '0',
          'x-on:keydown.enter.prevent': () => scope.select(),
          'x-on:keydown.space.prevent': () => scope.select(),
          'x-bind:aria-checked': () => (scope.isActive ? 'true' : 'false'),
          'x-bind:aria-label': () => `Rate ${scope.index} star`,
        };
      },
    }),
  },
});
