<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductController extends Controller
{
    public function insertDummyData() {
        DB::table('product')->insert([
            [
                'product_name' => 'Dummy Product 1',
                'price' => 50000,
                'description' => 'ini adalah produk dummy 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Dummy Product 2',
                'price' => 100000,
                'description' => 'ini adalah produk dummy 2',
                'created_at' => now(),
                'updated_at' => now(),
            ]

            // WHERE IN
            
        ]);

        return response()->json(['status' => 200, 'message' =>  'Data produk dummy berhasil ditambahkan'], 200);
    }

    public function getAllProducts() {
        $product = DB::table('product')->get();
        dd($product);
        return response()->json(['status' => 200, 'data' => $product]);
    }
    
    public function getProductsWithCondition() {
        $product = DB::table('product')->where('price', '>', 75000)->get();
        dd($product);
        return response()->json(['status' => 200, 'data' => $product]);
    }

    public function updateDummyData($id){
        DB::table('product')->where('id', $id)->update([
            'product_name' => 'Produk Dummy Terupdate',
                'price' => 200000,
                'description' => 'deskripsi baru',
                'updated_at' => now(),
        ]);
        return response()->json(['status' => 200, 'message' =>  'produk berhasil diupdate']);
    }

    public function deleteProduct($id) {
        DB::table('product')->where('id', $id)->delete();
        return response()->json(['status' => 200, 'message' =>  'produk berhasil dihapus']);
    }
    
    public function showQueryLog() {
        DB::enableQueryLog();
        $product = DB::table('product')->get();
        $queries = DB::getQueryLog();
        dd($queries);
        return response()->json($product);
        // dbver /dbfer
    }


    // public function productJoin() {
    //     $product = DB::table('product')
    //                     ->join('category','')
    // }
}
