<x-layout>
    @foreach($receipt->items as $item)
        <div>{{ $item->name }} .. {{ $item->price }} EUR</div>
    @endforeach
</x-layout>
