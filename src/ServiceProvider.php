<?php

namespace BagistoPlus\VisualDebut;

use BagistoPlus\Visual\Facades\ThemeEditor;
use BagistoPlus\Visual\Providers\ThemeServiceProvider;
use BagistoPlus\Visual\Settings\Support\SettingsValues;
use BagistoPlus\VisualDebut\Components\Livewire\AddToCartButton;
use BagistoPlus\VisualDebut\Components\Livewire\AddToCompareButton;
use BagistoPlus\VisualDebut\Components\Livewire\AddToWishlistButton;
use BagistoPlus\VisualDebut\Components\Livewire\CartCouponForm;
use BagistoPlus\VisualDebut\Components\Livewire\CartPreview;
use BagistoPlus\VisualDebut\Components\Livewire\EstimateShipping;
use BagistoPlus\VisualDebut\LivewireFeatures\AddressDataSynth;
use BagistoPlus\VisualDebut\LivewireFeatures\InterceptSessionFlash;
use BagistoPlus\VisualDebut\Settings\Support\RadiusTransformer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Vite;
use Livewire\Livewire;
use Webkul\Theme\ViewRenderEventManager;

class ServiceProvider extends ThemeServiceProvider
{
    protected static array $livewireComponents = [
        'cart-preview' => CartPreview::class,
        'cart-coupon-form' => CartCouponForm::class,
        'add-to-cart-button' => AddToCartButton::class,
        'add-to-wishlist-button' => AddToWishlistButton::class,
        'add-to-compare-button' => AddToCompareButton::class,
        'estimate-shipping' => EstimateShipping::class,
    ];

    public function register(): void
    {
        parent::register();

        $this->mergeConfigFrom($this->getBasePath() . '/config/iconmap.php', 'bagisto_visual_iconmap');
    }

    public function boot(): void
    {
        parent::boot();

        $this->bootVendorViews();
        $this->bootBladeComponents();
        $this->bootLivewireComponents();
        $this->bootViewEventListeners();
        $this->bootLivewireFeatures();

        $this->whenActive(function () {
            $this->bootVendorViews();
        });

        ThemeEditor::serving(function () {
            ThemeEditor::assets('themes/shop/visual-debut/editor');
        });

        SettingsValues::registerTransformer('radius', new RadiusTransformer);
    }

    protected function bootVendorViews(): void
    {
        $this->app['view']->prependNamespace('paypal', __DIR__ . '/../resources/views/webkul/paypal');
    }

    protected function bootBladeComponents()
    {
        Blade::componentNamespace('BagistoPlus\\VisualDebut\\Components\\Blade', 'visual-debut');
    }

    protected function bootLivewireComponents(): void
    {
        foreach (self::$livewireComponents as $name => $component) {
            Livewire::component($name, $component);
        }
    }

    protected function bootLivewireFeatures(): void
    {
        $this->app['livewire']->componentHook(InterceptSessionFlash::class);
        Livewire::propertySynthesizer(AddressDataSynth::class);
    }

    protected function bootViewEventListeners()
    {
        $this->whenActive(function () {
            Event::listen('bagisto.shop.checkout.payment.paypal_smart_button', function (ViewRenderEventManager $event) {
                $event->addTemplate('paypal::checkout.onepage.payment-button');
            });
        });
    }
}
