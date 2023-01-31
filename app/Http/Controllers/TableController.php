<?php

namespace App\Http\Controllers;

use App\Models\Table;

class TableController extends Controller
{
    public function index()
    {
        return view('table.index', [
            'tables' => Table::paginate(10),
        ]);
    }

    public function show(Table $table)
    {
        return view('table.show', [
            'table' => $table,
        ]);
    }
}
