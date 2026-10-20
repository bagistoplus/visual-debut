<?php

namespace BagistoPlus\VisualDebut\Support;

/**
 * What the customer order pages need to know about booking items.
 *
 * Bagisto 2.5 lets a merchant mark a booking product as not cancellable by the
 * customer, through `OrderItem::isCancelableByCustomer()`. Earlier versions
 * have no such rule, so every item there counts as cancellable.
 */
class Booking
{
    /**
     * Whether the order page should warn that canceling leaves the booking
     * items active: one item is not cancellable by the customer while the
     * order still offers Cancel for the rest.
     */
    public static function warnsAboutCancellation(object $order): bool
    {
        $hasRestrictedItem = collect($order->items)->contains(
            fn ($item) => method_exists($item, 'isCancelableByCustomer') && ! $item->isCancelableByCustomer()
        );

        return $hasRestrictedItem && $order->canCancel();
    }
}
