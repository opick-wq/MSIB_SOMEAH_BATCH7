<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Produk extends Model
{
    use HasUuids;

    protected $table = 'produk';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'nama_produk', 'harga', 'deskripsi', 'kategori_id'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
 /*
    use HasFactory, SoftDeletes;

    protected $table = 'produk';
    public $incrementing = false; 
    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'nama_produk',
        'harga',
        'deskripsi',
        'kategori_id',
    ];
    */