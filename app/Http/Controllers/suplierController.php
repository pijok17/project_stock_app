<?php

namespace App\Http\Controllers;

use App\Models\suplier;
use Illuminate\Http\Request;

class suplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $data = suplier::where('name_suplier', 'lIKE', '%' . $search . '%')
        ->orWhere('telp', 'lIKE', '%' .$search . '%')
        ->paginate(10);

        return view('Suplier.suplier', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Suplier.addSuplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

        'name_suplier' => 'required',
        'email' => 'required',
        'alamat' => 'required',
        'telp' => 'required|numeric',
        'tgl_terdaftar' => 'required',
        'status' => 'required',

        ], [
        'name_suplier.requierd' => 'Data Wajib diisi',
        'email.requierd' => 'Data Wajib diisi',
        'alamat.requierd' => 'Data Wajib diisi',

        'telp.requierd' => 'Data Wajib diisi',
        'telp.numeric' => 'Data berupa angka',

        'tgl_terdaftar.requierd' => 'Data Wajib diisi',
        'status.requierd' => 'Data Wajib diisi',

        ]);

        $saveSuplier = new suplier();
        $saveSuplier->name_suplier = $request->nama_suplier;
        $saveSuplier->email = $request->email;
        $saveSuplier->alamat = $request->alamat;
        $saveSuplier->telp = $request->telp;
        $saveSuplier->tgl_terdaftar = $request->tgl_terdaftar;
        $saveSuplier->status = $request->status;
        $saveSuplier->save();

        return redirect('/suplier')->with(
            'message',
            'Data ' .  $request->name_suplier . ' berhasil ditambahkan'
        );
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
