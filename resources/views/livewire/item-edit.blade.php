<div>
    {{ __('Update Item') }}
    <div class="mb-2">
        <input class="form-control" placeholder="{{ __('Name') }}" type="text" wire:model.defer="item.name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <input class="form-control" placeholder="{{ __('Price') }}" type="text" wire:model.defer="item.price">
        @error('price') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mb-2">
        <button class="btn btn-primary" type="submit" wire:click="update">{{ __('Update') }}</button>
    </div>
    <div class="my-4">
        @if (session()->has('message'))
            <div>
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
