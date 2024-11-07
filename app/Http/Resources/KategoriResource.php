<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_kategori' => $this->nama_kategori,
            'deskripsi' => $this->deskripsi,
            'produk' => ProdukResource::collection($this->whenLoaded('produk')),
        ];
    }
}
