<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    // Sultan
    // public function index()
    // {
    //     try {
    //         $kategori = DB::table('kategori')->get();
    //         return response()->json($kategori, 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Gagal mengambil data kategori', 'message' => $e->getMessage()], 500);
    //     }
    // }

    // // Khisan
    // public function store()
    // {
    //     try {
    //         DB::beginTransaction();
    //         DB::table('kategori')->insert([
    //             [
    //                 'nama_kategori' => 'Elektronik',
    //                 'deskripsi' => 'Produk elektronik seperti smartphone, laptop, dll.',
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ],
    //             [
    //                 'nama_kategori' => 'Pakaian',
    //                 'deskripsi' => 'Berbagai jenis pakaian untuk semua kalangan.',
    //                 'created_at' => now(),
    //                 'updated_at' => now(),
    //             ]
    //         ]);
    //         DB::commit();
    //         return response()->json(['message' => 'Kategori berhasil ditambahkan'], 201);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => 'Gagal menambahkan kategori', 'message' => $e->getMessage()], 500);
    //     }
    // }

    // // Ingrid
    // public function readByName($name)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $kategori = DB::table('kategori')->where('nama_kategori', $name)->first();

    //         if (!$kategori) {
    //             DB::rollBack();
    //             return response()->json(['error' => 'Kategori tidak ditemukan']);
    //         }

    //         DB::commit();
    //         return response()->json($kategori);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => 'Gagal mengambil data kategori', 'message' => $e->getMessage()], 500);
    //     }
    // }

    // // Franky
    // public function update($id, Request $req)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $updated = DB::table('kategori')->where('id', $id)->update([
    //             'nama_kategori' => $req->query('category_name'),
    //             'deskripsi' => $req->query('description'),
    //             'updated_at' => now(),
    //         ]);

    //         if (!$updated) {
    //             DB::rollBack();
    //             return response()->json(['error' => 'Kategori tidak ditemukan atau tidak diperbarui']);
    //         }

    //         DB::commit();
    //         return response()->json(['message' => 'Kategori berhasil diperbarui']);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //     }
    // }

    // // Amanda
    // public function delete($id)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $deleted = DB::table('kategori')->where('id', $id)->delete();

    //         if (!$deleted) {
    //             DB::rollBack();
    //             return response()->json(['error' => 'Kategori tidak ditemukan']);
    //         }
    
    //         DB::commit();
    //         return response()->json(['message' => 'Kategori berhasil dihapus']);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['error' => 'Gagal menghapus kategori', 'message' => $e->getMessage()], 500);
    //     }
    // }

    // public function destroy($id) {
    //     $kategori = Kategori::findOrFail();
    // }

}
