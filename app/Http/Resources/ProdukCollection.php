<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProdukCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($produk) {
                return [
                    'id' => $produk->id,
                    'nama_produk' => $produk->nama_produk,
                    'deskripsi' => $produk->deskripsi,
                    'harga' => $produk->harga,
                    'kategori' => [
                        'id' => $produk->kategori->id,
                        'nama_kategori' => $produk->kategori->nama_kategori,
                    ],
                   'created_at' => $produk->created_at ? $produk->created_at->toDateTimeString() : null,
                    'updated_at' => $produk->updated_at ? $produk->updated_at->toDateTimeString() : null,
                ];
            }),
            'pagination' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'per_page' => $this->perPage(),
                'total' => $this->total(),
            ],
        ];
    }

    /**
     * Customize the response for a resource collection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->header('Content-Type', 'application/json');
    }
}
