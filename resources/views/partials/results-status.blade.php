{{-- The results change without the page moving, so a screen reader is told
     here. Both halves are needed: a sort changes the order and not the count,
     so the settled sentence alone would announce nothing. --}}
<p class="sr-only" role="status">
  <span wire:loading wire:target="{{ $this->resultsTargets() }}">@lang('visual-debut::shop.results-updating')</span>
  <span wire:loading.remove wire:target="{{ $this->resultsTargets() }}">
    @if ($products->total() > 0)
      @lang('visual-debut::shop.results-showing', ['first' => $products->firstItem(), 'last' => $products->lastItem(), 'total' => $products->total()])
    @else
      @lang('visual-debut::shop.results-none')
    @endif
  </span>
</p>
