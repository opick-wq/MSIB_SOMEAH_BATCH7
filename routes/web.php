<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

Route::prefix('transaksi')->name('transaksi.')->group(function () {
    Route::get('/create', [TransaksiController::class, 'create'])->name('create');
    Route::post('/store', [TransaksiController::class, 'store'])->name('store');
    Route::get('/{id}', [TransaksiController::class, 'show'])->name('show');
    Route::get('/', [TransaksiController::class, 'index'])->name('index');
    Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('destroy');
});


Route::get('/produk', function () {
    return view('produk.index');
})->name('produk.index');

Route::get('/user', function () {
    return view('user.index');
})->name('user.index');

Route::get('/kategori', function () {
    return view('kategori.index');
})->name('kategori.index');

/*
Route::get('/produk/harga/{id}', [TransaksiController::class, 'getHargaProduk']);





Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('edit');
Route::put('/{id}', [TransaksiController::class, 'update'])->name('update');
Route::get('/', function () {
    return view('produk');
});    
Route::get('/produk', [ProdukController::class, 'index']);
Route::post('/produk', [ProdukController::class, 'store']);
Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);
Route::get('/kategori', [ProdukController::class, 'getKategoris']);






// day 1
Route::get('/products/insert', [ProductController::class,  'insertDummyData']);
Route::get('/products', [ProductController::class,  'getAllProducts']);
Route::get('/products/condition', [ProductController::class,  'getProductsWithCOndition']);
Route::get('/products/update/{id}', [ProductController::class,  'updateDummyData']);
Route::delete('/products/delete/{id}', [ProductController::class,  'deleteProduct']);
Route::get('/products/querylog', [ProductController::class,  'showQueryLog']);

// day 1 & 2 (tugas)
Route::get('/customers/insert', [CustomerController::class,  'insertCustomer']);
Route::get('/customers', [CustomerController::class,  'getAllcustomers']);
Route::get('/customers/condition', [CustomerController::class,  'getcustomersWithCondition']);
Route::get('/customers/update/{id}', [CustomerController::class,  'updateCustomer']);
Route::delete('/customers/delete/{id}', [CustomerController::class,  'deleteCustomer']);
Route::get('/customers/querylog', [CustomerController::class,  'showQueryLog']);

// day 3
Route::get('/product-transaction', [ProductTransactionController::class, 'index']);
Route::get('/product-transaction/store', [ProductTransactionController::class, 'store']);
Route::get('/product-transaction/update/{id}', [ProductTransactionController::class, 'update']);
Route::get('/product-transaction/delete/{id}', [ProductTransactionController::class, 'destroy']);

// day 3 (tugas)
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/store', [CategoryController::class, 'store']);
Route::get('/categories/search/{name}', [CategoryController::class, 'readByName']);
Route::get('/categories/update/{id}', [CategoryController::class, 'update']);
Route::get('/categories/delete/{id}', [CategoryController::class, 'delete']);

Route::get('/join', [ProdukController::class, 'produkJoin']);

use App\Http\Controllers\KategoriController;

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'indexWithGlobalScope']); // Menampilkan kategori dengan Global Scope
    Route::get('/all', [KategoriController::class, 'indexWithoutGlobalScope']); // Menampilkan semua kategori tanpa Global Scope
    Route::get('del/{id}', [KategoriController::class, 'destroy']); // Menghapus kategori (soft delete)
    Route::get('/trashed', [KategoriController::class, 'trashed']); // Menampilkan kategori yang dihapus (soft deleted)
    Route::post('/restore/{id}', [KategoriController::class, 'restore']); // Restore kategori yang sudah dihapus
    Route::delete('/force-delete', [KategoriController::class, 'forceDelete']); // Hapus kategori permanen
});

*/