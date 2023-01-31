<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ItemIndex extends Component
{
    use WithPagination;

    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        session()->flash('message', __('Item deleted.'));
    }

    public function render()
    {
        return view('livewire.item-index', [
            'items' => Item::paginate(10),
        ]);
    }
}
