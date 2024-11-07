<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DetailTransaksi extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'detail_transaksi';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'transaksi_id', 
        'produk_id', 
        'jumlah_produk', 
        'harga_satuan'
    ];        

    public function produk() {
        return $this->belongsTo(Produk::class);
    }

    public function transaksi() {
        return $this->belongsTo(Transaksi::class);
    }
}
