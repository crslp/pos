<div>
    @foreach($items as $item)
        <div class="mb-2">
            {{ $item->name }}: {{ $item->price }} EUR
            <a class="btn btn-light btn-sm" href="{{ route('item.edit', ['item' => $item->id]) }}">{{ __('Edit') }}</a>
            <button class="btn btn-danger btn-sm" type="button" wire:click="destroy({{$item->id}})">{{ __('Delete') }}</button>
        </div>
    @endforeach
</div>
