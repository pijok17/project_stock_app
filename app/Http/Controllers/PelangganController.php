<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = pelanggan::where('nama_pelanggan', 'LIKE', '%' . $search . '%')
        ->orWhere('telp', 'LIKE', '%' . $search . '%')
        ->paginate();

        return view('Pelanggan.pelanggan', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pelanggan.add-pelanggan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ], [
            'nama_pelanggan.required' => 'Data Wajib diisi',
            'telp.required' => 'Data Wajib diisi',
            'jenis_kelamin.required' => 'Data Wajib diisi',
            'alamat.required' => 'Data Wajib diisi',
            'kota.required' => 'Data Wajib diisi',
            'provinsi.required' => 'Data Wajib diisi',
        ]);

        $savePelanggan = new pelanggan();
        $savePelanggan->nama_pelanggan  = $request->nama_pelanggan;
        $savePelanggan->telp         = $request->telp;
        $savePelanggan->jenis_kelamin        = $request->jenis_kelamin;
        $savePelanggan->alamat          = $request->alamat;
        $savePelanggan->kota = $request->kota;
        $savePelanggan->provinsi        = $request->provinsi;
        $savePelanggan->save();

        return redirect('/pelanggan')->with(
            'message',
            'data ' . $request->nama_pelanggan . ' Berhasil ditambahkan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = pelanggan::find($id);
        return view('Pelanggan.editPelanggan', compact(
            'data'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ], [
            'nama_pelanggan.required' => 'Data Wajib diisi',
            'telp.required' => 'Data Wajib diisi',
            'jenis_kelamin.required' => 'Data Wajib diisi',
            'alamat.required' => 'Data Wajib diisi',
            'kota.required' => 'Data Wajib diisi',
            'provinsi.required' => 'Data Wajib diisi',
        ]);

        $savePelanggan = pelanggan::find($id);
        $savePelanggan->nama_pelanggan  = $request->nama_pelanggan;
        $savePelanggan->telp         = $request->telp;
        $savePelanggan->jenis_kelamin        = $request->jenis_kelamin;
        $savePelanggan->alamat          = $request->alamat;
        $savePelanggan->kota = $request->kota;
        $savePelanggan->provinsi        = $request->provinsi;
        $savePelanggan->save();

        return redirect('/pelanggan')->with(
            'message',
            'Data ' . $request->nama_pelanggan . ' Berhasil diperbaharui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getData = pelanggan::find($id);
        $getData->delete();

        return redirect('/pelanggan')->with(
            'message',
            'Data ' . $getData->nama_suplier . ' Berhasil dihapus!!'
        );
    }
}
