<div>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                @forelse($orderItems as $orderItem)
                    <div class="row my-2">
                        <div class="col d-flex">
                            @if(is_null($orderItem->split))
                                <div class="form-check ms-2 me-auto">
                                    <input id="split_{{ $orderItem->id }}" class="form-check-input" type="checkbox"  wire:model="split" value="{{ $orderItem->id }}">
                                </div>
                            @else
                                <span class="badge rounded-pill text-bg-success me-auto">{{ __('Paid') }}</span>
                            @endif
                        </div>
                        <div class="col d-flex">
                            <label for="split_{{ $orderItem->id }}" class="me-auto">
                                {{ $orderItem->item->name }}
                            </label>
                            <span class="ms-auto">{{ $orderItem->item->price }} EUR</span>
                        </div>
                        <div class="col">
                            @if(is_null($orderItem->split))
                                <button type="button" class="btn btn-danger btn-sm" wire:click="removeFromOrder({{ $orderItem->id }})">{{ __('Remove') }}</button>
                            @endif
                        </div>
                    </div>
                @empty
                    <span class="h5">{{ __('No items in this order') }}</span>
                @endforelse
            </div>
            <div class="col">
                <div class="text-start h4">
                    {{ __('Items') }}
                </div>
                @if (session()->has('message')) {{ session('message') }} @endif
                <div class="container text-center">
                    @foreach($items as $item)
                        <div class="row my-1">
                            <div class="col d-flex">
                                <span class="me-auto">{{ $item->name }}</span>
                                <span class="my-auto">{{ $item->price }} EUR</span>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-light" wire:click="addToOrder({{ $item->id }})">{{ __('Add to order') }}</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div>
        @if ($total)
            <div class="h4">
                {{ __('Total') }}: <span class="fw-bold">{{ $total }} EUR</span>
            </div>
            @if (empty($split) && $orderItems->filter(fn ($o) => !is_null($o->split))->isEmpty())
                <a class="btn btn-primary my-4" href="{{ route('checkout.show', $order->id) }}">{{ __('Pay all') }}</a>
            @endif
            @if (!empty($split))
                <button type="button" class="btn btn-secondary" wire:click="toggleSplitModal">{{ __('Pay Split') }}</button>
            @endif
        @endif
    </div>

    @if ($paySplitModal)
        <div class="modal show" style="display: block; background: rgba(0, 0, 0, 0.75);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Pay Split') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @foreach($splitItems as $splitItem)
                            <div class="d-flex">
                                {{ $splitItem['name'] }}: <span class="ms-auto">{{ $splitItem['price'] }} EUR</span>
                            </div>
                        @endforeach
                        <div class="my-3 d-flex">
                            <span class="ms-auto h5">{{ __('Split') }}: {{ $splitTotal }} EUR</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="toggleSplitModal">{{ __('Close') }}</button>
                        <button type="button" class="btn btn-primary" wire:click="confirmPaySplit">{{ __('Confirm Pay Split') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
