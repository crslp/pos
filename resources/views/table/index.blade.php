<x-layout>
    <div class="mb-5">
        <a href="{{ route('receipt.index') }}">{{ __('Receipts') }}</a>
    </div>

    <div class="container text-center">
        <div class="row gx-5 gy-5">
            @forelse($tables as $table)
                <div class="p-3 border bg-light @if ($loop->last) col-full @else col-6 @endif">
                    <a href="{{ route('table.show', $table->id) }}">{{ __('Table') }} {{ $table->name }}</a>
                </div>
            @empty
                {{ __('No Tables. Please add some though the database.') }}
            @endforelse
        </div>
    </div>


</x-layout>
