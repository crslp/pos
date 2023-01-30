<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Receipt;
use Livewire\Component;
use Livewire\WithPagination;

class ReceiptIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.receipt-index', [
            'receipts' => Receipt::paginate(10),
        ]);
    }
}
