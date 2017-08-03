<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->hak_akses == 'admin') {
        $q = $request->get('q');
        $anggota = User::where('hak_akses', 'siswa')
                         ->where('name', 'LIKE', '%'.$q.'%')
                         ->orderBy('name')
                         ->paginate(10);
        return view('anggota.index')->with(compact('anggota','q'));
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
        return view('anggota.create');
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
                'name' => 'required|max:30',
                'email' => 'required|max:225|unique:users',
                'username' => 'required|unique:users|max:30'
            ]);
        $password = 'rahasia';
        $data = $request->all();
        $data['password'] = bcrypt($password);
        $data['hak_akses'] = 'siswa';
        $anggota = User::create($data);
        Session::flash("flash_notification", [
            "level" => "info",
            "message" => "Berhasil menambahkan email ".$data['email']." dan password $password"
            ]);
        return redirect()->route('anggota.index');
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
        $anggota = User::find($id);
        return view('anggota.edit')->with(compact('anggota'));
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
        $this->validate($request, [
                'name' => 'required|max:30',
                'username' => 'required|max:20',
                'email' => 'required|max:255',
            ]);
        $anggota = User::find($id);
        $anggota->update($request->only('email','username', 'name'));
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$anggota->name berhasil diupdate"
        ]);
        return redirect()->route('anggota.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggota = User::find($id);
        $anggota->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"anggota->name</strong> berhasil diupdate"
        ]);
        return redirect()->route('members.index'); 
    }
}
