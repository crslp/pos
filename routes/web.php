<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('table.index');
});

Route::resource('item', Controllers\ItemController::class)->only('index', 'create', 'edit');
Route::resource('receipt', Controllers\ReceiptController::class)->only('index', 'show');
Route::resource('table', Controllers\TableController::class)->only('index', 'show');
Route::get('checkout/{order}', [Controllers\CheckoutController::class, 'show'])->name('checkout.show');
Route::post('checkout/{order}/pay', [Controllers\CheckoutController::class, 'pay'])->name('checkout.pay');
