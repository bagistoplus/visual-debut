@php
  // Each kind of booking has its own form and Alpine component; the location and notice are shared
  $form = match ($booking['type']) {
      'event' => ['partial' => 'event', 'component' => 'VisualBookingEvent', 'incomplete' => 'choose-tickets'],
      'table' => ['partial' => 'table', 'component' => 'VisualBookingSlots', 'incomplete' => 'incomplete'],
      'rental' => ['partial' => 'rental', 'component' => 'VisualBookingRental', 'incomplete' => 'choose-rental'],
      default => ['partial' => 'slots', 'component' => 'VisualBookingSlots', 'incomplete' => 'incomplete'],
  };

  $props = array_merge($booking, [
      'messages' => [
          'loading' => trans('visual-debut::shop.booking.slots-loading'),
          'empty' => trans('visual-debut::shop.booking.no-slots'),
          'failed' => trans('visual-debut::shop.booking.slots-failed'),
          'ticketLine' => trans('visual-debut::shop.booking.ticket-line'),
          'feeLine' => trans('visual-debut::shop.booking.fee-line'),
          'guestLine' => trans('visual-debut::shop.booking.guest-line'),
          'tableLine' => trans('visual-debut::shop.booking.table-line'),
          'baseLine' => trans('visual-debut::shop.booking.base-line'),
          'daysLine' => trans('visual-debut::shop.booking.days-line'),
          'hoursLine' => trans('visual-debut::shop.booking.hours-line'),
          'quantityLine' => trans('visual-debut::shop.booking.quantity-line'),
      ],
  ]);
@endphp

{{-- Livewire leaves the form alone: its state lives in Alpine and reaches the section through $wire --}}
<div
  {{ $block->editor_attributes }}
  x-data="{{ $form['component'] }}(@js($props))"
  wire:ignore
  class="space-y-4"
>
  @if ($booking['location'])
    <div class="flex items-start gap-2 text-sm">
      @svg('lucide-map-pin', ['class' => 'mt-0.5 h-4 w-4 shrink-0', 'aria-hidden' => true])

      <div>
        <span class="font-semibold">@lang('visual-debut::shop.booking.location'):</span>
        {{ $booking['location'] }}

        <a
          href="https://maps.google.com/maps?q={{ urlencode($booking['location']) }}"
          target="_blank"
          rel="noopener"
          class="text-primary ml-1 underline"
        >
          @lang('visual-debut::shop.booking.view-on-map')
        </a>
      </div>
    </div>
  @endif

  @unless ($booking['cancellable'])
    <div
      role="note"
      class="bg-warning-100 border-warning text-warning-900 flex items-start gap-3 rounded-(--box-radius) border p-4"
    >
      @svg('lucide-triangle-alert', ['class' => 'mt-0.5 h-5 w-5 shrink-0', 'aria-hidden' => true])

      <div>
        <p class="text-sm font-semibold">@lang('visual-debut::shop.booking.not-cancellable.title')</p>
        <p class="mt-1 text-sm">@lang('visual-debut::shop.booking.not-cancellable.description')</p>
      </div>
    </div>
  @endunless

  @include('visual-debut::blocks.product.options.booking.' . $form['partial'])

  <p
    x-show="showErrors"
    x-cloak
    class="text-danger text-sm italic"
  >
    @lang('visual-debut::shop.booking.' . $form['incomplete'])
  </p>
</div>
