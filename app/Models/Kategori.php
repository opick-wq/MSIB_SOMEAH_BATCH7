<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Scopes\ActiveKategoriScope;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori';
    public $incrementing = false; // Menggunakan UUID, jadi bukan auto-increment
    protected $keyType = 'uuid';   // Menentukan tipe primary key sebagai UUID

    protected $fillable = [
        'id',
        'nama_kategori', 
        'deskripsi'
    ];

    /**
     * Menggunakan booted untuk:
     * - Menambahkan global scope ActiveKategoriScope
     * - Mengisi UUID secara otomatis untuk primary key 'id'
     */
    protected static function booted()
    {
        static::addGlobalScope(new ActiveKategoriScope);

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Relasi dengan model Produk.
     * Asumsikan ada foreign key kategori_id di tabel produk.
     */
    public function produk() {
        return $this->hasMany(Produk::class);
    }
}
