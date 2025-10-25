<div {{ $section->editor_attributes }} x-data="{ showReviewForm: $wire.entangle('showReviewForm') }" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
  <div x-show="!showReviewForm">
    @if (count($reviews) > 0)
      <h2 class="mb-8 font-serif text-2xl">
        @lang('shop::app.products.view.reviews.customer-review')
        ({{ $totalReviews }})
      </h2>

      <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="lg:col-span-1">
          <div class="bg-surface text-on-surface border-on-surface/7 box shadow-xs sticky top-4 border p-6">
            <div class="mb-6 text-center">
              <div class="mb-2 text-4xl font-medium">{{ $avgRatings }}</div>
              <div class="mb-2 flex justify-center">
                <x-shop::star-rating :rating="$avgRatings" />
              </div>
              <p class="">Based on {{ $totalReviews }} reviews</p>
            </div>
            <div class="space-y-3">
              @for ($i = 5; $i >= 1; $i--)
                <div class="flex items-center gap-4">
                  <div class="flex w-8 items-center gap-1">
                    <span class="text-sm">{{ $i }}</span>
                    <x-lucide-star class="fill-accent text-accent h-4 w-4" />
                  </div>
                  <div class="bg-surface-alt h-2 flex-1 overflow-hidden rounded-full">
                    <div class="bg-accent h-full" style="width: {{ $percentageRatings[$i] }}%;"></div>
                  </div>
                  <div class="w-10 text-right text-sm">
                    {{ $percentageRatings[$i] }}%
                  </div>
                </div>
              @endfor
            </div>

            @if ($this->showWriteReviewButton)
              <x-shop::ui.button
                icon="lucide-edit"
                variant="outline"
                x-on:click="showReviewForm = true"
                class="mt-6 w-full"
              >
                @lang('shop::app.products.view.reviews.write-a-review')
              </x-shop::ui.button>
            @endif
          </div>
        </div>

        <div class="lg:col-span-2">
          <div class="space-y-8">
            @foreach ($reviews as $review)
              <div class="bg-surface text-on-surface border-on-surface/7 shadow-xs box border p-6">
                <div class="mb-4 flex items-start justify-between">
                  <div class="flex items-center gap-4">
                    @if ($review['profile'])
                      <img
                        src="{{ $review['profile'] }}"
                        alt="{{ $review['name'] }}"
                        title="{{ $review['name'] }}"
                        class="box h-12 w-12 object-cover"
                      >
                    @else
                      <div class="box bg-surface-alt text-on-surface-alt flex h-12 w-12 items-center justify-center" title="{{ $review['name'] }}">
                        <span class="text-base font-semibold">{{ $review['initials'] }}</span>
                      </div>
                    @endif

                    <div>
                      <h3 class="font-medium">{{ $review['name'] }}</h3>
                      <div class="mt-1 flex items-center gap-2">
                        <x-shop::star-rating :rating="$review['rating']" />
                        <span class="text-sm">{{ $review['created_at'] }}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <h4 class="mb-2 font-medium">{{ $review['title'] }}</h4>
                <p class="mb-4">
                  {{ $review['comment'] }}
                </p>

                @if ($review['images']->isNotEmpty())
                  <div class="flex gap-4">
                    @foreach ($review['images'] as $media)
                      {{-- @dump($media->toArray()) --}}
                      <div class="bg-background box h-20 w-20 overflow-hidden">
                        @if ($media->type === 'image')
                          <img
                            src="{{ $media->url }}"
                            alt="{{ $review['title'] }}"
                            class="h-full w-full object-cover"
                          >
                        @else
                          <video
                            class="h-full w-full object-cover"
                            src="{{ $media->url }}"
                            alt="{{ $review['title'] }}"
                          >
                          </video>
                        @endif
                      </div>
                    @endforeach
                  </div>
                @endif
              </div>
            @endforeach

            @if ($canLoadMore)
              <div class="mt-4 flex items-center justify-center">
                <x-shop::ui.button
                  variant="outline"
                  wire:click="loadMore"
                  wire:target="loadMore"
                >
                  @lang('shop::app.products.view.reviews.load-more')
                </x-shop::ui.button>
              </div>
            @endif
          </div>
        </div>
      </div>
    @else
      <div class="flex flex-col items-center justify-center gap-6 py-8">
        <h2 class="mb-4 text-center font-serif text-2xl">
          @lang('shop::app.products.view.reviews.customer-review')
        </h2>

        <div>
          <x-lucide-star-off class="text-on-background/80 h-16 w-16" />
        </div>

        <p class="text-center text-xs md:text-sm xl:text-xl">
          @lang('shop::app.products.view.reviews.empty-review')
        </p>

        @if ($this->showWriteReviewButton)
          <x-shop::ui.button
            icon="lucide-edit"
            variant="outline"
            x-on:click="showReviewForm = true"
          >
            @lang('shop::app.products.view.reviews.write-a-review')
          </x-shop::ui.button>
        @endif
      </div>
    @endif
  </div>
  <div x-show="showReviewForm">
    <form
      enctype="multipart/form-data"
      class="mx-auto w-full max-w-xl space-y-4"
      wire:submit="storeReview"
    >
      <div>
        <label for="review">
          @lang('shop::app.products.view.reviews.rating')
        </label>
        <div
          x-rating="{value: 5}"
          class="flex gap-1"
          x-on:change="$wire.set('reviewForm.rating', $event.detail, false);"
        >
          <template x-for="i in 5" :key="i">
            <button x-rating:star="i" type="button">
              <x-lucide-star class="h-5 w-5"
                x-bind:class="{
                    'stroke-on-background': !$star.isActive,
                    'stroke-accent fill-accent': $star.isActive
                }"
              />
            </button>
          </template>
        </div>

        @error('reviewForm.rating')
          <p class="text-danger text-xs">{{ $message }}</p>
        @enderror
      </div>

      @if ($this->showReviewNameInput)
        <x-shop::ui.form.input
          required
          name="reviewForm.name"
          wire:model="reviewForm.name"
          :label="trans('shop::app.products.view.reviews.name')"
          :placeholder="trans('shop::app.products.view.reviews.name')"
        />
      @endif

      <x-shop::ui.form.input
        required
        name="reviewForm.title"
        wire:model="reviewForm.title"
        :label="trans('shop::app.products.view.reviews.title')"
        :placeholder="trans('shop::app.products.view.reviews.title')"
      />

      <x-shop::ui.form.textarea
        required
        rows="6"
        name="reviewForm.comment"
        wire:model="reviewForm.comment"
        :label="trans('shop::app.products.view.reviews.comment')"
        :placeholder="trans('shop::app.products.view.reviews.comment')"
      />

      <div>
        <label class="text-sm">
          @lang('shop::app.products.view.reviews.attachments')
        </label>
        <input
          type="file"
          accept="image/*,video/*"
          name="file"
          x-ref="fileInput"
          class="hidden"
          wire:model="reviewForm.file"
          multiple
        >

        <div class="mt-1 flex flex-wrap gap-2">
          @foreach ($reviewForm['attachments'] as $index => $attachment)
            <div class="box bg-surface-alt text-on-surface-alt group relative h-20 w-20 overflow-hidden">
              @if (str_starts_with($attachment->getMimeType(), 'image/'))
                <img class="h-full w-full object-cover object-center" src="{{ $attachment->temporaryUrl() }}">
              @else
              @endif
              <div class="absolute inset-0 hidden items-center justify-center bg-black/20 group-hover:flex">
                <button
                  type="button"
                  class="cursor-point"
                  wire:click="removeAttachment({{ $index }})"
                >
                  <x-lucide-trash class="text-on-background h-5 w-5" />
                </button>
              </div>
            </div>
          @endforeach
          <button
            type="button"
            class="box bg-surface-alt text-on-surface-alt flex h-20 w-20 cursor-pointer flex-col items-center justify-center text-xs"
            x-on:click="$refs.fileInput.click()"
          >
            <x-lucide-camera class="h-5 w-5" />
            Add media
          </button>
        </div>

        @error('reviewForm.file.*')
          <p class="text-danger text-xs">
            @lang('visual-debut::shop.review.failed-to-upload')
          </p>
        @enderror
      </div>

      <div class="flex gap-4 text-center">
        <x-shop::ui.button type="submit" wire:target="storeReview">
          @lang('shop::app.products.view.reviews.submit-review')
        </x-shop::ui.button>

        <x-shop::ui.button
          type="button"
          variant="outline"
          x-on:click="showReviewForm = false"
        >
          @lang('shop::app.products.view.reviews.cancel')
        </x-shop::ui.button>
      </div>
    </form>
  </div>
</div>
