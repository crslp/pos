<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ItemCreate extends Component
{
    use WithPagination;

    public string $name;

    public $price;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'price' => ['required', 'numeric'],
    ];

    public function save()
    {
        $validated = $this->validate();
        Item::create($validated);
    }

    public function render()
    {
        return view('livewire.item-create', [
            'items' => Item::paginate(),
        ]);
    }
}
