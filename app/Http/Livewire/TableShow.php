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

    public ?float $total = null;

    public $items;

    public function mount(Table $table)
    {
        $this->table = $table;
        $this->refresh();
    }

    public function refresh()
    {
        $this->orders = $this->table->orders()->get();
        $this->total = $this->table->refresh()->total;
        $this->items = Item::all();
    }

    public function addToOrder(string $item)
    {
        $item = Item::findOrFail($item);
        $this->table->orders()->create(['item_id' => $item->id]);
        $this->refresh();
        session()->flash('message', __('Added'));
    }

    public function removeFromOrder(string $item)
    {
        $order = TableOrder::findOrFail($item);
        $order->delete();
        $this->refresh();
        session()->flash('message', __('Removed'));
    }

    public function render()
    {
        return view('livewire.table-show');
    }
}
