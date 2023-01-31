<x-layout>
    <div class="mb-5">
        <a href="{{ route('receipt.index') }}">{{ __('Back to Receipts') }}</a>
    </div>
    <div class="h3">
        {{ __('Receipt') }}: #{{ $receipt->id }}
    </div>
    <div class="h6">
        {{ $receipt->created_at }}
    </div>
    <div class="h3 my-4">
        {{ __('Total') }}: {{ $receipt->total }}
    </div>
    <div class="my-6">
        <p class="h5">{{ __('Items') }}</p>
        @foreach($receipt->items as $item)
            <div class="d-flex">
                <span class="me-auto">{{ $item->name }}</span>
                {{ $item->price }} EUR @if ($item->split) <span class="badge rounded-pill text-bg-secondary">{{ __('Split') }} {{ $item->split }}</span> @endif
            </div>
        @endforeach
    </div>
</x-layout>
