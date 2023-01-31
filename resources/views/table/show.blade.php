<x-layout>
    <div class="mb-5">
        <a href="{{ route('table.index') }}">{{ __('Back to all Tables') }}</a>
    </div>
    <div class="h4 my-4">
        {{ __('Table') }}: {{ $table->name }}
    </div>
    <livewire:table-show :table="$table" />
</x-layout>
