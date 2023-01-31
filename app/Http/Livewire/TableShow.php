<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Table;
use Livewire\Component;

class TableShow extends Component
{
    public Table $table;
    public $orders;
    public $items;

    public function mount(Table $table)
    {
        $this->table = $table;
        $this->orders = $table->orders;
        $this->items = Item::all();
    }

    public function addToOrder(string $item)
    {
        $item = Item::findOrFail($item);
        $this->table->orders()->create(['item_id' => $item->id]);
        $this->orders = $this->table->orders()->get();
        session()->flash('message', __('Added'));
    }

    public function render()
    {
        return view('livewire.table-show');
    }
}
