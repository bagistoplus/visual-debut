@php
  $rates = [
      'daily' => trans('visual-debut::shop.booking.per-day', ['price' => core()->formatPrice($booking['dailyPrice'])]),
      'hourly' => trans('visual-debut::shop.booking.per-hour', ['price' => core()->formatPrice($booking['hourlyPrice'])]),
  ];
@endphp

@if ($booking['rentingType'] === 'daily_hourly')
  <fieldset>
    <legend class="text-sm font-semibold">@lang('visual-debut::shop.booking.rent-by')</legend>

    <div class="mt-1 grid gap-1">
      @foreach (['daily', 'hourly'] as $mode)
        <label class="flex items-center gap-2 text-sm">
          <input
            type="radio"
            name="booking-mode-{{ $block->id }}"
            value="{{ $mode }}"
            x-model="mode"
          >
          <span>@lang('visual-debut::shop.booking.' . $mode)</span>
          <span class="text-on-background/70">({{ $rates[$mode] }})</span>
        </label>
      @endforeach
    </div>
  </fieldset>
@else
  <p class="text-sm">{{ $rates[$booking['rentingType']] ?? '' }}</p>
@endif

{{-- By the day: a first and a last day, both included --}}
<div
  x-show="mode === 'daily'"
  class="grid grid-cols-2 gap-4"
>
  <div>
    <label
      for="rental-from-{{ $block->id }}"
      class="text-sm font-semibold"
    >
      @lang('visual-debut::shop.booking.date-from')
    </label>

    <input
      id="rental-from-{{ $block->id }}"
      type="date"
      class="mt-1 w-full"
      x-model="dateFrom"
      x-bind:min="minDate"
      x-bind:max="maxDate"
      x-bind:data-invalid="showErrors && !dateFrom"
    >
  </div>

  <div>
    <label
      for="rental-to-{{ $block->id }}"
      class="text-sm font-semibold"
    >
      @lang('visual-debut::shop.booking.date-to')
    </label>

    <input
      id="rental-to-{{ $block->id }}"
      type="date"
      class="mt-1 w-full"
      x-model="dateTo"
      x-bind:min="dateFrom || minDate"
      x-bind:max="maxDate"
      x-bind:data-invalid="showErrors && !dateTo"
    >
  </div>
</div>

{{-- By the hour: one day, then hours from the day's free windows --}}
<div
  x-show="mode === 'hourly'"
  x-cloak
  class="space-y-4"
>
  <div>
    <label
      for="rental-date-{{ $block->id }}"
      class="text-sm font-semibold"
    >
      @lang('visual-debut::shop.booking.date')
    </label>

    <input
      id="rental-date-{{ $block->id }}"
      type="date"
      class="mt-1 w-full"
      x-model="date"
      x-bind:min="minDate"
      x-bind:max="maxDate"
      x-on:change="loadHours()"
      x-bind:data-invalid="showErrors && !date"
    >
  </div>

  <div
    x-show="date"
    x-cloak
  >
    @if ($booking['oneHourOnly'])
      <label
        for="rental-hour-{{ $block->id }}"
        class="text-sm font-semibold"
      >
        @lang('visual-debut::shop.booking.hour')
      </label>

      <select
        id="rental-hour-{{ $block->id }}"
        class="mt-1 w-full"
        x-model="hourFrom"
        x-bind:disabled="status !== 'ready'"
      >
        <option
          value=""
          disabled
          hidden
        >
          @lang('visual-debut::shop.booking.choose-slot')
        </option>

        <template
          x-for="hour in hours"
          x-bind:key="hour.from_timestamp"
        >
          <option
            x-bind:value="hour.from_timestamp"
            x-text="hour.from + ' – ' + hour.to"
          ></option>
        </template>
      </select>
    @else
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label
            for="rental-hour-from-{{ $block->id }}"
            class="text-sm font-semibold"
          >
            @lang('visual-debut::shop.booking.hour-from')
          </label>

          <select
            id="rental-hour-from-{{ $block->id }}"
            class="mt-1 w-full"
            x-model="hourFrom"
            x-bind:disabled="status !== 'ready'"
          >
            <option
              value=""
              disabled
              hidden
            ></option>

            <template
              x-for="hour in hours"
              x-bind:key="hour.from_timestamp"
            >
              <option
                x-bind:value="hour.from_timestamp"
                x-text="hour.from"
              ></option>
            </template>
          </select>
        </div>

        <div>
          <label
            for="rental-hour-to-{{ $block->id }}"
            class="text-sm font-semibold"
          >
            @lang('visual-debut::shop.booking.hour-to')
          </label>

          <select
            id="rental-hour-to-{{ $block->id }}"
            class="mt-1 w-full"
            x-model="hourTo"
            x-bind:disabled="!hourFrom"
          >
            <option
              value=""
              disabled
              hidden
            ></option>

            <template
              x-for="hour in toHours"
              x-bind:key="hour.to_timestamp"
            >
              <option
                x-bind:value="hour.to_timestamp"
                x-text="hour.to"
              ></option>
            </template>
          </select>
        </div>
      </div>
    @endif

    <p
      role="status"
      aria-live="polite"
      class="text-on-background/70 mt-1 text-sm"
      x-text="statusMessage"
    ></p>
  </div>
</div>

<div
  x-show="units > 0"
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

  <div class="flex justify-between gap-4 border-t pt-2 font-semibold">
    <span>@lang('visual-debut::shop.booking.total')</span>
    <span x-text="total"></span>
  </div>
</div>
