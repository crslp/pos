<div>
    {{ __('Update Item') }}
    <div>
        <input type="text" wire:model.defer="item.name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div>
        <input type="text" wire:model.defer="item.price">
        @error('price') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div>
        <button type="submit" wire:click="update">{{ __('Update') }}</button>
    </div>
    <div>
        @if (session()->has('message'))
            <div>
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
