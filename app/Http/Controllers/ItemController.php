<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StorageItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class ItemController extends Controller
{
    public function add(): View|Factory
    {
        return view('items.add');
    }

    public function edit(): View|Factory
    {
        return view('items.edit', [
            'items' => Item::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function remove(): View|Factory
    {
        return view('items.remove', [
            'items' => Item::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', Rule::unique('items')->where(function($query) {
                return $query->whereIn('name', function($query) {
                    return $query->select('name')
                        ->from('items')
                        ->where('user_id', auth()->user()->id);
                });
            })],
            'price' => ['required', 'numeric'],
        ]);

        $attributes['user_id'] = auth()->user()->id;
        $attributes['price'] = number_format((float)$attributes['price'], 2);

        Item::create($attributes);

        return redirect()->back();
    }

    public function update(Request $request): RedirectResponse
    {
        $id = $request->validate([
            'item_id' => ['required', Rule::exists('items', 'id')],
        ]);

        $item = Item::where('id', $id['item_id'])->first();

        if (auth()->user()->id !== $item->owner->id) {
            return redirect()->back()->with('message', 'Only the owner of the item can update it.');
        }

        $attributes = $request->validate([
            'name' => ['nullable', 'string', Rule::unique('items')->where(function($query) {
                return $query->whereIn('name', function($query) {
                    return $query->select('name')
                        ->from('items')
                        ->where('user_id', auth()->user()->id);
                });
            })],
            'price' => ['nullable', 'numeric'],
        ]);

        if ($attributes['name'] != null) {
            $item->name = $attributes['name'];
        }

        if ($attributes['price'] !== null) {
            $item->price = $attributes['price'];
        }

        $item->update();

        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        $id = $request->validate([
            'item_id' => ['required', Rule::exists('items', 'id')],
        ]);

        $item = Item::where('id', $id['item_id'])->first();

        if (auth()->user()->id !== $item->owner->id) {
            return redirect()->back()->with('message', 'Only the owner of the item can delete it.');
        }

        StorageItem::query()->where('item_id', $item->id)->delete();

        $item->delete();

        return redirect()->back();
    }
}