<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,
            'deskripsi' => $this->deskripsi,
            'kategori' => [
                'id' => $this->kategori->id,
                'nama' => $this->kategori->nama_kategori
            ],
            'actions' => view('produk.actions', ['id' => $this->id])->render(),
        ];
    }
}

