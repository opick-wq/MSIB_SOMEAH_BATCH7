<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $customer = DB::table('customer')->pluck('id')->toArray();

        Transaksi::create(['id' => Str::uuid(), 'customer_id' => $customer[0], 'tanggal_transaksi' => now(), 'total_harga' => 0]);
        Transaksi::create(['id' => Str::uuid(), 'customer_id' => $customer[2], 'tanggal_transaksi' => now(), 'total_harga' => 0]);
        Transaksi::create(['id' => Str::uuid(), 'customer_id' => $customer[0], 'tanggal_transaksi' => now(), 'total_harga' => 0]);
    }
}
