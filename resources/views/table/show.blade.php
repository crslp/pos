<x-layout>
    <a href="{{ route('table.index') }}">{{ __('Back to all Tables') }}</a>
    <div>
        {{ __('Table') }}: {{ $table->name }}
    </div>
    <livewire:table-show :table="$table" />
</x-layout>
