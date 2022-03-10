<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StorageController extends Controller
{
    public function create(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', Rule::unique('storages', 'name')],
        ]);

        $storage = Storage::create($attributes);
    }

    public function update(Request $request, Storage $storage)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', Rule::unique('storages', 'name')],
        ]);

        $storage->update($attributes);
    }

    public function destroy(Storage $storage)
    {
        $storage->delete();
    }
}