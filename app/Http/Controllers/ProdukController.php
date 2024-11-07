<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Resources\ProdukCollection;
use App\Http\Resources\ProdukResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProdukController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/produk",
     *     summary="Ambil semua produk",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data produk"
     *     )
     * )
     */
    public function index()
    {
        try {
            $produk = Produk::with('kategori')->paginate(11);
            return successResponse(new ProdukCollection($produk), 'Data produk berhasil diambil');
        } catch (\Exception $e) {
            return errorResponse('Internal Server Error', 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/produk/{id}",
     *     summary="Ambil produk berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Produk",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data produk ditemukan"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produk tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $produk = Produk::with('kategori')->findOrFail($id);
            return successResponse(new ProdukResource($produk), 'Data produk berhasil ditemukan');
        } catch (ModelNotFoundException $e) {
            return notFoundResponse('Produk tidak ditemukan');
        }
    }

    /**
     * @OA\Post(
     *     path="/api/produk",
     *     summary="Buat produk baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_produk", type="string", example="Laptop"),
     *             @OA\Property(property="deskripsi", type="string", example="Laptop gaming"),
     *             @OA\Property(property="harga", type="integer", example=15000000),
     *             @OA\Property(property="kategori_id", type="string", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produk berhasil dibuat"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Data tidak valid"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        try {
            $produk = Produk::create($validatedData);
            return successResponse(new ProdukResource($produk), 'Produk berhasil dibuat', 201);
        } catch (\Exception $e) {
            return errorResponse('Gagal membuat produk', 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/produk/{id}",
     *     summary="Perbarui produk berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Produk",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_produk", type="string", example="Laptop"),
     *             @OA\Property(property="deskripsi", type="string", example="Laptop gaming"),
     *             @OA\Property(property="harga", type="integer", example=15000000),
     *             @OA\Property(property="kategori_id", type="string", example="1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produk berhasil diperbarui"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produk tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        try {
            $produk = Produk::findOrFail($id);
            $produk->update($validatedData);
            return successResponse(new ProdukResource($produk), 'Produk berhasil diperbarui');
        } catch (ModelNotFoundException $e) {
            return notFoundResponse('Produk tidak ditemukan');
        } catch (\Exception $e) {
            return errorResponse('Gagal memperbarui produk', 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/produk/{id}",
     *     summary="Hapus produk berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Produk",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produk berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produk tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            $produk->delete();
            return successResponse(null, 'Produk berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            return notFoundResponse('Produk tidak ditemukan');
        } catch (\Exception $e) {
            return errorResponse('Gagal menghapus produk', 500);
        }
    }

/*namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Produk;
use App\Models\Kategori;
use App\Http\Resources\ProdukResource;


class ProdukController extends Controller
{

    public function index(Request $request)
    {
        $query = Produk::with('kategori');
    
        // Tambahkan pencarian
        if ($request->has('search') && $request->search['value'] != '') {
            $searchValue = $request->search['value'];
            $query->where(function($q) use ($searchValue) {
                $q->where('nama_produk', 'LIKE', "%{$searchValue}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$searchValue}%");
                  // Tambah pencarian di kolom lain sesuai kebutuhan
            });
        }
    
        // Filter berdasarkan kategori_id
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $query->where('kategori_id', $request->kategori_id);
        }
    
        return ProdukResource::collection($query->paginate(10));
    }

    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        return new ProdukResource($produk);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        $validatedData['id'] = (string) Str::uuid();
        $produk = Produk::create($validatedData);

        return new ProdukResource($produk);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori,id'
        ]);

        $produk->update($validatedData);

        return new ProdukResource($produk);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return response()->json(['message' => 'Produk berhasil dihapus'], 200);
    }

*/















  /*  
    public function getKategoris()
{
    $kategoris = Kategori::whereNull('deleted_at')->get(); // Mengambil kategori yang tidak dihapus
    return response()->json($kategoris);
}

public function index()
{
    $produk = Produk::whereNull('deleted_at')->get(); // Mengambil produk yang tidak dihapus
    return response()->json($produk);
}

public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|integer',
        'kategori_id' => 'required|uuid',
    ]);

    $produk = Produk::create([
        'id' => Str::uuid(),
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
        'kategori_id' => $request->kategori_id,
    ]);

    return response()->json(['success' => true, 'produk' => $produk]);
}

public function destroy($id)
{
    $produk = Produk::findOrFail($id);
    $produk->delete();

    return response()->json(['success' => true]);
}












    // public function insertDummyData() {
    //     DB::table('product')->insert([
    //         [
    //             'product_name' => 'Dummy Product 1',
    //             'price' => 50000,
    //             'description' => 'ini adalah produk dummy 1',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'product_name' => 'Dummy Product 2',
    //             'price' => 100000,
    //             'description' => 'ini adalah produk dummy 2',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]

    //         // WHERE IN
            
    //     ]);

    //     return response()->json(['status' => 200, 'message' =>  'Data produk dummy berhasil ditambahkan'], 200);
    // }

    // public function getAllProducts() {
    //     $product = DB::table('product')->get();
    //     dd($product);
    //     return response()->json(['status' => 200, 'data' => $product]);
    // }
    
    // public function getProductsWithCondition() {
    //     $product = DB::table('product')->where('price', '>', 75000)->get();
    //     dd($product);
    //     return response()->json(['status' => 200, 'data' => $product]);
    // }

    // public function updateDummyData($id){
    //     DB::table('product')->where('id', $id)->update([
    //         'product_name' => 'Produk Dummy Terupdate',
    //             'price' => 200000,
    //             'description' => 'deskripsi baru',
    //             'updated_at' => now(),
    //     ]);
    //     return response()->json(['status' => 200, 'message' =>  'produk berhasil diupdate']);
    // }

    // public function deleteProduct($id) {
    //     DB::table('product')->where('id', $id)->delete();
    //     return response()->json(['status' => 200, 'message' =>  'produk berhasil dihapus']);
    // }
    
    // public function showQueryLog() {
    //     DB::enableQueryLog();
    //     $product = DB::table('product')->get();
    //     $queries = DB::getQueryLog();
    //     dd($queries);
    //     return response()->json($product);
    //     // dbver /dbfer
    // }

    // public function produkJoin() {
    //     $produk = DB::table('produk as p')
    //     ->join('kategori as k', 'p.kategori_id', '=', 'k.id')
    //     ->select('p.nama_produk', 'p.harga', 'k.nama_kategori')
    //     ->get();

    //     return response()->json($produk);
    // }


    */
}
