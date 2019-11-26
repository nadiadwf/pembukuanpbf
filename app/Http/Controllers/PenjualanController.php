<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\stokbarang;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::all();
        return view('table-datapenjualan', [
            'penjualan' => $penjualan,
        ]);
    }

    public function tampildatapenjualan()
    {
        $barang = stokbarang::all();
        $penjualan = Penjualan::all();
        return view('table-datapenjualan', compact('penjualan','barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = stokbarang::all();
        return view('tambah-jual', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stokbarang = stokbarang::find($request->id_barang);
        $totalharga = $request->jumlah*$stokbarang->harga;
        $request->validate([
            'jumlah' => 'required',
            'status' => 'required',
            'totalharga' => 'required'
        ]);
        Penjualan::create([
            'created_at' => $request->tanggal,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'totalharga' => $totalharga

        ]);

        return redirect('/table-datapenjualan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('edit-penjualan', [
            'penjulan' => Penjualan::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stokbarang = stokbarang::find($request->id_barang);
        $totalharga = $request->jumlah*$stokbarang->harga;
        $request->validate([
            'jumlah' => 'required',
            'status' => 'required',
            'totalharga' => 'required'
        ]);
        Penjualan::update([
            'created_at' => $request->tanggal,
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'status' => $request->status,
            'totalharga' => $totalharga

        ]);

        return redirect('/table-datapenjualan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $penjualandelete = Penjualan::where('id_penjualan', $id)->first();
            $penjualandelete->delete();

            return redirect('penjualan');
    }
}
