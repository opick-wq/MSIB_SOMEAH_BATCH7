<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Kategori;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('kategori')->insert([
        //     ['id' => Str::uuid(), 'nama_kategori' => 'elektronik', 'deskripsi' => 'produk elektronik', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'fashion', 'deskripsi' => 'pakaian dan aksesoris', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'Makanan', 'deskripsi' => 'produk makanan dan minuman', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'Perlengkapan rumah', 'deskripsi' => 'perabotan dan alat ruman', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'Olahraga', 'deskripsi' => 'peralatan olahraga', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'Kesehatan', 'deskripsi' => 'produk kesehatan dan kebugaran', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'Kecantikan', 'deskripsi' => 'produk kecantikan', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'Buku', 'deskripsi' => 'buku dan alat tulis', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'Mainan', 'deskripsi' => 'mainan anak-anak', 'created_at' => now(), 'updated_at' => now()],
        //     ['id' => Str::uuid(), 'nama_kategori' => 'Otomotif', 'deskripsi' => 'produk otomotif', 'created_at' => now(), 'updated_at' => now()],
        // ]);

        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'elektronik', 'deskripsi' => 'produk elektronik']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'fashion', 'deskripsi' => 'pakaian dan aksesoris']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'Makanan', 'deskripsi' => 'produk makanan dan minuman']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'Perlengkapan rumah', 'deskripsi' => 'perabotan dan alat rumah']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'Olahraga', 'deskripsi' => 'peralatan olahraga']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'Kesehatan', 'deskripsi' => 'produk kesehatan dan kebugaran']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'Kecantikan', 'deskripsi' => 'produk kecantikan']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'Buku', 'deskripsi' => 'buku dan alat tulis']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'Mainan', 'deskripsi' => 'mainan anak-anak']);
        Kategori::create(['id' => Str::uuid(), 'nama_kategori' => 'Otomotif', 'deskripsi' => 'produk otomotif']);

    }
}
