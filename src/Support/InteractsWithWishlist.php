<?php

namespace BagistoPlus\VisualDebut\Support;

use Webkul\Customer\Models\Customer;

trait InteractsWithWishlist
{
    /**
     * Number of wishlist items the current customer holds on the current channel.
     *
     * Queries through the relation method rather than the `wishlist_items` property so the
     * count is re-read from the database: the property caches the loaded collection on the
     * model instance, which goes stale as soon as an item is added or removed.
     */
    public function getWishlistItemsCount(): int
    {
        /** @var Customer|null $customer */
        $customer = auth('customer')->user();

        if (! $customer) {
            return 0;
        }

        return $customer->wishlist_items()
            ->where('channel_id', data_get(core()->getCurrentChannel(), 'id'))
            ->count();
    }
}
