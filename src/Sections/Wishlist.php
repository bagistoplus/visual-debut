<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\Cart\MoveWishlistToCart;
use BagistoPlus\Visual\Actions\ClearWishlist;
use BagistoPlus\Visual\Actions\GetWishlistItems;
use BagistoPlus\Visual\Actions\RemoveItemFromWishlist;
use BagistoPlus\Visual\Blocks\LivewireSection;
use BagistoPlus\VisualDebut\Enums\Events;

use function BagistoPlus\VisualDebut\_t;

class Wishlist extends LivewireSection
{
    protected static string $type = '@visual-debut/wishlist';

    protected static array $enabledOn = [
        'templates' => ['account/wishlist'],
        'regions' => ['main']
    ];

    protected static string $view = 'shop::sections.wishlist';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>';

    protected static string $category = 'Commerce';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/wishlist.png';

    public static function name(): string
    {
        return _t('sections.wishlist.name');
    }

    public static function description(): string
    {
        return _t('sections.wishlist.description');
    }

    public function loader($id) {}

    public function removeAll()
    {
        $response = app(ClearWishlist::class)->execute();

        session()->flash('info', $response['message']);
    }

    public function removeItem($id)
    {
        $response = app(RemoveItemFromWishlist::class)->execute($id);

        session()->flash('info', $response['message']);
    }

    public function moveToCart($id, $productId, $quantity)
    {
        $response = app(MoveWishlistToCart::class)->execute($id, $productId, $quantity);

        if (isset($response['redirect'])) {
            session()->flash('warning', $response['message']);

            return $this->redirect($response['data']);
        }

        $this->dispatch(Events::CART_UPDATED);
        session()->flash('success', $response['message']);
    }

    public function getViewData(): array
    {
        return [
            'wishlistItems' => app(GetWishlistItems::class)->execute(),
        ];
    }
}
