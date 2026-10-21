<div class="text-on-background/70 mt-1 text-sm">
  <p class="flex items-start gap-1.5">
    @svg('lucide-info', ['class' => 'mt-0.5 h-4 w-4 shrink-0', 'aria-hidden' => true])
    <span>@lang('shop::app.products.omnibus.price-info')</span>
  </p>

  <dl class="mt-2 space-y-1">
    @foreach ($items as $item)
      <div class="flex items-center justify-between gap-4">
        <dt class="truncate">{{ $item['name'] }}</dt>
        <dd class="text-on-background whitespace-nowrap font-medium">{{ $item['price'] }}</dd>
      </div>
    @endforeach
  </dl>
</div>
