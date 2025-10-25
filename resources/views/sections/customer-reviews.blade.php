<div {{ $section->editor_attributes }} class="bg-background box border-none shadow-sm">
  <div class="border-b p-4">
    <div class="flex items-center justify-between">
      <h1 class="text-on-background text-2xl">
        @lang('shop::app.customers.account.reviews.title')
      </h1>
    </div>
  </div>
  <div class="space-y-6 p-6">
    @foreach ($reviews as $review)
      <div class="box relative p-4">
        <div class="flex gap-4">

          <!-- Image -->
          <img
            src="{{ $review->product->base_image_url }}"
            alt="Review Image"
            class="h-20 w-20 rounded-md object-cover md:h-32 md:w-32"
          >

          <!-- Content -->
          <div class="flex w-full flex-col">
            <div class="flex flex-col sm:justify-between md:flex-row md:items-center">
              <a class="text-on-background text-base font-medium before:absolute before:inset-0 sm:text-xl"
                href="{{ route('shop.product_or_category.index', $review->product->url_key) }}"
              >
                {{ $review->title }}
              </a>
              <x-shop::star-rating :rating="$review->rating" />
            </div>
            <p class="text-on-background/70 mt-1.5 text-xs sm:text-sm">
              {{ $review->created_at }}
            </p>
            <p class="text-on-background/70 mt-2 hidden text-xs sm:block sm:text-base">
              {{ $review->comment }}
            </p>
          </div>
        </div>

        <p class="mt-2 text-xs sm:hidden">
          {{ $review->comment }}
        </p>
      </div>
    @endforeach
  </div>
</div>
