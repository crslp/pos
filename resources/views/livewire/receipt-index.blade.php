<div>
    @foreach($receipts as $receipt)
        <div>
            {{ $receipt->created_at }} {{ __('Table') }} {{ $receipt->table->name }}: {{ $receipt->total }} EUR
            <a href="{{ route('receipt.show', $receipt->id) }}">{{ __('Show Receipt') }}</a>
        </div>
    @endforeach
</div>
