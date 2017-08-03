<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;
use DB;
use Session;
use Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hak_akses == 'admin') {
            $kelas = DB::table('kelas')->orderBy('nama_kelas')->get();
            return view('kelas.index', with(compact('kelas')));
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
            return view('kelas.create');
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
            'nama_kelas'=>'required|unique:kelas'
            ]);
        $kelas = Kelas::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$kelas->nama_kelas berhasil disimpan."
        ]);
        return redirect()->route('kelas.index');
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
            $kelas = Kelas::findOrFail($id);
            return view('kelas.edit')->with(compact('kelas'));
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
        $kelas = Kelas::find($id);
        $kelas->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$kelas->nama_kelas berhasil diupdate."
        ]);
        return redirect()->route('kelas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$kelas->nama_kelas berhasil dihapus."
        ]);
        return redirect()->route('kelas.index');
    }
}
