<?php

namespace BagistoPlus\VisualDebut\Components\Livewire;

use BagistoPlus\Visual\Actions\Cart\AddProductToCart;
use BagistoPlus\VisualDebut\Enums\Events;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AddToCartButton extends Component
{
    public string $action = 'addToCart';

    #[Locked]
    public $productId;

    public $quantity = 1;

    public $size = 'md';
    public $variant = 'solid';
    public $color = 'primary';
    public $icon = null;
    public $circle = false;
    public $square = false;
    public $block = false;

    public function addToCart()
    {
        $result = app(AddProductToCart::class)->execute([
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
        ]);

        if ($result['success']) {
            session()->flash('success', $result['message']);
            $this->dispatch(Events::CART_UPDATED);
        } else {
            session()->flash('error', $result['message']);
            $this->redirect($result['redirect_url']);
        }
    }

    public function render()
    {
        return view('shop::livewire.add-to-cart-button');
    }
}
