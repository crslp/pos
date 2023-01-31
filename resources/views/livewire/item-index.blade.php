<div>
    @foreach($items as $item)
        <div>
            {{ $item->name }}: {{ $item->price }} EUR
            <a href="{{ route('items.edit', ['item' => $item->id]) }}">{{ __('Edit') }}</a>
        </div>
    @endforeach
</div>
