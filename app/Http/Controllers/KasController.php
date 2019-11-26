<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kas;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kas = Kas::all();
        return view('kas', [
            'kas'   => $kas,
        ]);
    }
     public function tampilkas()
    {
        $kas = Kas::all();
        return view('kas', compact('kas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah-kas');
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
            'debet'     => 'numeric|min:1000',
            'kredit'        => 'numeric|min:1000',
            'keterangan'        => 'required',
        ]);
        Kas::create([
            'debet'     =>  $request->debet,
            'kredit'        =>  $request->kredit,
            'keterangan'        =>  $request->keterangan,
        ]);
        return redirect()->route("Kas.index");
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
        return view('edit-kas', [
            'kas' =>Kas::findOrFail($id)
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
            'debet'     => 'numeric|min:0',
            'kredit'        => 'numeric|min:0',
            'keterangan'        => 'required',
        ]);
        $kas = Kas::findOrFail($id);
        $kas->update([
            'debet'     =>  $request->debet,
            'kredit'        =>  $request->kredit,
            'keterangan'        =>  $request->keterangan,
        ]);
        return redirect()->route("Kas.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kas = Kas::findOrFail($id);
        $kas ->delete();
        
        return redirect()->route("Kas.index");
    }
}
