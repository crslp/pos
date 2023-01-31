<x-layout>
    <div>
        <a href="{{ route('receipt.index') }}">{{ __('Receipts') }}</a>
    </div>
    @forelse($tables as $table)
        <div>
            <a href="{{ route('table.show', $table->id) }}">{{ __('Table') }} {{ $table->name }}</a>
        </div>
    @empty
        {{ __('No Tables. Please add some though the database.') }}
    @endforelse
</x-layout>
