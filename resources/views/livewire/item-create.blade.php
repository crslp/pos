<div>
    {{ __('Create an Item') }}
    <div>
        <input type="text" wire:model.defer="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div>
        <input type="text" wire:model.defer="price">
        @error('price') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div>
        <button type="submit" wire:click="save">{{ __('Save') }}</button>
    </div>
    <div>
        @foreach($items as $item)
            <div>
                {{ $item->name }}: {{ $item->price }}
            </div>
        @endforeach
    </div>
</div>
