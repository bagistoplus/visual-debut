@if ($booking['startsAt'])
  <p class="text-sm">
    <span class="font-semibold">@lang('visual-debut::shop.booking.when'):</span>
    {{ $booking['startsAt'] }} – {{ $booking['endsAt'] }}
  </p>
@endif

<div>
  <p class="text-sm font-semibold">@lang('visual-debut::shop.booking.tickets')</p>

  <div class="mt-2 divide-y">
    @foreach ($booking['tickets'] as $ticket)
      <div class="flex items-center justify-between gap-4 py-3">
        <div class="min-w-0">
          <p class="font-medium">{{ $ticket['name'] }}</p>

          @if ($ticket['description'])
            <p class="text-on-background/70 text-sm">{{ $ticket['description'] }}</p>
          @endif

          <p class="mt-1 text-sm">
            @if ($ticket['regularPrice'] !== null)
              <span class="text-on-background/60 mr-1 line-through">{{ core()->formatPrice($ticket['regularPrice']) }}</span>
            @endif

            <span class="text-primary font-semibold">{{ core()->formatPrice($ticket['price']) }}</span>
          </p>
        </div>

        <x-shop::quantity-selector
          :id="'booking-ticket-' . $block->id . '-' . $ticket['id']"
          :value="0"
          :min="0"
          size="sm"
          x-on:change="setQuantity({{ $ticket['id'] }}, $event.detail)"
        />
      </div>
    @endforeach
  </div>
</div>

<div
  x-show="count > 0"
  x-cloak
  class="space-y-1 rounded-lg border p-4 text-sm"
>
  <p class="font-semibold">@lang('visual-debut::shop.booking.summary')</p>

  <template
    x-for="line in lines"
    x-bind:key="line.id"
  >
    <div class="flex justify-between gap-4">
      <span x-text="line.label"></span>
      <span x-text="line.amount"></span>
    </div>
  </template>

  <template x-if="fee">
    <div class="flex justify-between gap-4">
      <span x-text="fee.label"></span>
      <span x-text="fee.amount"></span>
    </div>
  </template>

  <div class="flex justify-between gap-4 border-t pt-2 font-semibold">
    <span>@lang('visual-debut::shop.booking.total')</span>
    <span x-text="total"></span>
  </div>
</div>
