<div>
    <div>
        @forelse($orders as $order)
            <div>
                {{ $order->item->name }}
            </div>
        @empty
            {{ __('No items') }}
        @endforelse
    </div>
    <div>
        <div>
            {{ __('Items') }}
        </div>
        <div>
            @if (session()->has('message')) {{ session('message') }} @endif
            @foreach($items as $item)
               <div>
                   {{ $item->name }}: {{ $item->price }} <button wire:click="addToOrder({{ $item->id }})">{{ __('Add to order') }}</button>
               </div>
            @endforeach
        </div>
    </div>
</div>
