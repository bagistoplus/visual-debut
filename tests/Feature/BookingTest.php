<?php

use BagistoPlus\VisualDebut\Support\Booking;

/**
 * An order item as Bagisto 2.5 has it, cancellable by the customer or not.
 */
function bookingItem(bool $cancelableByCustomer): object
{
    return new class($cancelableByCustomer)
    {
        public function __construct(private readonly bool $cancelableByCustomer) {}

        public function isCancelableByCustomer(): bool
        {
            return $this->cancelableByCustomer;
        }
    };
}

/**
 * An order holding the given items, that offers Cancel or not.
 */
function bookingOrder(bool $canCancel, object ...$items): object
{
    return new class($canCancel, $items)
    {
        public function __construct(private readonly bool $canCancel, public readonly array $items) {}

        public function canCancel(): bool
        {
            return $this->canCancel;
        }
    };
}

it('warns when canceling leaves a booking item active', function () {
    $order = bookingOrder(true, bookingItem(false), bookingItem(true));

    expect(Booking::warnsAboutCancellation($order))->toBeTrue();
});

it('does not warn when every item can be canceled', function () {
    $order = bookingOrder(true, bookingItem(true), bookingItem(true));

    expect(Booking::warnsAboutCancellation($order))->toBeFalse();
});

it('does not warn when the order offers no Cancel', function () {
    $order = bookingOrder(false, bookingItem(false));

    expect(Booking::warnsAboutCancellation($order))->toBeFalse();
});

it('does not warn before Bagisto 2.5, which has no such rule', function () {
    $order = bookingOrder(true, new stdClass, new stdClass);

    expect(Booking::warnsAboutCancellation($order))->toBeFalse();
});
