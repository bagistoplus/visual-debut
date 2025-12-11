@isset($product)
  @if ($totalReviews > 0)
    <div {{ $block->editor_attributes }} class="flex items-center space-x-4">
      <x-shop::star-rating :rating="$averageRating" />
      <span class="text-secondary text-sm">({{ $totalReviews }})</span>
    </div>
  @endif
@else
  <div {{ $block->editor_attributes }} class="flex items-center space-x-2">
    <x-shop::star-rating :rating="4.5" />
    <span class="text-secondary text-sm">({{ 4.5 }})</span>
  </div>
@endisset
