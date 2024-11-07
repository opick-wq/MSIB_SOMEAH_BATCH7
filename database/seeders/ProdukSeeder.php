<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $kategoriList = [
            'Elektronik', 
            'Fashion', 
            'Makanan', 
            'Perlengkapan Rumah', 
            'Olahraga', 
            'Kesehatan', 
            'Kecantikan'
        ];
        
        $kId = [];
        
        foreach ($kategoriList as $kategori) {
            $kId[$kategori] = DB::table('kategori')->where('nama_kategori', $kategori)->value('id');
        }

        DB::table('produk')->insert([
            ['id' => Str::uuid(), 'nama_produk' => 'Laptop', 'harga' => 10000000, 'deskripsi' => 'Laptop untuk kebutuhan kerja', 'kategori_id' => $kId['Elektronik'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Smartphone', 'harga' => 5000000, 'deskripsi' => 'Smartphone Android terbaru', 'kategori_id' => $kId['Elektronik'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Kaos', 'harga' => 100000, 'deskripsi' => 'Kaos polos berbagai warna', 'kategori_id' => $kId['Fashion'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Celana Jeans', 'harga' => 200000, 'deskripsi' => 'Celana jeans pria', 'kategori_id' => $kId['Fashion'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Mie Instan', 'harga' => 5000, 'deskripsi' => 'Makanan instan cepat saji', 'kategori_id' => $kId['Makanan'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Air Mineral', 'harga' => 3000, 'deskripsi' => 'Air minum dalam kemasan', 'kategori_id' => $kId['Makanan'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Sofa', 'harga' => 1500000, 'deskripsi' => 'Sofa minimalis modern', 'kategori_id' => $kId['Perlengkapan Rumah'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Sepatu olahraga', 'harga' => 300000, 'deskripsi' => 'Sepatu untuk aktivitas olahraga', 'kategori_id' => $kId['Olahraga'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Multivitamin', 'harga' => 100000, 'deskripsi' => 'Suplemen multivitamin harian', 'kategori_id' => $kId['Kesehatan'], 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'nama_produk' => 'Shampoo', 'harga' => 25000, 'deskripsi' => 'Shampoo untuk perawatan rambut', 'kategori_id' => $kId['Kecantikan'], 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
