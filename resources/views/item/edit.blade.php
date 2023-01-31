<x-layout>
    <div>
        <a href="{{ route('item.index') }}">{{ __('Back to all Items') }}</a>
    </div>
    <livewire:item-edit :item="$item" />
</x-layout>
