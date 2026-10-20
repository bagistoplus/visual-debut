<div>
  <label for="booking-date-{{ $block->id }}" class="text-sm font-semibold">
    @lang('visual-debut::shop.booking.date')
  </label>

  <input
    id="booking-date-{{ $block->id }}"
    type="date"
    class="mt-1 w-full"
    x-model="date"
    x-bind:min="minDate"
    x-bind:max="maxDate"
    x-on:change="loadSlots()"
    x-bind:data-invalid="showErrors && !date"
  >
</div>

<div x-show="date" x-cloak>
  <label for="booking-slot-{{ $block->id }}" class="text-sm font-semibold">
    @lang('visual-debut::shop.booking.slot')
  </label>

  <select
    id="booking-slot-{{ $block->id }}"
    class="mt-1 w-full"
    x-model="slot"
    x-bind:disabled="status !== 'ready'"
    x-bind:data-invalid="showErrors && !slot"
  >
    <option
      value=""
      disabled
      hidden
    >
      @lang('visual-debut::shop.booking.choose-slot')
    </option>

    <template x-for="item in slots" x-bind:key="item.timestamp">
      <option x-bind:value="item.timestamp" x-text="item.from + ' – ' + item.to"></option>
    </template>
  </select>

  <p
    role="status"
    aria-live="polite"
    class="text-on-background/70 mt-1 text-sm"
    x-text="statusMessage"
  ></p>
</div>
