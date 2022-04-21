<?php

namespace App\Http\Controllers;

use App\gudang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gudang = gudang::orderBy('id_gudang', 'DESC')->get();
        return view('gudang.gudang.index' ,['gudang'=>$gudang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gudang.gudang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $gudang = new gudang;
        $gudang->kode_gudang   = $request->kode_gudang;
        $gudang->nama_gudang = $request->nama_gudang;
        $gudang->kapasitas_GT = $request->KapasitasGudangTotal;
        $gudang->kapasitas_F = $request->KapasitasBarangF;
        $gudang->kapasitas_S = $request->KapasitasBarangS;
        $gudang->kapasitas_N     = $request->KapasitasBarangN;

  
        $gudang->save();
        // dd('kesini');
  
        return redirect('gudang')->with('pesan', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function show(gudang $gudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function edit(gudang $gudang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gudang $gudang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function destroy(gudang $gudang)
    {
        //
    }
}
