<div {{ $block->editor_attributes }} class="space-y-4">
  <div class="mb-4 max-w-72">
    <label class="text-muted mb-1 block font-medium">@lang('visual-debut::blocks.product-variant-picker.placeholder.size')</label>
    <div class="flex flex-wrap gap-2">
      <button class="bg-primary text-on-primary min-w-12 rounded-md px-3 py-2 text-sm font-medium">S</button>
      <button class="bg-background text-on-background/90 min-w-12 rounded-md border px-3 py-2 text-sm font-medium">M</button>
      <button class="bg-background text-on-background/90 min-w-12 rounded-md border px-3 py-2 text-sm font-medium">L</button>
      <button class="bg-background text-on-background/90 min-w-12 rounded-md border px-3 py-2 text-sm font-medium">XL</button>
    </div>
  </div>
  <div class="mb-4 max-w-72">
    <label class="text-muted mb-1 block font-medium">@lang('visual-debut::blocks.product-variant-picker.placeholder.color')</label>
    <div class="flex gap-4">
      <button class="ring-primary h-8 w-8 rounded-full border ring-2 ring-offset-2" style="background-color: #000000"></button>
      <button class="h-8 w-8 rounded-full border hover:ring-2 hover:ring-neutral-200 hover:ring-offset-2" style="background-color: #FFFFFF"></button>
      <button class="h-8 w-8 rounded-full border hover:ring-2 hover:ring-neutral-200 hover:ring-offset-2" style="background-color: #EF4444"></button>
    </div>
  </div>
</div>
