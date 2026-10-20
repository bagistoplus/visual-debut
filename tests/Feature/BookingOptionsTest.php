<?php

use BagistoPlus\VisualDebut\Support\BookingOptions;
use Illuminate\Support\Facades\Route;
use Webkul\BookingProduct\Helpers\Booking as BookingHelper;
use Webkul\Core\Core;

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
function bookingPage(?object $bookingProduct, string $type = 'booking', float $price = 0): object
{
    return new class($bookingProduct, $type, $price)
    {
        public int $id = 7;

        public function __construct(private readonly ?object $bookingProduct, public string $type, private readonly float $price) {}

        public function getTypeInstance(): object
        {
            return new class($this->bookingProduct, $this->price)
            {
                public function __construct(private readonly ?object $bookingProduct, private readonly float $price) {}

                public function getBookingProduct(int $id): ?object
                {
                    return $this->bookingProduct;
                }

                public function getFinalPrice(): float
                {
                    return $this->price;
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
    // The shop's currency is worth twice the base currency
    app()->instance(Core::class, new class
    {
        public function convertPrice($amount): float
        {
            return $amount * 2;
        }
    });

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
    'a type the page does not know' => fn () => bookingPage(appointment(['type' => 'cruise'])),
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

it('sells event tickets at their price in the shop currency', function () {
    $event = appointment([
        'type' => 'event',
        'available_from' => '2026-12-31 20:00:00',
        'available_to' => '2027-01-01 02:00:00',
        'event_tickets' => [
            (object) ['id' => 1, 'name' => 'Standing', 'description' => null, 'price' => 20, 'special_price' => null],
            (object) ['id' => 2, 'name' => 'Seated', 'description' => 'Row A', 'price' => 50, 'special_price' => 40, 'special_price_from' => '0000-00-00 00:00:00', 'special_price_to' => null],
            (object) ['id' => 3, 'name' => 'VIP', 'description' => null, 'price' => 90, 'special_price' => 60, 'special_price_from' => null, 'special_price_to' => '2000-01-01 00:00:00'],
        ],
    ]);

    $options = BookingOptions::for(bookingPage($event, price: 5));

    expect($options['basePrice'])->toBe(10.0)
        ->and($options['startsAt'])->toBe('31 Dec 2026, 08:00 PM')
        ->and($options['tickets'])->toBe([
            ['id' => 1, 'name' => 'Standing', 'description' => '', 'price' => 40.0, 'regularPrice' => null],
            ['id' => 2, 'name' => 'Seated', 'description' => 'Row A', 'price' => 80.0, 'regularPrice' => 100.0],
            ['id' => 3, 'name' => 'VIP', 'description' => '', 'price' => 180.0, 'regularPrice' => null],
        ]);
});

it('lets the event form set the quantity', function () {
    expect(BookingOptions::ownsQuantity(bookingPage(appointment(['type' => 'event']))))->toBeTrue()
        ->and(BookingOptions::ownsQuantity(bookingPage(appointment())))->toBeFalse()
        ->and(BookingOptions::ownsQuantity(bookingPage(appointment(['type' => 'event']), 'simple')))->toBeFalse();
});

it('books a table for a party, a set number of days ahead', function () {
    slotsRoute('shop.booking_product.slots.index');

    $table = appointment([
        'type' => 'table',
        'table_slot' => (object) ['duration' => 120, 'price_type' => 'table', 'guest_limit' => 4, 'prevent_scheduling_before' => 2],
    ]);

    $options = BookingOptions::for(bookingPage($table, price: 15));

    expect($options)->toMatchArray([
        'type' => 'table',
        'duration' => 120,
        'preventDays' => 2,
        'perTable' => true,
        'guestLimit' => 4,
        'price' => 30.0,
    ])->and(BookingOptions::ownsQuantity(bookingPage($table)))->toBeTrue();
});

it('rents by the day or the hour at rates in the shop currency', function () {
    slotsRoute('shop.booking_product.slots.index');

    $rental = appointment([
        'type' => 'rental',
        'rental_slot' => (object) ['renting_type' => 'daily_hourly', 'daily_price' => 100, 'hourly_price' => 12.5],
    ]);

    $options = BookingOptions::for(bookingPage($rental, price: 20));

    expect($options)->toMatchArray([
        'type' => 'rental',
        'rentingType' => 'daily_hourly',
        'basePrice' => 40.0,
        'dailyPrice' => 200.0,
        'hourlyPrice' => 25.0,
    ])->and($options['slotsUrl'])->toEndWith('/booking-slots/3')
        ->and(BookingOptions::ownsQuantity(bookingPage($rental)))->toBeFalse();
});

it('rents one hour at a time before Bagisto 2.5', function () {
    slotsRoute('shop.booking_product.slots.index');

    $rental = bookingPage(appointment([
        'type' => 'rental',
        'rental_slot' => (object) ['renting_type' => 'hourly', 'daily_price' => 0, 'hourly_price' => 10],
    ]));

    expect(BookingOptions::for($rental)['oneHourOnly'])->toBeTrue();

    // Bagisto 2.5's helper also answers calendar availability
    app()->instance(BookingHelper::class, new class
    {
        public function getCalendarAvailability($bookingProduct): array
        {
            return [];
        }
    });

    expect(BookingOptions::for($rental)['oneHourOnly'])->toBeFalse();
});
