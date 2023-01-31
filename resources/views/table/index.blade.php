<x-layout>
    @foreach($tables as $table)
        <div>
            <a href="{{ route('table.show', $table->id) }}">{{ __('Table') }} {{ $table->name }}</a>
        </div>
    @endforeach
</x-layout>
