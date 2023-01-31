<x-layout>
    <div class="mb-5">
        <a href="{{ route('table.index') }}">{{ __('Back to Tables') }}</a>
    </div>
    <div class="mb-3">
        <a class="btn btn-primary" href="{{ route('item.create') }}">{{ __('Create an Item') }}</a>
    </div>
    <livewire:item-index />
</x-layout>
