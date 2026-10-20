<?php

use BagistoPlus\VisualDebut\Support\BookingOptions;
use Illuminate\Support\Facades\Route;
use Webkul\BookingProduct\Helpers\Booking as BookingHelper;

/**
 * Registers the booking slots route under the given name, as a Bagisto
 * version does: 2.5 in snake case, earlier in kebab case.
 */
function slotsRoute(string $name): void
{
    Route::get('booking-slots/{id}', fn () => '')->name($name);
    Route::getRoutes()->refreshNameLookups();
}

/**
 * A booking product page with the given booking product behind it.
 */
function bookingPage(?object $bookingProduct, string $type = 'booking'): object
{
    return new class($bookingProduct, $type)
    {
        public int $id = 7;

        public function __construct(private readonly ?object $bookingProduct, public string $type) {}

        public function getTypeInstance(): object
        {
            return new class($this->bookingProduct)
            {
                public function __construct(private readonly ?object $bookingProduct) {}

                public function getBookingProduct(int $id): ?object
                {
                    return $this->bookingProduct;
                }
            };
        }
    };
}

function appointment(array $overrides = []): object
{
    return (object) array_merge([
        'id' => 3,
        'type' => 'appointment',
        'available_every_week' => 1,
        'available_from' => null,
        'available_to' => null,
        'location' => 'Paris',
        'appointment_slot' => (object) ['duration' => 45],
    ], $overrides);
}

beforeEach(function () {
    app()->instance(BookingHelper::class, new class
    {
        public function getWeekSlotDurations($bookingProduct): array
        {
            return [['name' => 'Monday', 'slots' => [['from' => '10:00 AM', 'to' => '06:00 PM', 'qty' => 1]]]];
        }
    });
});

it('has nothing for a product that is not bookable here', function (object $product) {
    slotsRoute('shop.booking_product.slots.index');

    expect(BookingOptions::for($product))->toBeNull();
})->with([
    'not a booking product' => fn () => bookingPage(appointment(), 'simple'),
    'no booking product' => fn () => bookingPage(null),
    'a type the page cannot book yet' => fn () => bookingPage(appointment(['type' => 'event'])),
]);

it('books an appointment through the 2.5 slots route', function () {
    slotsRoute('shop.booking_product.slots.index');

    $options = BookingOptions::for(bookingPage(appointment()));

    expect($options)->toMatchArray([
        'type' => 'appointment',
        'availableFrom' => null,
        'availableTo' => null,
        'duration' => 45,
        'location' => 'Paris',
        'cancellable' => true,
        'openingHours' => [['name' => 'Monday', 'slots' => [['from' => '10:00 AM', 'to' => '06:00 PM']]]],
    ])->and($options['slotsUrl'])->toEndWith('/booking-slots/3');
});

it('falls back to the kebab case slots route before 2.5', function () {
    slotsRoute('shop.booking-product.slots.index');

    expect(BookingOptions::slotsRouteName())->toBe('shop.booking-product.slots.index');
});

it('bounds a booking to its dates unless it repeats every week', function () {
    slotsRoute('shop.booking_product.slots.index');

    $options = BookingOptions::for(bookingPage(appointment([
        'available_every_week' => 0,
        'available_from' => '2026-11-01 00:00:00',
        'available_to' => '2026-12-31 23:59:59',
    ])));

    expect($options['availableFrom'])->toBe('2026-11-01')
        ->and($options['availableTo'])->toBe('2026-12-31');
});

it('lists the periods of a default booking for many days', function () {
    slotsRoute('shop.booking_product.slots.index');

    $options = BookingOptions::for(bookingPage(appointment([
        'type' => 'default',
        'default_slot' => (object) [
            'booking_type' => 'one',
            'duration' => null,
            'slots' => [['from_day' => '0', 'from' => '08:00', 'to_day' => '1', 'to' => '22:00']],
        ],
    ])));

    expect($options['duration'])->toBeNull()
        ->and($options['openingHours'])->toBe([['name' => 'Sunday', 'slots' => [['from' => '08:00 AM', 'to' => 'Monday 10:00 PM']]]]);
});

it('says when Bagisto 2.5 forbids canceling the booking', function () {
    slotsRoute('shop.booking_product.slots.index');

    expect(BookingOptions::for(bookingPage(appointment(['allow_cancellation' => false])))['cancellable'])->toBeFalse();
});
