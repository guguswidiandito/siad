<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JenisPembayaran;
use Session;
use Auth;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hak_akses == 'admin') {
        $jenis = JenisPembayaran::get();
        return view('jenis.index')->with(compact('jenis'));
                } else {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Tidak dapat mengakses"
                ]);
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hak_akses == 'admin') {
        return view('jenis.create');
               } else {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Tidak dapat mengakses"
                ]);
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'pembayaran' => 'required|unique:jenis_pembayarans',
                'nominal'=> 'required'
            ]);
        $jenis = JenisPembayaran::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$jenis->pembayaran berhasil disimpan"
        ]);
        return redirect()->route('jenis.index');
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
        if (Auth::user()->hak_akses == 'admin') {
        $jenis = JenisPembayaran::findOrFail($id);
        return view('jenis.edit')->with(compact('jenis'));
               } else {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Tidak dapat mengakses"
                ]);
            return redirect()->back();
        }
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
        $jenis = JenisPembayaran::find($id);
        $jenis->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$jenis->pembayaran berhasil diupdate"
        ]);
        return redirect()->route('jenis.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis = JenisPembayaran::find($id);
        $jenis->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$jenis->pembayaran berhasil dihapus"
        ]);
        return redirect()->route('jenis.index');   
    }
}
