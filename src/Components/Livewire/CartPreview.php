<?php

namespace BagistoPlus\VisualDebut\Components\Livewire;

use BagistoPlus\VisualDebut\Enums\Events;
use BagistoPlus\VisualDebut\Support\InteractsWithCart;
use Livewire\Attributes\On;
use Livewire\Component;

#[On(Events::CART_UPDATED)]
class CartPreview extends Component
{
    use InteractsWithCart;

    public $open = false;

    public $initialized = false;

    public $heading;

    public $description;

    public $block = [];

    public function mount() {}

    public function initCart()
    {
        $this->initialized = true;
    }

    public function updateItemQuantity($itemId, $quantity)
    {
        $this->updateCartItemQuantity($itemId, $quantity);
    }

    public function removeItem($itemId)
    {
        $this->removeCartItem($itemId);

        $this->open = $this->getItemsCount() > 0;

        $this->dispatch(Events::CART_UPDATED);
    }

    public function render()
    {
        return view('shop::livewire.cart-preview');
    }
}
