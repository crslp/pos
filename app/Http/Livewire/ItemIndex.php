<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ItemIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.item-index', [
            'items' => Item::paginate(10),
        ]);
    }
}
