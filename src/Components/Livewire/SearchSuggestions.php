<?php

namespace BagistoPlus\VisualDebut\Components\Livewire;

use Livewire\Component;
use Webkul\Product\Models\ProductFlat;

class SearchSuggestions extends Component
{

    public $searchIcon;
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $minLength = 1;

        if (strlen($this->query) >= $minLength) {

            // Split the input into keywords
            $keywords = preg_split('/\s+/', trim($this->query));

            $this->results = ProductFlat::with(['product.images'])
                ->where('status', true)
                ->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->where('name', 'like', "%{$word}%");
                    }
                })
                ->take(30)
                ->get();

        } else {
            $this->results = [];
        }
    }


    public function render()
    {
        return view('livewire.search-suggestions');
    }
}
