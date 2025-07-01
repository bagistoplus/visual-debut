<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Sections\LivewireSection;
use BagistoPlus\VisualDebut\Enums\Events;
use BagistoPlus\VisualDebut\Support\InteractsWithCart;
use Livewire\Attributes\On;

use function BagistoPlus\VisualDebut\_t;

#[On(Events::SHIPPING_METHOD_SET)]
#[On(Events::COUPON_APPLIED)]
#[On(Events::COUPON_REMOVED)]
#[On(Events::CART_UPDATED)]
class CartContent extends LivewireSection
{
    use InteractsWithCart;

    protected static array $enabledOn = ['cart'];

    protected static string $view = 'shop::sections.cart-content';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/cart.png';

    public $itemsSelected = [];

    public static function name(): string
    {
        return _t('cart-content.name');
    }

    public static function description(): string
    {
        return _t('cart-content.description');
    }

    public function updateItemQuantity($itemId, $quantity)
    {
        try {
            $this->updateCartItemQuantity($itemId, $quantity);
            $this->dispatch(Events::CART_UPDATED);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function removeItem($itemId)
    {
        $this->removeCartItem($itemId);
        $this->dispatch(Events::CART_UPDATED);
    }

    public function removeSelectedItems()
    {
        foreach ($this->itemsSelected as $itemId) {
            $this->removeCartItem($itemId);
        }

        $this->dispatch(Events::CART_UPDATED);
    }

    public function getViewData(): array
    {
        if ($this->isCartEmpty()) {
            return [];
        }

        return [
            'cart' => $this->getCartResource(),
            'cartErrors' => $this->cartHasErrors(),
            'haveStockableItems' => $this->cartHaveStockableItems(),
        ];
    }
}
