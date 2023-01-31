<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\OrderItem;
use App\Models\Table;
use Livewire\Component;

class TableShow extends Component
{
    public Table $table;

    public $order;

    public $orderItems;

    public ?float $total = null;

    public $items;

    public function mount(Table $table)
    {
        $this->table = $table;
        $this->refresh();
    }

    public function refresh()
    {
        $this->order = $this->table->currentOrder->first();
        $this->orderItems = $this->order ? $this->order->items()->get() : [];
        $this->total = $this->order ? $this->order->refresh()->total : null;
        $this->items = Item::all();
    }

    public function addToOrder(string $item)
    {
        $item = Item::findOrFail($item);
        $this->order = $this->order ?? $this->table->orders()->create();
        $this->order->items()->create(['item_id' => $item->id]);
        $this->refresh();
        session()->flash('message', __('Added'));
    }

    public function removeFromOrder(string $orderItemId)
    {
        $orderItem = OrderItem::findOrFail($orderItemId);
        $orderItem->delete();
        $this->refresh();
        session()->flash('message', __('Removed'));
    }

    public function render()
    {
        return view('livewire.table-show');
    }
}
