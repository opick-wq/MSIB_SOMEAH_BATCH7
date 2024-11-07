<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($customer) {
            return [
                'id' => $customer->id,
                'nama_customer' => $customer->nama_customer,
                'email' => $customer->email,
                'nomor_telepon' => $customer->nomor_telepon,
                'created_at' => $customer->created_at ? $customer->created_at->format('Y-m-d H:i:s') : null, // Pengecekan null
            ];
        });
    }
    

    public function with($request)
    {
        return [
            'meta' => [
                'total_customers' => $this->collection->count(),
            ],
        ];
    }
}
