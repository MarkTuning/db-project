<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use App\Models\StorageItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;

class StorageController extends Controller
{
    public function add(): View|Factory
    {
        return view('storages.add');
    }

    public function edit(): View|Factory
    {
        return view('storages.edit', [
            'storages' => Storage::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function remove(): View|Factory
    {
        return view('storages.remove', [
            'storages' => Storage::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', Rule::unique('storages')->where(function($query) {
                return $query->whereIn('name', function($query) {
                    return $query->select('name')
                        ->from('storages')
                        ->where('user_id', auth()->user()->id);
                });
            })],
        ]);

        $attributes['user_id'] = auth()->user()->id;

        Storage::create($attributes);

        return redirect()->back();
    }

    public function update(Request $request): RedirectResponse
    {
        $id = $request->validate([
            'storage_id' => ['required', Rule::exists('storages', 'id')],
        ]);

        $storage = Storage::where('id', $id['storage_id'])->first();

        if (auth()->user()->id !== $storage->owner->id) {
            return redirect()->back()->withErrors('storage_id', 'Only the owner of the storage can update it.');
        }

        $attributes = $request->validate([
            'name' => ['nullable', 'string', Rule::unique('storages')->where(function($query) {
                return $query->whereIn('name', function($query) {
                    return $query->select('name')
                        ->from('storages')
                        ->where('user_id', auth()->user()->id);
                });
            })],
        ]);

        if ($attributes['name'] != null) {
            $storage->name = $attributes['name'];
        }

        $storage->update();

        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        $id = $request->validate([
            'storage_id' => ['required', Rule::exists('storages', 'id')],
        ]);

        $storage = Storage::where('id', $id['storage_id'])->first();

        if (auth()->user()->id !== $storage->owner->id) {
            return redirect()->back()->with('message', 'Only the owner of the storage can delete it.');
        }

        StorageItem::query()->where('storage_id', $storage->id)->delete();

        $storage->delete();

        return redirect()->back();
    }
}
