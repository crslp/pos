<x-layout>
    <div>
        <a href="{{ route('receipt.index') }}">{{ __('Back to Receipts') }}</a>
    </div>
    <div>
        {{ __('Receipt') }}: #{{ $receipt->id }}, {{ $receipt->created_at }}
    </div>
    <div>
        {{ __('Total') }}: {{ $receipt->total }}
    </div>
    @foreach($receipt->items as $item)
        <div>{{ $item->name }} .. {{ $item->price }} EUR @if ($item->split) ({{ __('Split') }} {{ $item->split }}) @endif</div>
    @endforeach
</x-layout>
