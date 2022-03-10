<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StockController extends Controller
{
    public function create(Request $request)
    {
        $attributes = $request->validate([
            'storage_id' => ['required', Rule::exists('storages', 'id')],
            'item_id' => ['required', Rule::exists('items', 'id')],
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        $stock = Stock::create($attributes);
    }

    public function update(Request $request, Stock $stock)
    {
        $attributes = $request->validate([
            'quantity' => ['required', 'integer'],
        ]);

        $attributes['quantity'] = $stock->quantity + $attributes['quantity'];

        if ($attributes['quantity'] < 0) {
            // Return error "You can't take more items than there are in the storage."
        }

        $stock->update($attributes);
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
    }
}