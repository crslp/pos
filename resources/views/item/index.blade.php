<x-layout>
    <div>
        <a href="{{ route('items.create') }}">{{ __('Create an Item') }}</a>
    </div>
    <livewire:item-index />
</x-layout>
