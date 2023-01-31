<div>
    @foreach($receipts as $receipt)
        <div>{{ __('Table') }} {{ $receipt->table }}: {{ $receipt->total }} EUR</div>
    @endforeach
</div>
