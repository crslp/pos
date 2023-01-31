<x-layout>
    <div>
        <a href="{{ route('receipt.index') }}">{{ __('Receipts') }}</a>
    </div>
    @foreach($tables as $table)
        <div>
            <a href="{{ route('table.show', $table->id) }}">{{ __('Table') }} {{ $table->name }}</a>
        </div>
    @endforeach
</x-layout>
