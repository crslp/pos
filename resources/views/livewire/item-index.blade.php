<div>
    @foreach($items as $item)
        <div>{{ $item->name }}: {{ $item->price }} EUR</div>
    @endforeach
</div>
