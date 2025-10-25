<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\LivewireSection;
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
    protected static string $type = '@visual-debut/cart-content';

    use InteractsWithCart;

    protected static array $enabledOn = [
        'templates' => ['cart'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.cart-content';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>';

    protected static string $category = 'Commerce';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/cart.png';

    public $itemsSelected = [];

    public static function name(): string
    {
        return _t('sections.cart-content.name');
    }

    public static function description(): string
    {
        return _t('sections.cart-content.description');
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
