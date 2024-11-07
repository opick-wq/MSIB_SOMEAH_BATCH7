<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $transaksi = DB::table('transaksi')->pluck('id')->toArray();
        $produk = DB::table('produk')->pluck('id')->toArray();

        DetailTransaksi::create(['id' => Str::uuid(), 'transaksi_id' => $transaksi[0], 'produk_id' => $produk[9], 'jumlah_produk' => 2, 'harga_satuan' => 25000]);
        DetailTransaksi::create(['id' => Str::uuid(), 'transaksi_id' => $transaksi[1], 'produk_id' => $produk[4], 'jumlah_produk' => 8, 'harga_satuan' => 5000]);
        DetailTransaksi::create(['id' => Str::uuid(), 'transaksi_id' => $transaksi[1], 'produk_id' => $produk[5], 'jumlah_produk' => 5, 'harga_satuan' => 3000]);
        DetailTransaksi::create(['id' => Str::uuid(), 'transaksi_id' => $transaksi[2], 'produk_id' => $produk[4], 'jumlah_produk' => 12, 'harga_satuan' => 5000]);
        DetailTransaksi::create(['id' => Str::uuid(), 'transaksi_id' => $transaksi[2], 'produk_id' => $produk[9], 'jumlah_produk' => 1, 'harga_satuan' => 25000]);
        DetailTransaksi::create(['id' => Str::uuid(), 'transaksi_id' => $transaksi[2], 'produk_id' => $produk[5], 'jumlah_produk' => 5, 'harga_satuan' => 3000]);
    
        foreach ($transaksi as $id) {
            $transaksiModel = Transaksi::find($id);
            $totalHarga = $transaksiModel->hitungTotalHarga();
            $transaksiModel->update(['total_harga' => $totalHarga]);
        }
    }
}
