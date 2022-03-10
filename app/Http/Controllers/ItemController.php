<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function create(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', Rule::unique('items', 'name')],
            'price' => ['required', 'numeric'],
        ]);

        $item = Item::create($attributes);
    }

    public function update(Request $request, Item $item)
    {
        $attributes = $request->validate([
            'price' => ['required', 'numeric'],
        ]);

        $item->update($attributes);
    }

    public function destroy(Item $item)
    {
        $item->delete();
    }
}