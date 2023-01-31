<div>
    <div>
        @forelse($orders as $order)
            <div>
                {{ $order->item->name }}: {{ $order->item->price }} EUR <button type="button" wire:click="removeFromOrder({{ $order->id }})">{{ __('Remove') }}</button>
            </div>
        @empty
            {{ __('No items') }}
        @endforelse
        @if ($total)
            {{ __('Total') }}: {{ $total }} EUR
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
