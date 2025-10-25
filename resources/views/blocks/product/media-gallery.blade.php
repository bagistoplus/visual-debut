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
    x-data
    x-media-gallery="{ medias: @js($medias) }"
    class="relative flex flex-col md:flex-row gap-4"
  >

    <!-- Scroll Up Button -->
    <button x-media-gallery:scroll-up-trigger class="absolute {{ $scrollButtonPosition }} top-2 z-10 flex h-6 w-6 items-center justify-center rounded-full bg-black/70 text-white">
      <x-lucide-chevron-up class="h-4 w-4" />
    </button>

    <!-- Scroll Down Button -->
    <button x-media-gallery:scroll-down-trigger class="absolute bottom-2 {{ $scrollButtonPosition }} z-10 flex h-6 w-6 items-center justify-center rounded-full bg-black/70 text-white">
      <x-lucide-chevron-down class="h-4 w-4" />
    </button>

    <div x-media-gallery:thumbs class="{{ $thumbsClasses }}">
      <template x-for="(media, index) in medias" :key="index">
        <button
          x-media-gallery:thumb="index"
          class="aspect-square w-20 flex-shrink-0 overflow-hidden rounded-lg bg-neutral-100 focus:outline-none"
          x-bind:class="{ 'border-2 border-primary': $thumb.isSelected }"
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

    <div class="flex aspect-square h-auto flex-1 items-center justify-center overflow-hidden {{ $mainImageMargin }}">
      <template x-if="selectedMedia.type !== 'videos'">
        <img
          :src="selectedMedia.large_image_url"
          alt="Rose Quartz Face Serum"
          class="aspect-square h-full w-full rounded-lg object-cover object-center"
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
