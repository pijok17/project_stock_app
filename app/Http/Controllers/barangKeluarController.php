<?php

namespace App\Http\Controllers;

use App\Models\barangkeluar;
use App\Models\pelanggan;
use App\Models\stok;
use Illuminate\Http\Request;

class barangKeluarController extends Controller
{
    function index()
    {
        return view('Barang.BarangKeluar.barangKeluar');
    }

    function create()
    {
        $data = barangkeluar::all();

        $lastId = barangkeluar::max('id');
        $lastId = $lastId ? $lastId : 0; //ternary operator

        if ($data->isEmpty()) {
            $nextId = $lastId + 1;
            $date = now()->format('d/m/Y');
            $kode_transaksi = 'TRK' . $nextId . '/' . $date;

            $pelanggan = pelanggan::all();

            return view('Barang.BarangKeluar.addBarangKeluar', compact(
                'data',
                'kode_transaksi',
                'pelanggan',
            ));

            return view('Barang.BarangKeluar.addBarangKeluar');
        }


    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_faktur' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'pelanggan_id' => 'required',
            'jenis_pembayaran' => 'required',
        ]);

        ([
            'tgl_faktur.required' => 'Data wajib diisi',
            'tgl_jatuh_tempo.required' => 'Data wajib diisi',
            'pelanggan_id.required' => 'Data wajib diisi',
            'jenis_pembayaran.required' => 'Data wajib diisi',
        ]);

        $kode_transaksi = $request->kode_transaksi;
        $tgl_faktur = $request->tgl_faktur;
        $tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $pelanggan_id = $request->pelanggan_id;

        $getNamaPelanggan = pelanggan::find($pelanggan_id);
        $namaPelanggan = $getNamaPelanggan->name_pelanggan;
        $jenis_pembayaran = $request->jenis_pembayaran;

        $getBarang = stok::all();

        return view('Transaksi.transaksi', compact(
            'kode_transaksi',
            'tgl_faktur',
            'tgl_jatuh_tempo',
            'pelanggan_id',
            'namaPelanggan',
            'jenis_pembayaran',
            'getBarang',
        ));

    }

    public function saveBarangKeluar(Request $request)
    {
        $request->validate([

            'kode_transaksi' => 'required',
            'tgl_faktur' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'pelanggan_id' => 'required',
            'jenis_pembayaran' => 'required',
            'barang_id' => 'required',
            'jumlah_beli' => 'required',
            'harga_jual' => 'required'
        ]);

        $save = new BarangKeluar();

        $save->kode_transaksi = $request->kode_transaksi;
        $save->tgl_faktur = $request->tgl_faktur;
        $save->tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $save->pelanggan_id = $request->pelanggan_id;
        $save->jenis_pembayaran = $request->jenis_pembayaran;
        $save->barang_id = $request->barang_id;
        $save->jumlah_beli = $request->jumlah_beli;
        $save->harga_jual = $request->harga_jual;


        


    



}
}







