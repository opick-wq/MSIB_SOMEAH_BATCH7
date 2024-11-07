<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Resources\KategoriCollection;
use App\Http\Resources\KategoriResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @OA\Info(title="API Produk", version="1.0")
 * @OA\SecurityScheme(
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="JWT",
 *   securityScheme="bearerAuth"
 * )
 */
class KategoriController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/kategori",
     *   summary="Ambil semua kategori",
     *   security={{"bearerAuth": {}}},
     *   @OA\Response(
     *     response=200,
     *     description="Berhasil mengambil data kategori"
     *   ),
     *   @OA\Response(
     *     response=401,
     *     description="Unauthorized"
     *   )
     * )
     */
    public function index()
    {
/*
        $data = [
            [
                'id' => 1,
                'nama_kategori' => 'Makanan',
                'deskripsi' => 'Kategori untuk makanan',
            ],
            [
                'id' => 2,
                'nama_kategori' => 'Minuman',
                'deskripsi' => 'Kategori untuk minuman',
            ],
            [
                'id' => 3,
                'nama_kategori' => 'Camilan',
                'deskripsi' => 'Kategori untuk camilan',
            ],
        ];
    
        return response()->json($data); */
        try {
            $kategori = Kategori::with('produk')->paginate(10);
            return successResponse(new KategoriCollection($kategori), 'Data kategori berhasil diambil');
        } catch (\Exception $e) {
            return errorResponse('Internal Server Error', 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/kategori/{id}",
     *     summary="Ambil kategori berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Kategori",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data kategori ditemukan"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kategori tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $kategori = Kategori::with('produk')->findOrFail($id);
            return successResponse(new KategoriResource($kategori), 'Data kategori berhasil ditemukan');
        } catch (ModelNotFoundException $e) {
            return notFoundResponse('Kategori tidak ditemukan');
        }
    }

    /**
     * @OA\Post(
     *     path="/api/kategori",
     *     summary="Buat kategori baru",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_kategori", type="string", example="Elektronik"),
     *             @OA\Property(property="deskripsi", type="string", example="Barang elektronik")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Kategori berhasil dibuat"
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
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $kategori = Kategori::create($validatedData);
            return successResponse(new KategoriResource($kategori), 'Kategori berhasil dibuat', 201);
        } catch (\Exception $e) {
            return errorResponse('Gagal membuat kategori', 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/kategori/{id}",
     *     summary="Perbarui kategori berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Kategori",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_kategori", type="string", example="Elektronik"),
     *             @OA\Property(property="deskripsi", type="string", example="Barang elektronik")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Kategori berhasil diperbarui"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kategori tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->update($validatedData);
            return successResponse(new KategoriResource($kategori), 'Kategori berhasil diperbarui');
        } catch (\Exception $e) {
            return errorResponse('Gagal memperbarui kategori', 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/kategori/{id}",
     *     summary="Hapus kategori berdasarkan ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID Kategori",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Kategori berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kategori tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
            return successResponse(null, 'Kategori berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            return notFoundResponse('Kategori tidak ditemukan');
        } catch (\Exception $e) {
            return errorResponse('Gagal menghapus kategori', 500);
        }
    }
}






/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Http\Resources\KategoriCollection;
use App\Http\Resources\KategoriResource;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        // Mengembalikan semua kategori dengan format yang sesuai untuk DataTables
        return KategoriResource::collection(Kategori::all());
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Membuat kategori baru
        $kategori = Kategori::create($validatedData);

        return new KategoriResource($kategori);
    }

    public function show($id)
    {
        // Mengambil kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);
        return new KategoriResource($kategori);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Mencari kategori dan memperbarui datanya
        $kategori = Kategori::findOrFail($id);
        $kategori->update($validatedData);

        return new KategoriResource($kategori);
    }

    public function destroy($id)
    {
        // Menghapus kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
    }
    
    /*
    public function index()

    {
        try {
            // Fetch paginated data (eager load 'produk' relationship)
            $kategori = Kategori::with('produk')->paginate(3);
    
            // Return the data as a paginated collection
            return successResponse(new KategoriCollection($kategori),'Data Berhasil diambil');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_kategori' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ]);

    try {
        $kategori = Kategori::create($validatedData);
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dibuat',
            'data' => new KategoriResource($kategori)
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal membuat kategori'
        ], 500);
    }
}

    public function destroy($id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return response()->json(['message' => 'Kategori berhasil dihapus sementara']);
    }

    public function trashed() {
        $kategori = Kategori::onlyTrashed()->get();
        return response()->json($kategori);
    }

    public function restore($id) {
        $kategori =  Kategori::withTrashed()->findOrFail($id);
        $kategori->restore();
        return response()->json(['message' => 'Kategori berhasil direstore',  'data' => $kategori]);
    }

    public function forceDelete() {
        $kategori = Kategori::onlyTrashed()->get();
        $kategori->forceDelete();
        return response()->json(['message' => 'Kategori berhasil dihapus permanen']);
    }

    public function indexWithGlobalScope() {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    public function indexWithoutGlobalScope() {
        $kategori = Kategori::withoutGlobalScope(\App\Scopes\ActiveKategoriScope::class)->get();
        return response()->json($kategori);
    }


}
*/
?>