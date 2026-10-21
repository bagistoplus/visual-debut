<?php

namespace BagistoPlus\VisualDebut\Sections;

use BagistoPlus\Visual\Actions\Checkout\PlaceOrder;
use BagistoPlus\Visual\Actions\Checkout\StoreAddresses;
use BagistoPlus\Visual\Actions\Checkout\StorePaymentMethod;
use BagistoPlus\Visual\Actions\Checkout\StoreShippingMethod;
use BagistoPlus\Visual\Blocks\LivewireSection;
use BagistoPlus\Visual\Enums\Events;
use BagistoPlus\Visual\Facades\ThemeEditor;
use BagistoPlus\VisualDebut\Data\AddressData;
use BagistoPlus\VisualDebut\Support\HasColorSchemeSetting;
use BagistoPlus\VisualDebut\Support\InteractsWithCart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Webkul\Checkout\Facades\Cart;
use Webkul\Customer\Models\Customer;

use function BagistoPlus\VisualDebut\_t;

#[On(Events::COUPON_APPLIED)]
#[On(Events::COUPON_REMOVED)]
class Checkout extends LivewireSection
{
    use HasColorSchemeSetting;

    protected static string $type = '@visual-debut/checkout';

    use InteractsWithCart;

    protected static array $enabledOn = [
        'templates' => ['checkout'],
        'template' => ['main'],
    ];

    protected static string $view = 'shop::sections.checkout';

    protected static string $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>';

    protected static string $category = 'Commerce';

    protected static string $previewImageUrl = 'themes/shop/visual-debut/images/sections/checkout.png';

    public string $currentStep = 'address';

    public AddressData $billingAddress;

    public AddressData $shippingAddress;

    public array $shippingMethods = [];

    public array $paymentMethods = [];

    public string $selectedShippingMethod = '';

    public string $selectedPaymentMethod = '';

    /** @var Collection<int, AddressData> */
    protected Collection $savedAddresses;

    protected ?AddressData $cartBillingAddress = null;

    protected ?AddressData $cartShippingAddress = null;

    public static function name(): string
    {
        return _t('sections.checkout.name');
    }

    public static function description(): string
    {
        return _t('sections.checkout.description');
    }

    public static function settings(): array
    {
        return [
            static::colorSchemeSetting(),
        ];
    }

    /**
     * Initialize the component state.
     */
    public function boot()
    {
        $this->loadSavedAddresses();
        $this->loadCartAddresses();
    }

    /**
     * Bagisto's checkout only turns away a missing cart, and an emptied cart can stay active.
     */
    public function mount()
    {
        if (! ThemeEditor::inDesignMode() && ! $this->getCart()?->items->count()) {
            return $this->redirectRoute('shop.checkout.cart.index');
        }

        $this->initializeAddresses();
    }

    /**
     * Handle the address form submission.
     */
    public function handleAddressForm(StoreAddresses $storeAddresses)
    {
        $data = ['billing' => $this->addressForSubmission($this->billingAddress)];

        if (! $this->billingAddress->use_for_shipping) {
            $data['shipping'] = $this->addressForSubmission($this->shippingAddress);
        }

        try {
            $response = $storeAddresses->execute($data);
        } catch (ValidationException $e) {
            $this->revealInvalidAddresses($e);

            // Bagisto keys errors by billing.* and shipping.*, but Livewire only keeps errors keyed by
            // a component property, so they are moved onto the properties the fields are bound to
            throw ValidationException::withMessages(
                collect($e->validator->errors()->messages())
                    ->mapWithKeys(fn (array $messages, string $key): array => [
                        preg_replace('/^(billing|shipping)\./', '$1Address.', $key) => $messages,
                    ])
                    ->all()
            );
        }

        if (isset($response['redirect_url'])) {
            return $this->redirect($response['redirect_url']);
        }

        $this->resetErrorBag();
        $this->refreshAddresses();

        return $this->cartHaveStockableItems()
            ? $this->moveToShippingStep($response['data']['shippingMethods'])
            : $this->moveToPaymentStep($response['data']['payment_methods']);
    }

    /**
     * Handle shipping method selection.
     */
    public function handleShippingMethod(StoreShippingMethod $storeShippingMethod, string $method)
    {
        $response = $storeShippingMethod->execute($method);

        if (isset($response['redirect_url'])) {
            return $this->redirect($response['redirect_url']);
        }

        $this->moveToPaymentStep($response['payment_methods']);
    }

    /**
     * Handle payment method selection.
     */
    public function handlePaymentMethod(StorePaymentMethod $storePaymentMethod, string $method)
    {
        $response = $storePaymentMethod->execute($method);

        if (isset($response['redirect_url'])) {
            return $this->redirect($response['redirect_url']);
        }

        $this->currentStep = 'review';

        $this->dispatch(Events::PAYMENT_METHOD_SET, paymentMethod: $method);
    }

    /**
     * Place the order.
     */
    public function placeOrder(PlaceOrder $placeOrder)
    {
        $response = $placeOrder->execute();

        if (isset($response['message'])) {
            session()->flash('info', $response['message']);
        }

        if (isset($response['redirect_url'])) {
            $this->redirect($response['redirect_url']);
        }
    }

    /**
     * Move to the shipping method step.
     */
    protected function moveToShippingStep(array $shippingMethods)
    {
        $this->currentStep = 'shipping';
        $this->shippingMethods = $shippingMethods;
        $this->selectedShippingMethod = '';
    }

    /**
     * Move to the payment method step.
     */
    protected function moveToPaymentStep(array $paymentMethods)
    {
        $this->currentStep = 'payment';
        $this->paymentMethods = $paymentMethods;
        $this->selectedPaymentMethod = '';
    }

    /**
     * Get view data for the component.
     */
    public function getViewData(): array
    {
        $data = [
            'cart' => $this->getCartResource(),
            'savedAddresses' => $this->savedAddresses,
        ];

        return $data;
    }

    /**
     * Initialize the billing and shipping addresses.
     */
    protected function initializeAddresses(): void
    {
        $this->billingAddress = $this->cartBillingAddress ?? AddressData::empty();
        $this->shippingAddress = $this->cartShippingAddress ?? AddressData::empty();

        $this->applyDefaultAddress();
    }

    /**
     * Reads the cart's addresses, listing them among the saved ones where needed.
     */
    protected function loadCartAddresses(): void
    {
        $cart = $this->getCart();

        $this->cartBillingAddress = $cart?->billing_address
            ? $this->addressFromCart($cart->billing_address->toArray())
            : null;

        // With use_for_shipping, the shipping row is a second copy of billing, already listed
        $this->cartShippingAddress = $cart?->shipping_address
            ? $this->addressFromCart($cart->shipping_address->toArray(), list: ! $cart->billing_address?->use_for_shipping)
            : null;
    }

    /**
     * A saved address picked from the list keeps its fields hidden, so a field error on it would
     * go unseen. The failing address forms are told to show their fields, and the first error
     * is toasted in case those fields sit below the fold.
     */
    protected function revealInvalidAddresses(ValidationException $e): void
    {
        $addresses = collect($e->validator->errors()->keys())
            ->map(fn (string $key): string => explode('.', $key)[0])
            ->unique()
            ->values()
            ->all();

        $this->dispatch('checkout-address-invalid', addresses: $addresses);
        $this->dispatch('toasts:create', type: 'error', title: $e->validator->errors()->first());
    }

    /**
     * boot() built the address list before this request stored the addresses, so it is rebuilt
     * from the saved addresses and the cart as they are now.
     */
    protected function refreshAddresses(): void
    {
        $customer = Auth::guard('customer')->user();

        if ($customer instanceof Customer) {
            $customer->unsetRelation('addresses');
        }

        // @phpstan-ignore-next-line
        Cart::refreshCart();

        $this->loadSavedAddresses();
        $this->loadCartAddresses();
        $this->initializeAddresses();
    }

    /**
     * A cart copy listed among the saved addresses carries its cart row id, which Bagisto's
     * customer address update cannot find. It goes in as a new address instead, so saving it
     * creates a saved address and leaving it unsaved only updates the cart.
     */
    protected function addressForSubmission(AddressData $address): array
    {
        $data = $address->toArray();

        if ($data['id'] && $data['address_type'] !== 'customer') {
            $data['id'] = null;
            $data['address_type'] = '';
        }

        return $data;
    }

    /**
     * Picking a saved address copies it into the cart, so on reload the saved address it came
     * from is reused instead of listing the copy next to it. A copy edited without being saved
     * no longer matches, and is listed on its own so the edit is kept.
     */
    protected function addressFromCart(array $cartAddress, bool $list = true): AddressData
    {
        $address = AddressData::fromArray($cartAddress);

        $saved = $this->savedAddresses->first(
            fn (AddressData $savedAddress): bool => $savedAddress->id === (int) ($cartAddress['parent_address_id'] ?? 0)
        );

        if ($saved instanceof AddressData && $this->sameAddress($saved, $address)) {
            return AddressData::fromArray([...$saved->toArray(), 'use_for_shipping' => $address->use_for_shipping]);
        }

        if ($list) {
            $this->savedAddresses->prepend($address);
        }

        return $address;
    }

    protected function sameAddress(AddressData $a, AddressData $b): bool
    {
        $fields = ['company_name', 'email', 'first_name', 'last_name', 'address', 'country', 'state', 'city', 'postcode', 'phone'];

        return array_intersect_key($a->toArray(), array_flip($fields)) == array_intersect_key($b->toArray(), array_flip($fields));
    }

    protected function loadSavedAddresses(): void
    {
        if (! Auth::guard('customer')->check()) {
            $this->savedAddresses = collect();

            return;
        }

        $customer = Auth::guard('customer')->user();

        if (! ($customer instanceof Customer)) {
            $this->savedAddresses = collect();

            return;
        }

        $this->savedAddresses = $customer
            ->addresses
            ->map(fn ($address): AddressData => AddressData::fromArray([...$address->toArray(), 'use_for_shipping' => true]));
    }

    protected function applyDefaultAddress(): void
    {
        $default = $this->savedAddresses->first(fn (AddressData $addr): bool => $addr->default_address);

        if (! ($default instanceof AddressData)) {
            return;
        }

        if (! $this->billingAddress->id) {
            $this->billingAddress = AddressData::fromArray([
                ...$default->toArray(),
                'save_address' => true,
                'use_for_shipping' => $this->billingAddress->use_for_shipping,
            ]);
        }

        if (! $this->shippingAddress->id) {
            $this->shippingAddress = AddressData::fromArray([
                ...$default->toArray(),
                'save_address' => true,
            ]);
        }
    }
}
