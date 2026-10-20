@include('visual-debut::blocks.product.options.booking.slots')

<x-shop::quantity-selector
  :id="'booking-party-' . $block->id"
  :label="$booking['perTable']
      ? trans('visual-debut::shop.booking.tables', ['count' => $booking['guestLimit']])
      : trans('visual-debut::shop.booking.guests')"
  :value="1"
  :min="1"
  x-on:change="setParty($event.detail)"
/>

<div>
  <label
    for="booking-note-{{ $block->id }}"
    class="text-sm font-semibold"
  >
    @lang('visual-debut::shop.booking.note')
  </label>

  <textarea
    id="booking-note-{{ $block->id }}"
    class="mt-1 w-full"
    rows="3"
    maxlength="500"
    x-model="note"
  ></textarea>
</div>

<div
  x-show="slot"
  x-cloak
  class="space-y-1 rounded-lg border p-4 text-sm"
>
  <p class="font-semibold">@lang('visual-debut::shop.booking.summary')</p>

  <div class="flex justify-between gap-4">
    <span x-text="partyLine.label"></span>
    <span x-text="partyLine.amount"></span>
  </div>

  <div class="flex justify-between gap-4 border-t pt-2 font-semibold">
    <span>@lang('visual-debut::shop.booking.total')</span>
    <span x-text="partyLine.amount"></span>
  </div>
</div>
