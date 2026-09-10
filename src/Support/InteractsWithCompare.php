<?php

namespace BagistoPlus\VisualDebut\Support;

use Webkul\Customer\Repositories\CompareItemRepository;

trait InteractsWithCompare
{
    /**
     * Number of compare items the current customer holds.
     *
     * Guests keep their compare list in localStorage, so there is nothing
     * to count for them server-side.
     */
    public function getCompareItemsCount(): int
    {
        $customerId = auth('customer')->id();

        if (! $customerId) {
            return 0;
        }

        return app(CompareItemRepository::class)->count(['customer_id' => $customerId]);
    }
}
