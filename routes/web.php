<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StorageItemController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/storages/add', [StorageController::class, 'add'])->name('storages.add');
    Route::post('/storages/add', [StorageController::class, 'store'])->name('storages.store');
    Route::get('/storages/edit', [StorageController::class, 'edit'])->name('storages.edit');
    Route::patch('/storages/edit', [StorageController::class, 'update'])->name('storages.update');
    Route::get('/storages/remove', [StorageController::class, 'remove'])->name('storages.remove');
    Route::delete('/storages/remove', [StorageController::class, 'destroy'])->name('storages.destroy');

    Route::get('/items/add', [ItemController::class, 'add'])->name('items.add');
    Route::post('/items/add', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::patch('/items/edit', [ItemController::class, 'update'])->name('items.update');
    Route::get('/items/remove', [ItemController::class, 'remove'])->name('items.remove');
    Route::delete('/items/remove', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('/storage/items/add', [StorageItemController::class, 'add'])->name('storage.items.add');
    Route::post('/storage/items/add', [StorageItemController::class, 'store'])->name('storage.items.store');
    Route::get('/storage/items/edit', [StorageItemController::class, 'edit'])->name('storage.items.edit');
    Route::patch('/storage/items/edit', [StorageItemController::class, 'update'])->name('storage.items.update');
    Route::get('/storage/items/remove', [StorageItemController::class, 'remove'])->name('storage.items.remove');
    Route::delete('/storage/items/remove', [StorageItemController::class, 'destroy'])->name('storage.items.destroy');

    Route::get('/order/create', [OrderController::class, 'index'])->name('order.create');
    Route::post('/order/confirm', [OrderController::class, 'store'])->name('order.place');
});
