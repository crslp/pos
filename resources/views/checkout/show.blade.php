<x-layout>
    <div class="mb-5">
        <a href="{{ route('table.show', $order->table->id) }}">{{ __('Back to table') }}</a>
    </div>
    <div class="h5">
        {{ __('Pay table') }}: {{ $order->table->name }}
    </div>
    <div class="h6">
        {{ __('Order') }}: {{ $order->id }}
    </div>
    <div>
        {{ __('Total') }}: {{ $order->total }} EUR
    </div>
    <div class="my-2">
        @foreach($order->items as $orderItem)
            <div>
                {{ $loop->iteration }}: {{ $orderItem->item->name }} {{ $orderItem->item->price }} EUR
            </div>
        @endforeach
    </div>
    <form action="{{ route('checkout.pay', $order->id) }}" method="post">
        @csrf
        <input type="hidden" name="all" value="1">
        <button class="btn btn-primary mt-5" type="submit">{{ __('Confirm Payment') }}</button>
    </form>
</x-layout>
