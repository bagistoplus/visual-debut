import { defineScope, defineComponent, setup } from 'alpine-define-component';

/**
 * Debounce helper function
 */
function debounce<T extends (...args: any[]) => any>(func: T, wait: number): (...args: Parameters<T>) => void {
  let timeout: ReturnType<typeof setTimeout> | null = null;
  return (...args: Parameters<T>) => {
    if (timeout) clearTimeout(timeout);
    timeout = setTimeout(() => func(...args), wait);
  };
}

/**
 * Advanced Carousel Component
 *
 * Features:
 * - Full-width and dynamic width slides
 * - Touch/swipe gestures
 * - Multiple pagination modes (dots, fraction, progress)
 * - Autoplay with pause on hover/focus
 * - Loop mode
 * - Responsive breakpoints
 * - Accessibility support
 *
 * @example
 * ```html
 * <div x-carousel="{ slidesPerView: 'auto', spaceBetween: 16 }">
 *   <div x-carousel:viewport>
 *     <div x-carousel:slide>Slide 1</div>
 *     <div x-carousel:slide style="width: 300px">Custom width</div>
 *   </div>
 *   <button x-carousel:prev-button>Previous</button>
 *   <button x-carousel:next-button>Next</button>
 *   <div x-carousel:pagination></div>
 * </div>
 * ```
 */

interface AutoplayConfig {
  delay: number;
  pauseOnHover?: boolean;
  pauseOnFocus?: boolean;
}

interface A11yConfig {
  enabled?: boolean;
  prevSlideMessage?: string;
  nextSlideMessage?: string;
  paginationBulletMessage?: string;
}

interface Props {
  slidesPerView?: number | 'auto';
  spaceBetween?: number;
  loop?: boolean;
  keyboard?: boolean;
  draggable?: boolean;
  freeMode?: boolean;
  snapToSlides?: boolean;
  threshold?: number;
  resistance?: boolean;
  autoplay?: boolean | AutoplayConfig;
  speed?: number;
  breakpoints?: {
    [width: number]: Partial<Props>;
  };
  a11y?: A11yConfig;
  id?: string;
}

interface SlideData {
  el: HTMLElement;
  index: number;
  width: number;
  position: number;
}

interface SlideScope {
  index: number;
  isActive: boolean;
  isPrev: boolean;
  isNext: boolean;
  isVisible: boolean;
  activate(): void;
}

interface PaginationScope {
  index: number;
  isActive: boolean;
  label: string;
  goTo(): void;
}

type CarouselScopes = {
  $slide: SlideScope;
  $pagination: PaginationScope;
};

export default defineComponent({
  name: 'carousel',

  setup: setup((props: Props) => {
    let viewportEl: HTMLElement | null = null;
    let resizeObserver: ResizeObserver | null = null;
    let intersectionObserver: IntersectionObserver | null = null;
    let autoplayTimer: ReturnType<typeof setInterval> | null = null;

    const slidesMap = new Map<number, SlideData>();

    let isDragging = false;
    let dragStartX = 0;
    let dragStartScrollLeft = 0;
    let dragVelocity = 0;
    let lastDragTime = 0;
    let lastDragX = 0;

    const config = {
      slidesPerView: props.slidesPerView ?? 1,
      spaceBetween: props.spaceBetween ?? 0,
      loop: props.loop ?? false,
      keyboard: props.keyboard ?? true,
      draggable: props.draggable ?? true,
      freeMode: props.freeMode ?? false,
      snapToSlides: props.snapToSlides ?? true,
      threshold: props.threshold ?? 10,
      resistance: props.resistance ?? true,
      speed: props.speed ?? 300,
      autoplay:
        typeof props.autoplay === 'object'
          ? props.autoplay
          : props.autoplay
          ? { delay: 3000, pauseOnHover: true, pauseOnFocus: true }
          : null,
      a11y: {
        enabled: true,
        prevSlideMessage: 'Previous slide',
        nextSlideMessage: 'Next slide',
        paginationBulletMessage: 'Go to slide {{index}}',
        ...props.a11y,
      },
      breakpoints: props.breakpoints ?? {},
    };

    return {
      id: props.id || null,
      activeIndex: 0,
      viewportWidth: 0,
      visibleSlidesCount: 1,
      isAtStart: true,
      isAtEnd: false,
      isAutoplayPaused: false,
      slidesPerView: config.slidesPerView,
      spaceBetween: config.spaceBetween,

      get totalSlides() {
        return slidesMap.size;
      },

      get canGoPrev() {
        return config.loop || this.activeIndex > 0;
      },

      get canGoNext() {
        return config.loop || this.activeIndex < this.totalSlides - this.visibleSlidesCount;
      },

      get progress() {
        if (this.totalSlides <= 1) return 0;
        return (this.activeIndex / (this.totalSlides - 1)) * 100;
      },

      get computedSlideWidth() {
        if (this.slidesPerView === 'auto') {
          return 'auto';
        }

        const totalGaps = this.slidesPerView - 1;
        const totalGapWidth = totalGaps * this.spaceBetween;

        return `calc((100% - ${totalGapWidth}px) / ${this.slidesPerView})`;
      },

      goTo(index: number, smooth = true) {
        if (!viewportEl || this.totalSlides === 0) {
          return;
        }

        let targetIndex = index;

        if (config.loop) {
          targetIndex = ((index % this.totalSlides) + this.totalSlides) % this.totalSlides;
        } else {
          targetIndex = Math.max(0, Math.min(this.totalSlides - 1, index));
        }

        this.activeIndex = targetIndex;

        const slide = Array.from(slidesMap.values()).find((s) => s.index === targetIndex);
        if (slide) {
          const scrollLeft = this.calculateScrollPosition(targetIndex);
          viewportEl.scrollTo({
            left: scrollLeft,
            behavior: smooth ? 'smooth' : 'auto',
          });
        }

        this.$dispatch('slidechange', { index: targetIndex });

        if (config.a11y.enabled) {
          this.announceSlide(targetIndex);
        }
      },

      next() {
        if (!this.canGoNext) {
          return;
        }

        this.goTo(this.activeIndex + 1);
      },

      prev() {
        if (!this.canGoPrev) {
          return;
        }

        this.goTo(this.activeIndex - 1);
      },

      calculateScrollPosition(index: number): number {
        const slides = Array.from(slidesMap.values()).sort((a, b) => a.index - b.index);

        if (index === 0) {
          return 0;
        }

        if (index >= slides.length) {
          return viewportEl?.scrollWidth ?? 0;
        }

        let position = 0;
        for (let i = 0; i < index && i < slides.length; i++) {
          position += slides[i].width + config.spaceBetween;
        }

        return position;
      },

      updateViewportSize() {
        if (!viewportEl) {
          return;
        }

        this.viewportWidth = viewportEl.clientWidth;
        this.recalculateVisibleSlides();
      },

      recalculateVisibleSlides() {
        if (this.slidesPerView !== 'auto') {
          this.visibleSlidesCount = this.slidesPerView;
          return;
        }

        const slides = Array.from(slidesMap.values()).sort((a, b) => a.index - b.index);
        if (slides.length === 0) {
          return;
        }

        let totalWidth = 0;
        let count = 0;

        for (const slide of slides) {
          if (totalWidth + slide.width <= this.viewportWidth) {
            totalWidth += slide.width + (count > 0 ? this.spaceBetween : 0);
            count++;
          } else {
            break;
          }
        }

        this.visibleSlidesCount = Math.max(1, count);
      },

      applyBreakpoints() {
        const windowWidth = window.innerWidth;

        const breakpoints = Object.entries(config.breakpoints)
          .map(([width, settings]) => [Number(width), settings] as [number, Partial<Props>])
          .sort((a, b) => a[0] - b[0]);

        let activeBreakpoint: Partial<Props> | null = null;
        for (const [width, settings] of breakpoints) {
          if (windowWidth >= width) {
            activeBreakpoint = settings;
          } else {
            break;
          }
        }

        if (activeBreakpoint) {
          if (activeBreakpoint.slidesPerView !== undefined) {
            this.slidesPerView = activeBreakpoint.slidesPerView;
          }

          if (activeBreakpoint.spaceBetween !== undefined) {
            this.spaceBetween = activeBreakpoint.spaceBetween;
          }
        }

        this.recalculateVisibleSlides();
      },

      registerSlide(el: HTMLElement, index?: number): number {
        const actualIndex = index ?? (slidesMap.size > 0 ? Math.max(...Array.from(slidesMap.keys())) + 1 : 0);

        slidesMap.set(actualIndex, {
          el,
          index: actualIndex,
          width: el.offsetWidth || 0,
          position: 0,
        });

        resizeObserver?.observe(el);

        this.recalculateVisibleSlides();

        return actualIndex;
      },

      unregisterSlide(index: number) {
        const slide = slidesMap.get(index);
        if (slide) {
          resizeObserver?.unobserve(slide.el);
          slidesMap.delete(index);
          this.recalculateVisibleSlides();
        }
      },

      updateSlideWidth(index: number, width: number) {
        const slide = slidesMap.get(index);
        if (slide) {
          slide.width = width;
          this.recalculateVisibleSlides();
        }
      },

      isSlideVisible(index: number): boolean {
        if (!viewportEl) return false;

        const scrollLeft = viewportEl.scrollLeft;
        const scrollRight = scrollLeft + viewportEl.clientWidth;

        const position = this.calculateScrollPosition(index);
        const slide = slidesMap.get(index);
        const slideRight = position + (slide?.width || 0);

        return position < scrollRight && slideRight > scrollLeft;
      },

      onPointerDown(e: PointerEvent) {
        if (!config.draggable || !viewportEl) {
          return;
        }

        isDragging = true;
        dragStartX = e.clientX;
        dragStartScrollLeft = viewportEl.scrollLeft;
        dragVelocity = 0;
        lastDragTime = Date.now();
        lastDragX = e.clientX;

        viewportEl.style.scrollSnapType = 'none';
        viewportEl.style.scrollBehavior = 'auto';
      },

      onPointerMove(e: PointerEvent) {
        if (!isDragging || !viewportEl) {
          return;
        }

        const currentTime = Date.now();
        const deltaTime = currentTime - lastDragTime;
        const deltaX = e.clientX - lastDragX;

        if (deltaTime > 0) {
          dragVelocity = deltaX / deltaTime;
        }

        const distance = dragStartX - e.clientX;
        let newScrollLeft = dragStartScrollLeft + distance;

        if (config.resistance && !config.loop) {
          const maxScroll = viewportEl.scrollWidth - viewportEl.clientWidth;
          if (newScrollLeft < 0) {
            newScrollLeft = newScrollLeft * 0.3;
          } else if (newScrollLeft > maxScroll) {
            newScrollLeft = maxScroll + (newScrollLeft - maxScroll) * 0.3;
          }
        }

        viewportEl.scrollLeft = newScrollLeft;

        lastDragTime = currentTime;
        lastDragX = e.clientX;
      },

      onPointerUp() {
        if (!isDragging || !viewportEl) {
          return;
        }

        isDragging = false;

        const distance = Math.abs(dragStartScrollLeft - viewportEl.scrollLeft);

        if (distance > config.threshold && !config.freeMode && config.snapToSlides) {
          const momentum = dragVelocity * 50;
          const targetScrollLeft = viewportEl.scrollLeft + momentum;

          const slides = Array.from(slidesMap.values()).sort((a, b) => a.index - b.index);
          let closestIndex = 0;
          let minDist = Infinity;

          slides.forEach((slide, idx) => {
            const slidePosition = this.calculateScrollPosition(idx);
            const dist = Math.abs(targetScrollLeft - slidePosition);
            if (dist < minDist) {
              minDist = dist;
              closestIndex = idx;
            }
          });

          this.goTo(closestIndex, true);
        }

        if (config.snapToSlides) {
          viewportEl.style.scrollSnapType = '';
          viewportEl.style.scrollBehavior = '';
        }
      },

      startAutoplay() {
        if (!config.autoplay || autoplayTimer) {
          return;
        }

        autoplayTimer = setInterval(() => {
          if (!this.isAutoplayPaused) {
            this.next();
          }
        }, config.autoplay.delay);
      },

      stopAutoplay() {
        if (autoplayTimer) {
          clearInterval(autoplayTimer);
          autoplayTimer = null;
        }
      },

      pauseAutoplay() {
        this.isAutoplayPaused = true;
      },

      resumeAutoplay() {
        this.isAutoplayPaused = false;
      },

      onKeydown(e: KeyboardEvent) {
        if (!config.keyboard) {
          return;
        }

        switch (e.key) {
          case 'ArrowLeft':
            e.preventDefault();
            this.prev();
            break;
          case 'ArrowRight':
            e.preventDefault();
            this.next();
            break;
          case 'Home':
            e.preventDefault();
            this.goTo(0);
            break;
          case 'End':
            e.preventDefault();
            this.goTo(this.totalSlides - 1);
            break;
        }
      },

      announceSlide(index: number) {
        const announcement = `Slide ${index + 1} of ${this.totalSlides}`;
        const liveRegion = document.createElement('div');
        liveRegion.setAttribute('role', 'status');
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'sr-only';
        liveRegion.textContent = announcement;
        document.body.appendChild(liveRegion);
        setTimeout(() => liveRegion.remove(), 1000);
      },

      updateActiveIndexFromScroll() {
        if (!viewportEl) return;

        const scrollLeft = viewportEl.scrollLeft;
        const slides = Array.from(slidesMap.values()).sort((a, b) => a.index - b.index);

        let closestIndex = 0;
        let minDist = Infinity;

        slides.forEach((slide, idx) => {
          const slidePosition = this.calculateScrollPosition(idx);
          const dist = Math.abs(scrollLeft - slidePosition);
          if (dist < minDist) {
            minDist = dist;
            closestIndex = idx;
          }
        });

        if (this.activeIndex !== closestIndex) {
          this.activeIndex = closestIndex;
          this.$dispatch('slidechange', { index: closestIndex });
        }

        const maxScroll = viewportEl.scrollWidth - viewportEl.clientWidth;
        this.isAtStart = scrollLeft <= 0;
        this.isAtEnd = scrollLeft >= maxScroll;
      },

      init() {
        viewportEl = this.$el.querySelector('[x-carousel\\:viewport]') as HTMLElement;

        if (!viewportEl) {
          console.warn('Carousel: viewport element not found');
          return;
        }

        resizeObserver = new ResizeObserver((entries) => {
          for (const entry of entries) {
            if (entry.target === viewportEl) {
              this.updateViewportSize();
            } else {
              const slideData = Array.from(slidesMap.values()).find((s) => s.el === entry.target);
              if (slideData) {
                this.updateSlideWidth(slideData.index, entry.contentRect.width);
              }
            }
          }
        });

        resizeObserver.observe(viewportEl);

        intersectionObserver = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              const slideData = Array.from(slidesMap.values()).find((s) => s.el === entry.target);
              if (slideData) {
                this.$dispatch('slide:visibility', {
                  index: slideData.index,
                  isVisible: entry.isIntersecting,
                });
              }
            });
          },
          {
            root: viewportEl,
            threshold: 0.5,
          }
        );

        viewportEl.addEventListener('scroll', () => {
          if (!isDragging) {
            this.updateActiveIndexFromScroll();
          }
        });

        this.updateViewportSize();

        if (Object.keys(config.breakpoints).length > 0) {
          this.applyBreakpoints();

          const resizeHandler = debounce(() => this.applyBreakpoints(), 150);
          window.addEventListener('resize', resizeHandler);
        }

        if (config.autoplay) {
          this.startAutoplay();
        }

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) {
          config.speed = 0;
        }
      },

      destroy() {
        resizeObserver?.disconnect();
        intersectionObserver?.disconnect();
        this.stopAutoplay();
      },
    };
  }),

  parts: ({ withScopes }) =>
    withScopes<CarouselScopes>({
      viewport(api, el) {
        return {
          role: 'region',
          'aria-label': 'Carousel',
          'x-init'() {
            el.style.setProperty('--slide-width', api.computedSlideWidth);
            el.style.setProperty('--carousel-space-between', '16px');

            document.addEventListener('visual:block:updated', (data: any) => {
              if (api.id && data.detail.blockId === api.id) {
                this.$nextTick(() => {
                  const updatedApi = (window as any).Alpine.$data(el);

                  api.slidesPerView = updatedApi.slidesPerView;
                  api.spaceBetween = updatedApi.spaceBetween;

                  el.style.setProperty('--slide-width', api.computedSlideWidth);
                  el.style.setProperty('--carousel-space-between', `${api.spaceBetween}px`);
                });
              }
            });
          },
          'x-effect'() {
            el.style.setProperty('--slide-width', api.computedSlideWidth);
          },
          'x-on:pointerdown': (e: PointerEvent) => api.onPointerDown(e),
          'x-on:pointermove': (e: PointerEvent) => api.onPointerMove(e),
          'x-on:pointerup': () => api.onPointerUp(),
          'x-on:pointercancel': () => api.onPointerUp(),
          'x-on:keydown': (e: KeyboardEvent) => api.onKeydown(e),
          'x-on:mouseenter': () => api.pauseAutoplay(),
          'x-on:mouseleave': () => api.resumeAutoplay(),
          'x-on:focusin': () => api.pauseAutoplay(),
          'x-on:focusout': () => api.resumeAutoplay(),
          tabindex: 0,
        };
      },

      slide: defineScope({
        name: 'slide',
        setup(api, el, { value, cleanup }) {
          const index = api.registerSlide(
            el,
            value !== undefined && value !== null && value !== '' ? Number(value) : undefined
          );

          cleanup(() => {
            api.unregisterSlide(index);
          });

          return {
            index,

            get isActive() {
              return api.activeIndex === index;
            },

            get isPrev() {
              return api.activeIndex - 1 === index;
            },

            get isNext() {
              return api.activeIndex + 1 === index;
            },

            get isVisible() {
              return api.isSlideVisible(index);
            },

            activate() {
              api.goTo(index);
            },
          };
        },

        bindings(_, scope) {
          return {
            'x-bind:data-active': () => scope.isActive || null,
            'x-bind:data-prev': () => scope.isPrev || null,
            'x-bind:data-next': () => scope.isNext || null,
            'x-bind:data-visible': () => scope.isVisible || null,
            'x-bind:data-index': () => scope.index,
            'x-on:click': () => scope.activate(),
            role: 'group',
            'aria-roledescription': 'slide',
            'x-bind:aria-label': () => `Slide ${scope.index + 1}`,
          };
        },
      }),

      prevButton(api) {
        return {
          type: 'button',
          'x-on:click': () => api.prev(),
          'x-bind:disabled': () => !api.canGoPrev,
          'x-bind:aria-label': () => 'Previous slide',
          'aria-controls': 'carousel-viewport',
        };
      },

      nextButton(api) {
        return {
          type: 'button',
          'x-on:click': () => api.next(),
          'x-bind:disabled': () => !api.canGoNext,
          'x-bind:aria-label': () => 'Next slide',
          'aria-controls': 'carousel-viewport',
        };
      },

      pagination: defineScope({
        name: 'pagination',
        setup(api, el, { value }) {
          const index = value !== undefined && value !== null && value !== '' ? Number(value) : 0;

          return {
            index,

            get isActive() {
              return api.activeIndex === index;
            },

            get label() {
              return `${index + 1}`;
            },

            goTo() {
              api.goTo(index);
            },
          };
        },

        bindings(_, scope) {
          return {
            type: 'button',
            'x-on:click': () => scope.goTo(),
            'x-bind:data-active': () => scope.isActive || null,
            'x-bind:aria-label': () => `Go to slide ${scope.index + 1}`,
            'x-bind:aria-current': () => (scope.isActive ? 'true' : null),
          };
        },
      }),

      paginationFraction(api) {
        return {
          'x-text': () => `${api.activeIndex + 1} / ${api.totalSlides}`,
          'aria-live': 'polite',
          'aria-atomic': 'true',
        };
      },

      paginationProgress(api) {
        return {
          role: 'progressbar',
          'x-bind:aria-valuenow': () => api.progress,
          'aria-valuemin': 0,
          'aria-valuemax': 100,
          'x-bind:style': () => `width: ${api.progress}%`,
        };
      },
    }),
});
