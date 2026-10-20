<x-shop::ui.collapsible :id="'booking-hours-' . $block->id">
  <x-shop::ui.collapsible.trigger class="text-on-background flex items-center gap-1 text-sm font-semibold">
    @lang('visual-debut::shop.booking.opening-hours')

    <x-shop::ui.collapsible.indicator class="transition-transform data-[state=open]:rotate-180">
      @svg('lucide-chevron-down', ['class' => 'h-4 w-4', 'aria-hidden' => true])
    </x-shop::ui.collapsible.indicator>
  </x-shop::ui.collapsible.trigger>

  <x-shop::ui.collapsible.content>
    <dl class="mt-2 grid max-w-sm grid-cols-[auto_1fr] gap-x-6 gap-y-1 text-sm">
      @foreach ($booking['openingHours'] as $day)
        <dt class="font-medium">{{ $day['name'] }}</dt>
        <dd>
          @forelse ($day['slots'] as $hours)
            <span class="block">{{ $hours['from'] }} – {{ $hours['to'] }}</span>
          @empty
            <span class="text-on-background/60">@lang('visual-debut::shop.booking.closed')</span>
          @endforelse
        </dd>
      @endforeach
    </dl>
  </x-shop::ui.collapsible.content>
</x-shop::ui.collapsible>
