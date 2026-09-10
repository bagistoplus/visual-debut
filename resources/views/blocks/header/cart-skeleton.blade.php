<div class="flex flex-col gap-4 px-4 py-2" aria-busy="true">
  <span class="sr-only">@lang('visual-debut::shop.cart.loading')</span>

  @foreach (range(1, 2) as $row)
    <div class="flex items-start gap-3">
      <div class="bg-on-surface/10 h-12 w-12 shrink-0 animate-pulse rounded"></div>

      <div class="min-w-0 flex-1 space-y-2">
        <div class="bg-on-surface/10 h-3 w-3/4 animate-pulse rounded"></div>
        <div class="bg-on-surface/10 h-3 w-1/2 animate-pulse rounded"></div>
      </div>
    </div>
  @endforeach

  <div class="bg-on-surface/10 mt-2 h-9 w-full animate-pulse rounded"></div>
</div>
