<?php

namespace BagistoPlus\VisualDebut\Components\Livewire;

use BagistoPlus\Visual\Actions\Cart\AddProductToWishlist;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Webkul\Customer\Models\Customer;

class AddToWishlistButton extends Component
{
    #[Locked]
    public $productId;

    #[Locked]
    public $inUserWishlist = false;

    public $size = 'md';

    public $variant = 'soft';

    public $color = 'secondary';

    public $icon = null;

    public $circle = false;

    public $square = false;

    public $block = false;

    public function handle()
    {
        $response = app(AddProductToWishlist::class)->execute($this->productId);

        if (isset($response['message'])) {
            session()->flash('info', $response['message']);
        }

        /** @var Customer|null $customer */
        $customer = auth('customer')->user();

        $this->inUserWishlist = $customer?->wishlist_items
            ->where('channel_id', data_get(core()->getCurrentChannel(), 'id'))
            ->where('product_id', $this->productId)
            ->count();
    }

    public function render()
    {
        return view()->make('shop::livewire.add-to-wishlist-button');
    }
}
