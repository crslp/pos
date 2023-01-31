<div>
    @foreach($receipts as $receipt)
        <div>{{ __('Table') }} {{ $receipt->table->name }}: {{ $receipt->total }} EUR</div>
    @endforeach
</div>
