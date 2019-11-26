<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $supplier = Supplier::all();
       return view('table-datasupplier', [
            'supplier' => $supplier,
       ] );
    }

    public function tampildatasupplier()
    {
        $suppliers = Supplier::all();
        return view('table-datasupplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah-sup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namasupp'      => 'required', 
            'alamat'        => 'required',
            'nohp'          => 'required|numeric',
        ]);
        Supplier::create([
            'namasupp'      => $request->namasupp,
            'alamat'        => $request->alamat,
            'nohp'          => $request->nohp,
        ]);
        return redirect('/table-datasupplier');
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
        return view('edit-sup',[
            'supplier' => Supplier::where('id_supplier',$id)->first()
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
        $request->validate([
            'namasupp'      => 'required', 
            'alamat'        => 'required',
            'nohp'          => 'required|numeric',
        ]);
        $supplier = Supplier::findorFail($id);
        $supplier->update([
            'namasupp'      => $request->namasupp,
            'alamat'        => $request->alamat,
            'nohp'          => $request->nohp
        ]);
        return redirect('/table-datasupplier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findorFail($id);
        $supplier ->delete();

        return redirect('/table-datasupplier');
    }
}
