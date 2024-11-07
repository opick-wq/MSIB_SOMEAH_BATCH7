<?php
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\JwtAuthMiddleware;

// Define resource route for KategoriController
Route::apiResource('produk', ProdukController::class)->names([
    'index' => 'api.produk.index',    // GET /api/produk
    'store' => 'api.produk.store',    // POST /api/produk
    'show' => 'api.produk.show',      // GET /api/produk/{id}
    'update' => 'api.produk.update',  // PUT /api/produk/{id}
    'destroy' => 'api.produk.destroy' // DELETE /api/produk/{id}
]);

// Route untuk Kategori
/*Route::apiResource('kategori', KategoriController::class)->names([
    'index' => 'api.kategori.index',  
    'store' => 'api.kategori.store',   
    'show' => 'api.kategori.show',   
    'update' => 'api.kategori.update',   
    'destroy' => 'api.kategori.destroy',   
]);*/

Route::get('/customers', [CustomerController::class, 'index']);


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware([JwtAuthMiddleware::class])->group(function () {
    Route::get('/kategori', [KategoriController::class,'index']);
});

?>