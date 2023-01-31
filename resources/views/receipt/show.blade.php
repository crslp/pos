<x-layout>
    @foreach($receipt->items as $item)
        <div>{{ $item->name }} .. {{ $item->price }} EUR ({{ __('Split') }} {{ $item->split }})</div>
    @endforeach
</x-layout>
