<?php

namespace BagistoPlus\VisualDebut\Blocks\Header;

use BagistoPlus\Visual\Blocks\LivewireBlock;
use BagistoPlus\Visual\Settings\RichText;
use BagistoPlus\Visual\Settings\Text;
use BagistoPlus\VisualDebut\Enums\Events;
use BagistoPlus\VisualDebut\Support\InteractsWithCart;
use Livewire\Attributes\On;

use function BagistoPlus\VisualDebut\_t;

#[On(Events::CART_UPDATED)]
class Cart extends LivewireBlock
{
    use InteractsWithCart;

    protected static string $view = 'visual-debut::blocks.header.cart';

    protected static string $type = '@visual-debut/header-cart';

    protected static int $limit = 1;

    protected static bool $private = true;

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>';

    protected static string $category = 'Header';

    public $open = false;

    public $initialized = false;

    public static function name(): string
    {
        return _t('blocks.header-cart.name');
    }

    public static function description(): string
    {
        return _t('blocks.header-cart.description');
    }

    public static function settings(): array
    {
        return [
            Text::make('heading', _t('blocks.header-cart.settings.heading_label'))
                ->default(__('shop::app.checkout.cart.mini-cart.shopping-cart')),

            RichText::make('description', _t('blocks.header-cart.settings.description_label'))
                ->default(_t('blocks.header-cart.settings.description_default')),
        ];
    }

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

}
