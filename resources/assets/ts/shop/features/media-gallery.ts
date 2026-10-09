import type { Alpine as AlpineType } from 'alpinejs';

interface Props {
  medias?: any[];
  scrollAmount?: number;
}

export default function (Alpine: AlpineType) {
  Alpine.data('VisualMediaGallery', (props: Props) => {
    let onMediasChanged: (event: Event) => void;

    return {
      medias: [] as any[],
      defaultMedias: [] as any[],
      selectedIndex: 0,
      scrollAmount: props.scrollAmount ?? 100,

      hasOverflowAbove: false,
      hasOverflowBelow: false,

      get selectedMedia() {
        return this.medias[this.selectedIndex] ?? null;
      },

      isSelected(index: number) {
        return this.selectedIndex === index;
      },

      select(index: number) {
        this.selectedIndex = index;
      },

      checkOverflow() {
        const thumbs = this.$refs.thumbs as HTMLElement | undefined;

        if (!thumbs) return;

        this.hasOverflowAbove = thumbs.scrollTop > 0;
        this.hasOverflowBelow = thumbs.scrollTop + thumbs.clientHeight < thumbs.scrollHeight;
      },

      scrollThumbs(direction: 'up' | 'down') {
        (this.$refs.thumbs as HTMLElement | undefined)?.scrollBy({
          top: direction === 'up' ? -this.scrollAmount : this.scrollAmount,
          behavior: 'smooth',
        });
      },

      onThumbKeydown(event: KeyboardEvent) {
        const keys = ['ArrowRight', 'ArrowDown', 'ArrowLeft', 'ArrowUp'];
        if (!keys.includes(event.key)) return;

        event.preventDefault();

        if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
          this.selectedIndex = (this.selectedIndex + 1) % this.medias.length;
        }

        if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
          this.selectedIndex = (this.selectedIndex - 1 + this.medias.length) % this.medias.length;
        }

        const thumbs = (this.$refs.thumbs as HTMLElement).querySelectorAll<HTMLElement>('[data-thumb]');
        thumbs[this.selectedIndex]?.focus();
      },

      init() {
        this.medias = props.medias || [];
        this.defaultMedias = [...this.medias];

        onMediasChanged = (event: Event) => {
          const images = (event as CustomEvent).detail?.images || [];
          const videos = (event as CustomEvent).detail?.videos || [];

          this.medias = images.length || videos.length ? [...images, ...videos] : [...this.defaultMedias];
          this.selectedIndex = 0;

          this.$nextTick(() => this.checkOverflow());
        };

        window.addEventListener('variant-medias-change', onMediasChanged);

        this.$nextTick(() => this.checkOverflow());
      },

      destroy() {
        window.removeEventListener('variant-medias-change', onMediasChanged);
      },
    };
  });
}
