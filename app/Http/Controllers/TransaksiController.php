<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Customer;

class TransaksiController extends Controller
{

    public function index()
    {
        $transaksi = Transaksi::with('customer')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['customer', 'detail_transaksi.produk'])->findOrFail($id);
        return response()->json(['transaksi' => $transaksi]);
    }

    public function create()
    {
        $products = Produk::all();
        $customers = Customer::all();
        return view('transaksi.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customer,id',
            'tanggal_transaksi' => 'required|date',
            'produk_id' => 'required|array|exists:produk,id',
            'jumlah_produk' => 'required|array',
            'harga_satuan' => 'required|array',
        ]);

        $transaksi = Transaksi::create([
            'customer_id' => $request->customer_id,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        $Total = 0;

        foreach ($request->produk_id as $key => $produkId) {
            $jumlahProduk = $request->jumlah_produk[$key];
            $hargaSatuan = $request->harga_satuan[$key];
            $totalHarga = $jumlahProduk * $hargaSatuan;

            $Total += $totalHarga;

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produkId,
                'jumlah_produk' => $jumlahProduk,
                'harga_satuan' => $hargaSatuan
            ]);
        }

        $transaksi->update(['total_harga' => $Total]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function getHargaProduk($id)
    {
        $produk = Produk::find($id);
        if ($produk) {
            return response()->json(['harga' => $produk->harga]);
        }
        return response()->json(['error' => 'Produk tidak ditemukan'], 404);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    // public function edit($id)
    // {
    //     $transaksi = Transaksi::with('detail_transaksi.produk')->findOrFail($id);
    //     $products = Produk::all();
    //     $customers = Customer::all();
    //     return view('transaksi.edit', compact('transaksi', 'products', 'customers'));
    // }

}

// public function getAll() {
//     $transaksi = DB::table('transaksi as t')
//     ->join('customer as c', 't.customer_id', '=', 'c.id')
//     ->join('detail_transaksi as d', 't.transaksi_id', '=', 'd.id')
//     ->join('produk as p', 'd.customer_id', '=', 'p.id')
//     ->select('t.id', 'c.nama_customer', 'p.nama_produk')
//     ->get();

//     return response()->json($transaksi);
// }


