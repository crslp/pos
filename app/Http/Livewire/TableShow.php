<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\OrderItem;
use App\Models\Receipt;
use App\Models\Table;
use Livewire\Component;

class TableShow extends Component
{
    public Table $table;

    public $order;

    public $orderItems;

    public ?float $total = null;

    public $items;

    public array $split = [];

    public $splitItems;

    public bool $paySplitModal = false;

    public $splitTotal;

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

    public function toggleSplitModal()
    {
        $this->paySplitModal = ! $this->paySplitModal;
    }

    public function updatedSplit()
    {
        $this->splitItems = collect($this->split)->mapWithKeys(function ($orderItemId) {
            $orderItem = OrderItem::findOrFail($orderItemId);

            return [$orderItemId => [
                'name' => $orderItem->item->name,
                'price' => $orderItem->item->price,
            ]];
        });

        $this->splitTotal = $this->splitItems->map(fn ($i) => $i['price'])->sum();
    }

    public function confirmPaySplit()
    {
        $orderItems = collect($this->split)->flatten()->map(fn ($id) => \App\Models\OrderItem::find($id));
        $latestSplit = optional($this->order->items()->whereNotNull('split')->latest()->first())->split;
        $currentSplit = is_numeric($latestSplit) ? $latestSplit + 1 : 0;
        $receipt = $this->order->receipt ?? $this->order->receipt()->create(['table_id' => $this->order->table->id, 'total' => $this->order->total]);
        $orderItems->each(function (OrderItem $orderItem) use ($receipt, $currentSplit) {
            $this->createReceiptItem($orderItem, $receipt, $currentSplit);
        });

        $this->toggleSplitModal();
        $this->split = [];
        $this->refresh();
        session()->flash('message', __('Saved'));

        if ($this->order->items()->whereNull('split')->get()->isEmpty()) {
            $this->order->markAsPaid();
            $this->redirectRoute('table.index');
        }
    }

    public function render()
    {
        return view('livewire.table-show');
    }

    private function createReceiptItem(OrderItem $orderItem, Receipt $receipt, int $split)
    {
        $receipt->items()->create([
            'receipt_id' => $receipt->id,
            'price' => $orderItem->item->price,
            'name' => $orderItem->item->name,
            'split' => $split,
        ]);

        $orderItem->update(['split' => $split]);
    }
}
