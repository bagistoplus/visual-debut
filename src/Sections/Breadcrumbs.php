<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Blocks\BladeSection;
use BagistoPlus\VisualDebut\Support\HasColorSchemeSetting;
use Diglactic\Breadcrumbs\Breadcrumbs as BreadcrumbsBreadcrumbs;
use Illuminate\Support\Facades\Route;

use function BagistoPlus\VisualDebut\_t;

class Breadcrumbs extends BladeSection
{
    use HasColorSchemeSetting;

    protected static string $type = '@visual-debut/breadcrumbs';

    protected static string $view = 'shop::sections.breadcrumbs';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 6 15 12 9 18"/></svg>';

    protected static string $category = 'Navigation';

    protected static array $disabledOn = [
        'templates' => ['index', 'category'],
    ];

    protected static array $enabledOn = [
        'regions' => ['header'],
    ];

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/breadcrumbs.png';

    public static function name(): string
    {
        return _t('sections.breadcrumbs.name');
    }

    public static function description(): string
    {
        return _t('sections.breadcrumbs.description');
    }

    public static function settings(): array
    {
        return [
            static::colorSchemeSetting(),
        ];
    }

    public function getViewData(): array
    {
        $breadcrumbsData = match (Route::currentRouteName()) {
            'shop.product_or_category.index' => ['name' => 'product', 'entity' => $this->context['product']],
            'shop.checkout.cart.index' => ['name' => 'cart'],
            'shop.checkout.onepage.index' => ['name' => 'checkout'],
            'shop.compare.index' => ['name' => 'compare'],

            // Account pages
            'shop.customers.account.index' => ['name' => 'account'],
            'shop.customers.account.profile.index' => ['name' => 'profile'],
            'shop.customers.account.profile.edit' => ['name' => 'profile.edit'],

            'shop.customers.account.addresses.index' => ['name' => 'addresses'],
            'shop.customers.account.addresses.create' => ['name' => 'addresses.create'],
            'shop.customers.account.addresses.edit' => ['name' => 'addresses.edit', 'entity' => $this->context['address']],

            'shop.customers.account.orders.index' => ['name' => 'orders'],
            'shop.customers.account.orders.view' => ['name' => 'orders.view', 'entity' => $this->context['order']],
            'shop.customers.account.eu_withdrawal.create' => ['name' => 'account.eu-withdrawal.create'],
            'shop.customers.account.eu_withdrawal.show' => ['name' => 'account.eu-withdrawal.show'],

            'shop.customers.account.reviews.index' => ['name' => 'reviews'],
            'shop.customers.account.downloadable_products.index' => ['name' => 'downloadable-products'],
            'shop.customers.account.wishlist.index' => ['name' => 'wishlist'],

            'shop.customers.account.rma.index' => ['name' => 'rma'],
            'shop.customers.account.rma.create' => ['name' => 'rma.create'],
            'shop.customers.account.rma.view' => ['name' => 'rma.view', 'id' => Route::current()->parameter('id')],
            default => []
        };

        $breadcrumbs = empty($breadcrumbsData)
            ? collect([])
            : BreadcrumbsBreadcrumbs::generate(...$breadcrumbsData);

        return ['breadcrumbs' => $breadcrumbs];
    }
}
