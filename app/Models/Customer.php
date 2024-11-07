<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;

    // protected

    protected $table = 'customer';

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable =[
        'id',
        'nama_customer',
        'email',
        'nomor_telepon',
    ];

    public function transaksi() {
        return $this->hasMany(Transaksi::class);
    } 
}
