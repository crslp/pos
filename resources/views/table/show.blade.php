<div>
    <a href="{{ route('table.index') }}">{{ __('Back to all Tables') }}</a>
    <div>
        {{ __('Table') }}: {{ $table->name }}
    </div>
    <div>
        @forelse($table->orders ?? [] as $order)
            <div>
                {{ $order->item->name }}
            </div>
        @empty
            {{ __('No items') }}
        @endforelse
    </div>
</div>
