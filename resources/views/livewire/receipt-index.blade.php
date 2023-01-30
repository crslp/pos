<div>
    @foreach($receipts as $receipt)
        <div>{{ $receipt->table }}: {{ $receipt->total }} EUR</div>
    @endforeach
</div>
