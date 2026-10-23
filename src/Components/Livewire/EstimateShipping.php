<?php

namespace BagistoPlus\VisualDebut\Components\Livewire;

use BagistoPlus\Visual\Enums\Events;
use Livewire\Component;
use Webkul\Shop\Http\Controllers\API\CartController;

class EstimateShipping extends Component
{
    public string $country = '';

    public string $state = '';

    public string $postcode = '';

    public string $shippingMethod = '';

    public array $shippingMethods = [];

    public function updated($name, $value)
    {
        $data = [
            'country' => $this->country,
            'state' => $this->state,
            'postcode' => $this->postcode,
        ];

        // Only add "shipping_method" if it has a value
        if (! empty($this->shippingMethod)) {
            $data['shipping_method'] = $this->shippingMethod;
        }

        request()->merge($data);

        $response = app(CartController::class)->estimateShippingMethods();
        $this->resetValidation();

        $this->shippingMethods = $response->resource['data']['shipping_methods'];

        if ($this->shippingMethod) {
            // Sent to every listener, like the coupon form does: the cart section's Livewire
            // name is its full class name, so an event targeted at its class never reached it
            $this->dispatch(Events::SHIPPING_METHOD_SET);
        }
    }

    public function render()
    {
        return view()->make('shop::livewire.estimate-shipping', [
            'countries' => core()->countries(),
            'states' => core()->groupedStatesByCountries(),
        ]);
    }
}
