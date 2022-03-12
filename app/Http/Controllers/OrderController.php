<?php

namespace App\Http\Controllers;

use App\Models\StorageItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function index(): View|Factory
    {
        $storageItems = StorageItem::whereIn('storage_id', function ($query) {
            return $query->select('id')
                ->from('storages')
                ->where('user_id', auth()->user()->id);
        })->get();

        return view('orders.index', [
            'storageItems' => $storageItems,
        ]);
    }

    public function store(Request $request): RedirectResponse|ValidationException
    {
        $attributes = $request->validate([
            'storageItem_id' => 'required', Rule::exists('storage_items', 'id')->where(function($query) {
                return $query->whereIn('storage_id', function($query) {
                    return $query->select('id')
                        ->from('storages')
                        ->where('user_id', auth()->user()->id);
                });
            }),
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $storageItem = StorageItem::where('id', $attributes['storageItem_id'])->first();

        if ($storageItem->quantity - $attributes['quantity'] < 0) {
            return redirect()->back()->withErrors(['quantity' => 'You can\'t place an order that has a higher quantity demand than what you have in the storage.']);
        }

        $storageItem->quantity = $storageItem->quantity - $attributes['quantity'];

        $storageItem->update();

        return redirect()->back();
    }
}