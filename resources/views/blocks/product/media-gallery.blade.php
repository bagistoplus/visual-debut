@php
  $sticky = $block->settings->sticky ?? true;
  $zoom = $block->settings->zoom ?? true;
  $constrain = $block->settings->constrain_to_viewport ?? true;

  // Sticky positioning classes
  $positionClass = $sticky ? 'sticky top-4 self-start' : '';

  // Adapt keeps the image's own ratio, which the width and height attributes give before it loads
  $aspectClass = match ($block->settings->aspect_ratio ?? 'adapt') {
      'square' => 'aspect-square',
      'portrait' => 'aspect-[2/3]',
      'landscape' => 'aspect-[3/2]',
      default => '',
  };

  $fitClass = ($block->settings->media_fit ?? 'contain') === 'cover' ? 'object-cover' : 'object-contain';

  // The sticky offset is top-4, so the media fits the window below it
  $heightClass = $constrain ? 'max-h-[calc(100dvh-2rem)]' : '';

  $mediaClasses = "{$aspectClass} {$fitClass} {$heightClass} h-auto w-full rounded-(--box-radius) object-center";

  // Determine positioning classes based on thumbnail position
  $isEnd = $thumbnailPosition === 'end';

  $thumbsClasses = $isEnd
      ? 'order-last flex flex-row gap-4 overflow-y-hidden md:absolute md:inset-y-0 md:end-0 md:order-last md:flex-col'
      : 'order-last flex flex-row gap-4 overflow-y-hidden md:absolute md:inset-y-0 md:start-0 md:order-first md:flex-col';

  $scrollButtonPosition = $isEnd ? 'end-7' : 'start-7';

  $mainImageMargin = $isEnd ? 'md:me-24' : 'md:ms-24';

  // The first image is in the server HTML, so the browser finds the page's largest image without waiting for Alpine.
  $firstImage = ($medias[0]['type'] ?? null) === 'image' ? $medias[0]['large_image_url'] : null;

  $mainTag = $zoom ? 'button' : 'div';

  $viewerControlClass = 'inline-flex size-10 shrink-0 items-center justify-center rounded-full bg-white/15 text-white transition-colors hover:bg-white/25';
@endphp

<div {{ $block->editor_attributes }} class="{{ $positionClass }}">
  <div x-data="VisualMediaGallery({ medias: @js($medias) })" class="relative flex flex-col gap-4 md:flex-row">

    <!-- Scroll Up Button -->
    <button
      type="button"
      x-show="hasOverflowAbove"
      x-cloak
      x-on:click="scrollThumbs('up')"
      class="{{ $scrollButtonPosition }} absolute top-2 z-10 flex h-6 w-6 items-center justify-center rounded-full bg-black/70 text-white"
    >
      <x-lucide-chevron-up class="h-4 w-4" />
    </button>

    <!-- Scroll Down Button -->
    <button
      type="button"
      x-show="hasOverflowBelow"
      x-cloak
      x-on:click="scrollThumbs('down')"
      class="{{ $scrollButtonPosition }} absolute bottom-2 z-10 flex h-6 w-6 items-center justify-center rounded-full bg-black/70 text-white"
    >
      <x-lucide-chevron-down class="h-4 w-4" />
    </button>

    <div
      x-ref="thumbs"
      x-on:scroll="checkOverflow()"
      @class([$thumbsClasses, 'min-h-20 md:min-h-0' => count($medias) > 1])
    >
      <template x-for="(media, index) in medias" :key="index">
        <button
          type="button"
          data-thumb
          x-on:click="select(index)"
          x-on:keydown="onThumbKeydown($event)"
          x-bind:tabindex="isSelected(index) ? 0 : -1"
          x-bind:aria-current="isSelected(index) ? 'true' : null"
          x-bind:data-selected="isSelected(index) ? 'true' : null"
          class="rounded-(--box-radius) bg-on-background/5 aspect-square w-20 shrink-0 overflow-hidden focus:outline-none"
          x-bind:class="{ 'border-2 border-primary': isSelected(index) }"
        >
          <template x-if="media.type !== 'videos'">
            <img
              x-bind:src="media.small_image_url"
              alt="{{ $productName }}"
              class="h-full w-full object-cover object-center"
            >
          </template>
          <template x-if="media.type === 'videos'">
            <div class="relative h-full">
              <x-lucide-play-circle class="absolute left-1/2 top-1/2 h-8 w-8 -translate-x-1/2 -translate-y-1/2 transform text-gray-400/50" />
              <video
                muted
                height="100%"
                x-bind:alt="media.video_url"
              >
                <source x-bind:src="media.video_url" />
              </video>
            </div>
          </template>
        </button>
      </template>
    </div>

    <div class="{{ $mainImageMargin }} flex h-auto flex-1 items-center justify-center overflow-hidden">
      <{{ $mainTag }}
        @if ($zoom) type="button"
          x-on:click="openViewer(selectedIndex)"
          aria-label="{{ trans('visual-debut::shop.media-viewer.open') }}" @endif
        x-show="selectedMedia && selectedMedia.type !== 'videos'"
        @unless ($firstImage) style="display: none" @endunless
        @class(['block w-full', 'cursor-zoom-in' => $zoom])
      >
        <img
          @if ($firstImage) src="{{ $firstImage }}" @endif
          x-bind:src="selectedMedia?.large_image_url"
          alt="{{ $productName }}"
          width="{{ $imageWidth }}"
          height="{{ $imageHeight }}"
          class="{{ $mediaClasses }}"
          fetchpriority="high"
        >
        </{{ $mainTag }}>
        <template x-if="selectedMedia?.type === 'videos'">
          <video
            controls
            autoplay
            :alt="selectedMedia.video_url"
            class="{{ $mediaClasses }}"
          >
            <source :src="selectedMedia.video_url" />
          </video>
        </template>
    </div>

    @if ($zoom)
      {{-- Mounted on the first open. Livewire leaves it alone, so an update to the section cannot drop an open viewer.
           Absolute, so it takes no place or gap in the gallery's row --}}
      <div wire:ignore class="absolute">
        <template x-if="viewerMounted">
          <ui-dialog
            top-layer
            x-on:ui-dialog:open-change="$event.detail.open || closeViewer()"
            x-effect="viewerOpen ? $el.show() : $el.hide()"
          >
            <ui-dialog-backdrop class="data-[state=open]:animate-fade-in data-[state=closed]:animate-fade-out z-1000 fixed inset-0 bg-black/90"></ui-dialog-backdrop>

            <ui-dialog-positioner class="z-1100 fixed inset-0 flex">
              {{-- On the window, because focus can leave the dialog (a zoom trigger it disables). A zoomed image keeps the arrows to pan --}}
              <ui-dialog-content
                x-on:keydown.left.window="viewerOpen && arrow('left')"
                x-on:keydown.right.window="viewerOpen && arrow('right')"
                class="data-[state=open]:animate-fade-in data-[state=closed]:animate-fade-out relative flex w-full flex-col gap-4 p-4 text-white"
              >
                <ui-dialog-title delegate>
                  <h2 class="sr-only">{{ trans('visual-debut::shop.media-viewer.title') }}</h2>
                </ui-dialog-title>

                <div class="flex items-center justify-end gap-2">
                  <span class="me-auto text-sm font-medium" x-text="`${viewerIndex + 1} / ${viewerImages.length}`"></span>

                  <ui-dialog-close-trigger delegate>
                    <button
                      type="button"
                      aria-label="{{ trans('visual-debut::shop.close') }}"
                      class="{{ $viewerControlClass }}"
                    >
                      <x-lucide-x class="size-5" />
                    </button>
                  </ui-dialog-close-trigger>
                </div>

                <div class="relative flex min-h-0 flex-1 items-center justify-center">
                  {{-- Keyed by the index, so moving to another image starts it unzoomed --}}
                  <template x-for="media in [viewerImage]" :key="viewerIndex">
                    <div class="absolute inset-0 flex items-center justify-center">
                      <template x-if="media">
                        {{-- A click zooms in at the pointer and out again, a drag pans, the wheel and a pinch zoom --}}
                        <ui-image-zoom x-on:ui-image-zoom:swipe="step($event.detail.direction === 'next' ? 1 : -1)" class="flex size-full items-center justify-center">
                          <ui-image-zoom-viewport class="flex size-full items-center justify-center overflow-hidden">
                            <ui-image-zoom-image delegate>
                              <img
                                x-bind:src="media.original_image_url || media.large_image_url"
                                alt="{{ $productName }}"
                                class="max-h-full max-w-full object-contain"
                              >
                            </ui-image-zoom-image>
                          </ui-image-zoom-viewport>
                        </ui-image-zoom>
                      </template>
                    </div>
                  </template>

                  <button
                    type="button"
                    x-show="viewerImages.length > 1"
                    x-on:click="step(-1)"
                    aria-label="{{ trans('visual-debut::shop.previous') }}"
                    class="{{ $viewerControlClass }} inset-s-2 absolute top-1/2 z-20 -translate-y-1/2"
                  >
                    <x-lucide-chevron-left class="size-5 rtl:rotate-180" />
                  </button>

                  <button
                    type="button"
                    x-show="viewerImages.length > 1"
                    x-on:click="step(1)"
                    aria-label="{{ trans('visual-debut::shop.next') }}"
                    class="{{ $viewerControlClass }} inset-e-2 absolute top-1/2 z-20 -translate-y-1/2"
                  >
                    <x-lucide-chevron-right class="size-5 rtl:rotate-180" />
                  </button>
                </div>

                <div x-show="viewerImages.length > 1" class="flex shrink-0 justify-center gap-2 overflow-x-auto">
                  <template x-for="(media, index) in viewerImages" :key="index">
                    <button
                      type="button"
                      x-on:click="viewerIndex = index"
                      x-bind:aria-current="viewerIndex === index ? 'true' : null"
                      x-bind:aria-label="@js(trans('visual-debut::shop.media-viewer.thumbnail', ['index' => ':index'])).replace(':index', index + 1)"
                      class="rounded-(--box-radius) size-16 shrink-0 overflow-hidden border-2 border-transparent transition-colors"
                      x-bind:class="{ 'border-white!': viewerIndex === index }"
                    >
                      <img
                        x-bind:src="media.small_image_url"
                        alt=""
                        class="h-full w-full object-cover object-center"
                      >
                    </button>
                  </template>
                </div>
              </ui-dialog-content>
            </ui-dialog-positioner>
          </ui-dialog>
        </template>
      </div>
    @endif
  </div>
</div>
