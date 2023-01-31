<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class ItemEdit extends Component
{
    public Item $item;

    protected $rules = [
        'item.name' => ['required', 'string', 'max:255'],
        'item.price' => ['required', 'numeric'],
    ];

    public function mount(Item $item)
    {
        $this->item = $item;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->item->update($validated);
        session()->flash('message', __('Item successfully updated.'));
    }

    public function render()
    {
        return view('livewire.item-edit');
    }
}
