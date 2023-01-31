<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Receipt;

class CheckoutController extends Controller
{
    public function show(Order $order)
    {
        return view('checkout.show', [
            'order' => $order,
        ]);
    }

    public function pay(Order $order, PaymentRequest $request)
    {
        if ($request->all) {
            $receipt = Receipt::create([
                'order_id' => $order->id,
                'table_id' => $order->table->id,
                'total' => $order->total,
            ]);
            $order->items->each(function (OrderItem $orderItem) use ($receipt) {
                /** @var Receipt $receipt */
                $receipt->items()->create([
                    'receipt_id' => $receipt->id,
                    'price' => $orderItem->item->price,
                    'name' => $orderItem->item->name,
                    'split' => null, // null: pay all
                ]);
                $orderItem->update(['split' => null]);
            });

            $order->markAsPaid();
        }

        if (! $request->all) {
            $orderItems = collect($request->items)->flatten()->map(fn ($id) => \App\Models\OrderItem::find($id));
            $latestSplit = optional($order->items()->whereNotNull('split')->latest()->first())->split;
            $currentSplit = is_numeric($latestSplit) ? $latestSplit + 1 : 0;
            $receipt = $order->receipt ?? $order->receipt()->create(['table_id' => $order->table->id, 'total' => $order->total]);
            $orderItems->each(function (OrderItem $orderItem) use ($receipt, $currentSplit) {
                $this->createReceiptItem($orderItem, $receipt, $currentSplit);
            });

            if ($order->items()->whereNull('split')->get()->isEmpty()) {
                $order->markAsPaid();
            }
        }

        return redirect(route('table.index'));
    }

    private function createReceiptItem(OrderItem $orderItem, Receipt $receipt, int $split)
    {
        $receipt->items()->create([
            'receipt_id' => $receipt->id,
            'price' => $orderItem->item->price,
            'name' => $orderItem->item->name,
            'split' => $split,
        ]);

        // gehört hier nicht rein
        $orderItem->update(['split' => $split]);
    }
}
