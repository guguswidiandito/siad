<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;
use App\Kelas;
use App\User;
use Session;
use PDF;
use Auth;

class SiswaController extends Controller
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
            $kelas = $request->get('kelas');
            $siswa = Siswa::where('nis', 'LIKE', '%'.$q.'%')
                        ->where('kelas_id', 'LIKE', '%'.$kelas.'%')
                        ->orderBy('nis')
                        ->paginate(10);
            return view('siswa.index')->with(compact('siswa', 'q', 'kelas'));
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
    public function create(Request $request)
    {
        if (Auth::user()->hak_akses == 'admin') {
            $kelas = Kelas::pluck('nama_kelas', 'id');
            $user = User::where('hak_akses', 'siswa')->pluck('name', 'id');
            return view('siswa.create')->with(compact('user', 'kelas'));
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
            'nis' => 'required|integer|unique:siswas',
            'user_id' => 'required|unique:siswas',
            'kelas_id' => 'required',
            'angkatan' => 'required'
        ]);
        $siswa = Siswa::create($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$siswa->nis berhasil disimpan."
        ]);
        return redirect()->route('siswa.index');
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
            $siswa = Siswa::find($id);
            $kelas = Kelas::pluck('nama_kelas', 'id');
            $user = User::where('hak_akses', 'siswa')->pluck('name', 'id');
            return view('siswa.edit')->with(compact('user', 'kelas', 'siswa'));
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
        $siswa = Siswa::find($id);
        $siswa->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$siswa->nis berhasil diupdate."
        ]);
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        Session::flash("flash_notification", [
            "level" => "success",
            "message" => "$siswa->nis berhasil dihapus."
        ]);
        return redirect()->route('siswa.index');
    }

    public function export()
    {
        if (Auth::user()->hak_akses == 'admin' || Auth::user()->hak_akses == 'kepsek') {
            return view('siswa.export');
        } else {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Tidak dapat mengakses"
                ]);
            return redirect()->back();
        }
    }

    public function exportPost(Request $request)
    {
        // validasi
        $this->validate($request, [
            'kelas_id'=>'required'
         ], [
            'kelas_id.required'=>'Anda masih belum memilih kelas yang akan diproses.'
    ]);
        $kelas = $request->get('kelas_id');
        $siswa = Siswa::where('kelas_id', 'LIKE', '%'.$kelas.'%')->get();
        $pdf = PDF::loadview('siswa.pdf', compact('siswa'));
        return $pdf->stream('Laporan Identitas.pdf');
    }

    public function identitas()
    {
        if (Auth::user()->hak_akses == 'siswa') {
            $siswa = Siswa::where('user_id', Auth::user()->id)->get();
            return view('siswa.detail', compact('siswa'));
        } else {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Tidak dapat mengakses"
                ]);
            return redirect()->back();
        }
    }
}
