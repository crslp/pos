<div>
    <p class="h5">
        {{ __('Create an Item') }}
    </p>
    <div class="mb-2">
        <input class="form-control" placeholder="{{ __('Name') }}" type="text" wire:model.defer="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <input class="form-control" placeholder="{{ __('Price') }}" type="text" wire:model.defer="price">
        @error('price') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div>
        <button class="btn btn-primary" type="submit" wire:click="save">{{ __('Save') }}</button>
    </div>
    <div class="my-5">
        <p class="h5">{{ __('Items') }}:</p>
        @foreach($items as $item)
            <div class="mb-1">
                {{ $item->name }}: {{ $item->price }} EUR
            </div>
        @endforeach
    </div>
</div>
