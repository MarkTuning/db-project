<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StorageItem;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class StorageItemController extends Controller
{
    public function add(): View|Factory
    {
        return view('supplies.add', [
            'storages' => Storage::where('user_id', auth()->user()->id)->get(),
            'items' => Item::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function edit(): View|Factory
    {
        $storageItems = StorageItem::whereIn('storage_id', function ($query) {
            return $query->select('id')
                ->from('storages')
                ->where('user_id', auth()->user()->id);
        })->get();

        return view('supplies.edit', [
            'storageItems' => $storageItems,
            'storages' => Storage::where('user_id', auth()->user()->id)->get(),
            'items' => Item::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function remove(): View|Factory
    {
        $storageItems = StorageItem::whereIn('storage_id', function ($query) {
            return $query->select('id')
                ->from('storages')
                ->where('user_id', auth()->user()->id);
        })->get();

        return view('supplies.remove', [
            'storageItems' => $storageItems,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'storage_id' => ['required', Rule::exists('storages', 'id')->where(function($query) {
                return $query->whereIn('id', function($query) {
                    return $query->select('id')
                        ->from('storages')
                        ->where('user_id', auth()->user()->id);
                });
            })],
            'item_id' => ['required', Rule::exists('items', 'id')->where(function($query) {
                return $query->whereIn('id', function($query) {
                    return $query->select('id')
                        ->from('items')
                        ->where('user_id', auth()->user()->id);
                });
            })],
            'quantity' => ['required', 'integer', 'min:0'],
        ]);

        StorageItem::create($attributes);

        return redirect()->back();
    }

    public function update(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'storageItem_id' => 'required', Rule::exists('storage_items', 'id')->where(function($query) {
                return $query->whereIn('storage_id', function($query) {
                    return $query->select('id')
                        ->from('storages')
                        ->where('user_id', auth()->user()->id);
                });
            }),
            'storage_id' => ['nullable', Rule::exists('storages', 'id')->where(function($query) {
                return $query->whereIn('id', function($query) {
                    return $query->select('id')
                        ->from('storages')
                        ->where('user_id', auth()->user()->id);
                });
            })],
            'item_id' => ['nullable', Rule::exists('items', 'id')->where(function($query) {
                return $query->whereIn('id', function($query) {
                    return $query->select('id')
                        ->from('items')
                        ->where('user_id', auth()->user()->id);
                });
            })],
            'quantity' => ['nullable', 'integer', 'min:0'],
        ]);

        $storageItem = StorageItem::where('id', $attributes['storageItem_id'])->first();

        if (isset($attributes['storage_id'])) {
            if ($attributes['storage_id'] != null) {
                $storageItem->storage_id = $attributes['storage_id'];
            }
        }
        if (isset($attributes['item_id'])) {
            if ($attributes['item_id'] != null) {
                $storageItem->item_id = $attributes['item_id'];
            }
        }
        if ($attributes['quantity'] != null) {
            $storageItem->quantity = $attributes['quantity'];
        }
        
        $storageItem->update();

        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'storageItem_id' => 'required', Rule::exists('storage_items', 'id')->where(function($query) {
                return $query->whereIn('storage_id', function($query) {
                    return $query->select('id')
                        ->from('storages')
                        ->where('user_id', auth()->user()->id);
                });
            }),
        ]);

        StorageItem::where('id', $attributes['storageItem_id'])->first()->delete();

        return redirect()->back();
    }
}