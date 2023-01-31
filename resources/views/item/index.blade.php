<x-layout>
    <div class="mb-5">
        <a href="{{ route('table.index') }}">{{ __('Back to Tables') }}</a>
    </div>
    <div>
        <a href="{{ route('item.create') }}">{{ __('Create an Item') }}</a>
    </div>
    <livewire:item-index />
</x-layout>
