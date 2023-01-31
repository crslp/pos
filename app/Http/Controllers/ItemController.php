<?php

namespace App\Http\Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return view('item.index');
    }

    public function create()
    {
        return view('item.create');
    }

    public function edit(Item $item)
    {
        return view('item.edit', [
            'item' => $item,
        ]);
    }
}
