@php
  $sticky = $block->settings->sticky ?? true;
  $zoom = $block->settings->zoom ?? true;

  // Sticky positioning classes
  $positionClass = $sticky ? 'sticky top-4 self-start' : '';

  // Determine positioning classes based on thumbnail position
  $isEnd = $thumbnailPosition === 'end';

  $thumbsClasses = $isEnd
      ? 'order-last flex flex-row gap-4 overflow-y-hidden md:absolute md:inset-y-0 md:end-0 md:order-last md:flex-col'
      : 'order-last flex flex-row gap-4 overflow-y-hidden md:absolute md:inset-y-0 md:start-0 md:order-first md:flex-col';

  $scrollButtonPosition = $isEnd ? 'end-7' : 'start-7';

  $mainImageMargin = $isEnd ? 'md:me-24' : 'md:ms-24';
@endphp

<div {{ $block->editor_attributes }} class="{{ $positionClass }}">
  <div
    x-data="VisualMediaGallery({ medias: @js($medias) })"
    class="relative flex flex-col gap-4 md:flex-row"
  >

    <!-- Scroll Up Button -->
    <button
      type="button"
      x-show="hasOverflowAbove"
      x-on:click="scrollThumbs('up')"
      class="{{ $scrollButtonPosition }} absolute top-2 z-10 flex h-6 w-6 items-center justify-center rounded-full bg-black/70 text-white"
    >
      <x-lucide-chevron-up class="h-4 w-4" />
    </button>

    <!-- Scroll Down Button -->
    <button
      type="button"
      x-show="hasOverflowBelow"
      x-on:click="scrollThumbs('down')"
      class="{{ $scrollButtonPosition }} absolute bottom-2 z-10 flex h-6 w-6 items-center justify-center rounded-full bg-black/70 text-white"
    >
      <x-lucide-chevron-down class="h-4 w-4" />
    </button>

    <div
      x-ref="thumbs"
      x-on:scroll="checkOverflow()"
      class="{{ $thumbsClasses }}"
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
          class="aspect-square w-20 shrink-0 overflow-hidden rounded-(--box-radius) bg-on-background/5 focus:outline-none"
          x-bind:class="{ 'border-2 border-primary': isSelected(index) }"
        >
          <template x-if="media.type !== 'videos'">
            <img
              x-bind:src="media.small_image_url"
              x-bind:alt="media.small_image_url"
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

    <div class="{{ $mainImageMargin }} flex aspect-square h-auto flex-1 items-center justify-center overflow-hidden">
      <template x-if="selectedMedia.type !== 'videos'">
        <img
          :src="selectedMedia.large_image_url"
          x-bind:alt="selectedMedia.large_image_url"
          class="aspect-square h-full w-full rounded-(--box-radius) object-cover object-center"
          fetchpriority="high"
        >
      </template>
      <template x-if="selectedMedia.type === 'videos'">
        <video
          controls
          autoplay
          :alt="selectedMedia.video_url"
          class="h-full"
        >
          <source :src="selectedMedia.video_url" />
        </video>
      </template>
    </div>
  </div>
</div>
