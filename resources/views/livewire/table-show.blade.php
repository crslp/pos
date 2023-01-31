<div>
    <div>
        @forelse($orderItems as $orderItem)
            <div>
                {{ $orderItem->item->name }}: {{ $orderItem->item->price }} EUR <button type="button" wire:click="removeFromOrder({{ $orderItem->id }})">{{ __('Remove') }}</button>
            </div>
        @empty
            {{ __('No items') }}
        @endforelse
        @if ($total)
            <div>
                {{ __('Total') }}: {{ $total }} EUR
            </div>
            <a href="{{ route('checkout.show', $order->id) }}">{{ __('Pay all') }}</a>
        @endif
    </div>
    <div>
        <div>
            {{ __('Items') }}
        </div>
        <div>
            @if (session()->has('message')) {{ session('message') }} @endif
            @foreach($items as $item)
               <div>
                   {{ $item->name }}: {{ $item->price }} <button type="button" wire:click="addToOrder({{ $item->id }})">{{ __('Add to order') }}</button>
               </div>
            @endforeach
        </div>
    </div>
</div>
