<div>
    <div>
        @forelse($orderItems as $orderItem)
            <div>
                @if(is_null($orderItem->split))
                    <input id="split_{{ $orderItem->id }}" type="checkbox"  wire:model="split" value="{{ $orderItem->id }}">
                @else
                    {{ __('Paid') }}
                @endif
                <label for="split_{{ $orderItem->id }}">
                    {{ $orderItem->item->name }}: {{ $orderItem->item->price }} EUR
                </label>
                @if(is_null($orderItem->split))
                    <button type="button" wire:click="removeFromOrder({{ $orderItem->id }})">{{ __('Remove') }}</button>
                @endif
            </div>
        @empty
            {{ __('No items') }}
        @endforelse
        @if ($total)
            <div>
                {{ __('Total') }}: {{ $total }} EUR
            </div>
            @if (empty($split) && $orderItems->filter(fn ($o) => !is_null($o->split))->isEmpty())
                <a href="{{ route('checkout.show', $order->id) }}">{{ __('Pay all') }}</a>
            @endif
            @if (!empty($split))
                <button type="button" wire:click="toggleSplitModal">{{ __('Pay Split') }}</button>
            @endif
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
    @if ($paySplitModal)
        <div>
            <p>
                {{ __('Pay Split') }}
            </p>
            <div>
                @foreach($splitItems as $splitItem)
                    <div>
                        {{ $splitItem['name'] }}: {{ $splitItem['price'] }} EUR
                    </div>
                @endforeach
                <div>
                    {{ __('Split') }}: {{ $splitTotal }}
                </div>
                <div>
                    <button type="button" wire:click="confirmPaySplit">{{ __('Confirm Pay Split') }}</button>
                </div>
            </div>
        </div>
    @endif
</div>
