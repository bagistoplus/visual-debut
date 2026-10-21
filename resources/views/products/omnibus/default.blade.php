<p class="text-on-background/70 mt-1 flex items-start gap-1.5 text-sm">
  @svg('lucide-info', ['class' => 'mt-0.5 h-4 w-4 shrink-0', 'aria-hidden' => true])
  <span>
    @lang('shop::app.products.omnibus.price-info')
    <strong class="text-on-background font-medium">{{ $formattedPrice }}</strong>
  </span>
</p>
