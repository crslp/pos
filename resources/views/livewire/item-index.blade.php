<div>
    @foreach($items as $item)
        <div>
            {{ $item->name }}: {{ $item->price }} EUR
            <a href="{{ route('item.edit', ['item' => $item->id]) }}">{{ __('Edit') }}</a>
            <button type="button" wire:click="destroy({{$item->id}})">{{ __('Delete') }}</button>
        </div>
    @endforeach
</div>
