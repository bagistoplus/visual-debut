@props(['icon'])

@php
  $props = [
      'uploadUrl' => route('shop.search.upload'),
      'searchUrl' => route('shop.search.index'),
      'messages' => [
          'invalidFileType' => trans('shop::app.search.images.index.only-images-allowed'),
          'fileTooLarge' => trans('shop::app.search.images.index.size-limit-error'),
          'uploadFailed' => trans('shop::app.search.images.index.something-went-wrong'),
          'analysisFailed' => trans('shop::app.search.images.index.something-went-wrong'),
          'libraryLoadFailed' => trans('shop::app.search.images.index.something-went-wrong'),
      ],
  ];
@endphp

<div
  x-data="VisualImageSearch(@js($props))"
  {{ $attributes->merge(['class' => 'flex items-center']) }}
>
  <button
    type="button"
    x-bind:disabled="isSearching"
    x-on:click="$refs.fileInput.click()"
    aria-label="@lang('shop::app.search.images.index.search')"
    class="hover:text-primary transition-colors"
    x-bind:class="{ 'cursor-not-allowed': isSearching }"
  >
    @svg($icon, ['x-show' => '!isSearching', 'class' => 'h-5 w-5'])
    <x-lucide-loader-2 x-show="isSearching" class="h-5 w-5 animate-spin" />
  </button>

  <input
    type="file"
    accept="image/*"
    class="hidden"
    x-ref="fileInput"
    x-on:change="handleImageSelection($event)"
  />

  <img
    x-ref="preview"
    x-bind:src="uploadedImageUrl"
    class="hidden"
    alt="{{ trans('visual-debut::shop.review.uploaded-image') }}"
    width="20"
    height="20"
  />
</div>
