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

      // Fullscreen viewer, mounted the first time it opens
      viewerOpen: false,
      viewerMounted: false,
      viewerIndex: 0,

      get selectedMedia() {
        return this.medias[this.selectedIndex] ?? null;
      },

      // The viewer only shows images, so its index is a position in this list, not in medias
      get viewerImages() {
        return this.medias.filter((media) => media.type !== 'videos');
      },

      get viewerImage() {
        return this.viewerImages[this.viewerIndex] ?? null;
      },

      openViewer(index: number) {
        this.viewerIndex = Math.max(0, this.viewerImages.indexOf(this.medias[index]));
        this.viewerOpen = true;
        this.viewerMounted = true;
      },

      // The gallery shows the image the shopper ended on
      closeViewer() {
        this.viewerOpen = false;

        const index = this.medias.indexOf(this.viewerImage);

        if (index !== -1) {
          this.selectedIndex = index;
        }
      },

      step(delta: number) {
        const count = this.viewerImages.length;

        if (count === 0) return;

        this.viewerIndex = (((this.viewerIndex + delta) % count) + count) % count;
      },

      // A key points at a side of the screen, and the side the next item is on flips with the text direction
      arrow(key: 'left' | 'right') {
        const rtl = getComputedStyle(this.$root).direction === 'rtl';

        this.step(key === 'right' !== rtl ? 1 : -1);
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
          this.viewerOpen = false;
          this.viewerIndex = 0;

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
