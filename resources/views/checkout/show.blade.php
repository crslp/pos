<x-layout>
    <div>
        <a href="{{ route('table.show', $order->table->id) }}">{{ __('Back to table') }}</a>
    </div>
    <div>
        {{ __('Pay table') }}: {{ $order->table->name }}
    </div>
    <div>
        {{ __('Order') }}: {{ $order->id }}
    </div>
    <div>
        {{ __('Total') }}: {{ $order->total }} EUR
    </div>
    <div>
        @foreach($order->items as $orderItem)
            <div>
                {{ $loop->iteration }}: {{ $orderItem->item->name }} {{ $orderItem->item->price }} EUR
            </div>
        @endforeach
    </div>
    <form action="{{ route('checkout.pay', $order->id) }}" method="post">
        @csrf
        <input type="hidden" name="all" value="1">
        <button type="submit">{{ __('Confirm Payment') }}</button>
    </form>
</x-layout>
