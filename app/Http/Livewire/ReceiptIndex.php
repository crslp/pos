<?php

namespace App\Http\Livewire;

use App\Models\Receipt;
use Livewire\Component;
use Livewire\WithPagination;

class ReceiptIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.receipt-index', [
            'receipts' => Receipt::orderBy('id', 'DESC')->paginate(10),
        ]);
    }
}
