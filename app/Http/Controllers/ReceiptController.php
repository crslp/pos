<?php

namespace App\Http\Controllers;

use App\Models\Receipt;

class ReceiptController extends Controller
{
    public function index()
    {
        return view('receipt.index');
    }

    public function show(Receipt $receipt)
    {
        return view('receipt.show', [
            'receipt' => $receipt,
        ]);
    }
}
