import { defineScope, defineComponent, setup } from 'alpine-define-component';

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
 * - Keyboard navigation
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
  // Layout
  slidesPerView?: number | 'auto';
  spaceBetween?: number;
  centeredSlides?: boolean;
  loop?: boolean;

  // Navigation
  navigation?: boolean;
  pagination?: 'dots' | 'fraction' | 'progress' | false;
  keyboard?: boolean;
  mousewheel?: boolean;

  // Interaction
  draggable?: boolean;
  freeMode?: boolean;
  snapToSlides?: boolean;
  threshold?: number;
  resistance?: boolean;

  // Autoplay
  autoplay?: boolean | AutoplayConfig;
  speed?: number;

  // Responsive
  breakpoints?: {
    [width: number]: Partial<Props>;
  };

  // Accessibility
  a11y?: A11yConfig;
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
    // Element references
    let viewportEl: HTMLElement | null = null;
    let resizeObserver: ResizeObserver | null = null;
    let intersectionObserver: IntersectionObserver | null = null;
    let autoplayTimer: ReturnType<typeof setInterval> | null = null;
    let breakpointListener: ((e: MediaQueryListEvent) => void) | null = null;

    // Slide management
    const slidesMap = new Map<number, SlideData>();

    // Drag state
    let isDragging = false;
    let dragStartX = 0;
    let dragStartScrollLeft = 0;
    let dragVelocity = 0;
    let lastDragTime = 0;
    let lastDragX = 0;

    // Configuration with defaults
    const config = {
      slidesPerView: props.slidesPerView ?? 1,
      spaceBetween: props.spaceBetween ?? 0,
      centeredSlides: props.centeredSlides ?? false,
      loop: props.loop ?? false,
      navigation: props.navigation ?? true,
      pagination: props.pagination ?? 'dots',
      keyboard: props.keyboard ?? true,
      mousewheel: props.mousewheel ?? false,
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
    };

    return {
      // State
      activeIndex: 0,
      viewportWidth: 0,
      visibleSlidesCount: 1,
      isAtStart: true,
      isAtEnd: false,
      isAutoplayPaused: false,

      // Computed
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

      // Core navigation
      goTo(index: number, smooth = true) {
        if (!viewportEl || this.totalSlides === 0) return;

        let targetIndex = index;

        // Handle bounds
        if (config.loop) {
          targetIndex = ((index % this.totalSlides) + this.totalSlides) % this.totalSlides;
        } else {
          targetIndex = Math.max(0, Math.min(this.totalSlides - 1, index));
        }

        this.activeIndex = targetIndex;

        // Scroll to slide
        const slide = Array.from(slidesMap.values()).find((s) => s.index === targetIndex);
        if (slide) {
          const scrollLeft = this.calculateScrollPosition(targetIndex);
          viewportEl.scrollTo({
            left: scrollLeft,
            behavior: smooth ? 'smooth' : 'auto',
          });
        }

        this.$dispatch('slidechange', { index: targetIndex });

        // Announce to screen readers
        if (config.a11y.enabled) {
          this.announceSlide(targetIndex);
        }
      },

      next() {
        if (!this.canGoNext) return;
        this.goTo(this.activeIndex + 1);
      },

      prev() {
        if (!this.canGoPrev) return;
        this.goTo(this.activeIndex - 1);
      },

      // Calculate scroll position for a slide index
      calculateScrollPosition(index: number): number {
        const slides = Array.from(slidesMap.values()).sort((a, b) => a.index - b.index);

        if (index === 0) return 0;
        if (index >= slides.length) return viewportEl?.scrollWidth ?? 0;

        let position = 0;
        for (let i = 0; i < index && i < slides.length; i++) {
          position += slides[i].width + config.spaceBetween;
        }

        return position;
      },

      // Update viewport width and recalculate visible slides
      updateViewportSize() {
        if (!viewportEl) return;

        this.viewportWidth = viewportEl.clientWidth;
        this.recalculateVisibleSlides();
      },

      // Recalculate how many slides are visible
      recalculateVisibleSlides() {
        if (config.slidesPerView !== 'auto') {
          this.visibleSlidesCount = config.slidesPerView as number;
          return;
        }

        // Dynamic calculation based on slide widths
        const slides = Array.from(slidesMap.values()).sort((a, b) => a.index - b.index);
        if (slides.length === 0) return;

        let totalWidth = 0;
        let count = 0;

        for (const slide of slides) {
          if (totalWidth + slide.width <= this.viewportWidth) {
            totalWidth += slide.width + (count > 0 ? config.spaceBetween : 0);
            count++;
          } else {
            break;
          }
        }

        this.visibleSlidesCount = Math.max(1, count);
      },

      // Register a slide
      registerSlide(el: HTMLElement, index?: number): number {
        // Calculate next available index if not provided
        const actualIndex = index ?? (slidesMap.size > 0 ? Math.max(...slidesMap.keys()) + 1 : 0);

        slidesMap.set(actualIndex, {
          el,
          index: actualIndex,
          width: el.offsetWidth || 0,
          position: 0,
        });

        // Observe slide size changes
        resizeObserver?.observe(el);

        this.recalculateVisibleSlides();

        return actualIndex;
      },

      // Unregister a slide
      unregisterSlide(index: number) {
        const slide = slidesMap.get(index);
        if (slide) {
          resizeObserver?.unobserve(slide.el);
          slidesMap.delete(index);
          this.recalculateVisibleSlides();
        }
      },

      // Update slide width
      updateSlideWidth(index: number, width: number) {
        const slide = slidesMap.get(index);
        if (slide) {
          slide.width = width;
          this.recalculateVisibleSlides();
        }
      },

      // Check if slide is visible in viewport
      isSlideVisible(index: number): boolean {
        if (!viewportEl) return false;

        const scrollLeft = viewportEl.scrollLeft;
        const scrollRight = scrollLeft + viewportEl.clientWidth;

        const position = this.calculateScrollPosition(index);
        const slide = slidesMap.get(index);
        const slideRight = position + (slide?.width || 0);

        return position < scrollRight && slideRight > scrollLeft;
      },

      // Drag handlers
      onPointerDown(e: PointerEvent) {
        if (!config.draggable || !viewportEl) return;

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
        if (!isDragging || !viewportEl) return;

        const currentTime = Date.now();
        const deltaTime = currentTime - lastDragTime;
        const deltaX = e.clientX - lastDragX;

        if (deltaTime > 0) {
          dragVelocity = deltaX / deltaTime;
        }

        const distance = dragStartX - e.clientX;
        let newScrollLeft = dragStartScrollLeft + distance;

        // Apply resistance at boundaries
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
        if (!isDragging || !viewportEl) return;

        isDragging = false;

        const distance = Math.abs(dragStartScrollLeft - viewportEl.scrollLeft);

        // Snap to nearest slide if threshold met and not in free mode
        if (distance > config.threshold && !config.freeMode && config.snapToSlides) {
          const momentum = dragVelocity * 50; // Velocity multiplier
          const targetScrollLeft = viewportEl.scrollLeft + momentum;

          // Find nearest slide
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

        // Re-enable snap
        if (config.snapToSlides) {
          viewportEl.style.scrollSnapType = '';
          viewportEl.style.scrollBehavior = '';
        }
      },

      // Autoplay
      startAutoplay() {
        if (!config.autoplay || autoplayTimer) return;

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

      // Keyboard navigation
      onKeydown(e: KeyboardEvent) {
        if (!config.keyboard) return;

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

      // Accessibility
      announceSlide(index: number) {
        const announcement = `Slide ${index + 1} of ${this.totalSlides}`;
        // Create a live region announcement
        const liveRegion = document.createElement('div');
        liveRegion.setAttribute('role', 'status');
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'sr-only';
        liveRegion.textContent = announcement;
        document.body.appendChild(liveRegion);
        setTimeout(() => liveRegion.remove(), 1000);
      },

      // Update active index based on scroll position
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

        // Update boundary states
        const maxScroll = viewportEl.scrollWidth - viewportEl.clientWidth;
        this.isAtStart = scrollLeft <= 0;
        this.isAtEnd = scrollLeft >= maxScroll;
      },

      // Lifecycle
      init() {
        viewportEl = this.$el.querySelector('[x-carousel\\:viewport]') as HTMLElement;

        if (!viewportEl) {
          console.warn('Carousel: viewport element not found');
          return;
        }

        // Setup ResizeObserver for viewport
        resizeObserver = new ResizeObserver((entries) => {
          for (const entry of entries) {
            if (entry.target === viewportEl) {
              this.updateViewportSize();
            } else {
              // It's a slide
              const slideData = Array.from(slidesMap.values()).find((s) => s.el === entry.target);
              if (slideData) {
                this.updateSlideWidth(slideData.index, entry.contentRect.width);
              }
            }
          }
        });

        resizeObserver.observe(viewportEl);

        // Setup IntersectionObserver for slide visibility
        intersectionObserver = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              const slideData = Array.from(slidesMap.values()).find((s) => s.el === entry.target);
              if (slideData) {
                // Can dispatch visibility change event if needed
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

        // Scroll event listener
        viewportEl.addEventListener('scroll', () => {
          if (!isDragging) {
            this.updateActiveIndexFromScroll();
          }
        });

        // Initial calculations
        this.updateViewportSize();

        // Start autoplay
        if (config.autoplay) {
          this.startAutoplay();
        }

        // Reduced motion support
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) {
          config.speed = 0;
        }
      },

      destroy() {
        resizeObserver?.disconnect();
        intersectionObserver?.disconnect();
        this.stopAutoplay();

        if (breakpointListener) {
          // Clean up media query listeners
          // (Would need to store MediaQueryList references for proper cleanup)
        }
      },
    };
  }),

  parts: ({ withScopes }) =>
    withScopes<CarouselScopes>({
      viewport(api) {
        return {
          role: 'region',
          'aria-label': 'Carousel',
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
          const index = api.registerSlide(el, value !== undefined && value !== null && value !== '' ? Number(value) : undefined);

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
