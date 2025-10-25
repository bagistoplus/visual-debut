<?php

namespace BagistoPlus\VisualDebut\Components\Livewire;

use BagistoPlus\Visual\Actions\Cart\AddProductToCompare;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AddToCompareButton extends Component
{
    #[Locked]
    public $productId;

    public $size = 'md';
    public $variant = 'soft';
    public $color = 'secondary';
    public $icon = null;
    public $circle = false;
    public $square = false;
    public $block = false;

    public function handle()
    {
        $response = app(AddProductToCompare::class)->execute($this->productId);

        if (isset($response['message'])) {
            session()->flash('success', $response['message']);
        }
    }

    public function render()
    {
        return view('shop::livewire.add-to-compare-button');
    }
}
