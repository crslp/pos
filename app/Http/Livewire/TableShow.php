<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Table;
use App\Models\TableOrder;
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

    public function removeFromOrder(string $item)
    {
        $order = TableOrder::findOrFail($item);
        $order->delete();
        $this->orders = $this->table->orders()->get();
        session()->flash('message', __('Removed'));
    }

    public function render()
    {
        return view('livewire.table-show');
    }
}
