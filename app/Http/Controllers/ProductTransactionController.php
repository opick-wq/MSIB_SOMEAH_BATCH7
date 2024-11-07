<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductTransactionController extends Controller
{
    public function index(){
        try {
            DB::beginTransaction();
            $product = DB::table('product')->get();
            DB::commit();

            return response()->json($product);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'gagal menampilkan produk' . $e->getMessage()], 500);
        }
    }

    public function store() {
        try {
            DB::beginTransaction();
            DB::table('product')->insert([
                'product_name' =>  'Product baru transaksi',
                'price' =>  100000,
                'description' =>   'deskripsi produk baru dengan transaksi',
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::commit();
            return  response()->json(['message' => 'Product created successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return  response()->json(['message' => 'Failed to create product' . $e->getMessage()], 500);
        }
    }

    public function update($id) {
        try {
            DB::beginTransaction();
            DB::table('product')->where('id', $id)->update([
                'product_name' =>  'Produk terupdate transaksi',
                'price' =>  300000,
                'description' =>   'deskripsi produk yang telah diupdate',
                'updated_at' => now()
            ]);
            DB::commit();
            return  response()->json(['message' => 'Product berhasil diupdate'], 201);
        } catch (\Exception $e) {
            return  response()->json(['message' => 'gagal mengupdate produk' . $e->getMessage()], 500);
        }
    }

    public function delete($id) {
        try {
            DB::beginTransaction();
            DB::table('product')->where('id', $id)->delete();
            DB::commit();

            return  response()->json(['message' => 'Product berhasil dihapus'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'gagal menghapus produk' . $e->getMessage()], 500);
        }
    }
}
