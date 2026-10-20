@php
  $props = array_merge($booking, [
      'messages' => [
          'loading' => trans('visual-debut::shop.booking.slots-loading'),
          'empty' => trans('visual-debut::shop.booking.no-slots'),
          'failed' => trans('visual-debut::shop.booking.slots-failed'),
      ],
  ]);
@endphp

{{-- Livewire leaves the form alone: its state lives in Alpine and reaches the section through $wire --}}
<div
  {{ $block->editor_attributes }}
  x-data="VisualBookingSlots(@js($props))"
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
      class="bg-warning-100 border-warning text-warning-900 flex items-start gap-3 rounded-lg border p-4"
    >
      @svg('lucide-triangle-alert', ['class' => 'mt-0.5 h-5 w-5 shrink-0', 'aria-hidden' => true])

      <div>
        <p class="text-sm font-semibold">@lang('visual-debut::shop.booking.not-cancellable.title')</p>
        <p class="mt-1 text-sm">@lang('visual-debut::shop.booking.not-cancellable.description')</p>
      </div>
    </div>
  @endunless

  @if ($booking['duration'])
    <p class="text-sm">@lang('visual-debut::shop.booking.duration', ['minutes' => $booking['duration']])</p>
  @endif

  @if (!empty($booking['openingHours']))
    @include('visual-debut::blocks.product.options.booking.opening-hours')
  @endif

  @include('visual-debut::blocks.product.options.booking.slots')

  <p
    x-show="showErrors"
    x-cloak
    class="text-danger text-sm italic"
  >
    @lang('visual-debut::shop.booking.incomplete')
  </p>
</div>
