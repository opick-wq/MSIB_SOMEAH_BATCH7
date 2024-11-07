<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes, HasUuids;
    protected $table = 'transaksi';

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'id', 
        'customer_id', 
        'tanggal_transaksi', 
        'total_harga'
    ];



// RELASI
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }








    
    public function getHargaProduk($id) {
        $produk = Produk::find($id);
        if ($produk) {
            return response()->json(['harga' => $produk->harga]);
        } else {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
    }
}

    public function hitungTotalHarga()
    {
        $total_harga = 0;
        foreach ($this->detail_transaksi as $detail) {
            $total_harga += $detail->jumlah_produk * $detail->harga_satuan;
        }

        return $total_harga;
    }

    public function getTotalHargaAttribute($value)
    {
        return $this->hitungTotalHarga();
    }
}
