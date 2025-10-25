@isset($product)
  @if ($totalReviews > 0)
    <div {{ $block->editor_attributes }} class="flex items-center space-x-4">
      <x-shop::star-rating :rating="$averageRating" />
      <span class="text-secondary text-sm">({{ $totalReviews }})</span>
    </div>
  @endif
@else
  <div {{ $block->editor_attributes }}>
    This block should be used in a context where a product is defined
  </div>
@endisset
