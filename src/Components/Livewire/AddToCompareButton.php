<?php

namespace BagistoPlus\VisualDebut\Components\Livewire;

use BagistoPlus\Visual\Actions\Cart\AddProductToCompare;
use BagistoPlus\Visual\Enums\Events;
use BagistoPlus\VisualDebut\Support\InteractsWithCompare;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AddToCompareButton extends Component
{
    use InteractsWithCompare;

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

        $this->dispatch(Events::COMPARE_UPDATED, count: $this->getCompareItemsCount());
    }

    public function render()
    {
        return view()->make('shop::livewire.add-to-compare-button');
    }
}
