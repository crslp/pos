<x-layout>
    <div>
        <a href="{{ route('receipt.index') }}">{{ __('Receipts') }}</a>
    </div>
    <div class="my-2">
        <a href="{{ route('item.index') }}">{{ __('Items') }}</a>
    </div>

    <div class="container text-center mt-5">
        <div class="row gx-5 gy-5">
            @forelse($tables as $table)
                <div class="p-3 border bg-light @if ($loop->last) col-full @else col-6 @endif">
                    <a href="{{ route('table.show', $table->id) }}">{{ __('Table') }} {{ $table->name }}</a>
                </div>
            @empty
                <span class="my-5">{{ __('No Tables. Please add some though the database.') }}</span>
            @endforelse
        </div>
    </div>


</x-layout>
