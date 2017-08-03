<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\JenisPembayaran;
use App\Siswa;
use Auth;
use Session;
use PDF;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->hak_akses == "admin") {
            $q = $request->get('q');
            $pembayaran = Pembayaran::where('no_pembayaran', 'LIKE', '%'.$q.'%')
                                      ->orderBy('no_pembayaran')->paginate(10);
            return view('pembayaran.index')->with(compact('pembayaran', 'q'));
        } else {
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
        if (Auth::check() && Auth::user()->hak_akses == "admin") {
            $jenis = JenisPembayaran::pluck('pembayaran', 'id');
            $siswa = Siswa::pluck('nis', 'id');
            return view('pembayaran.create')->with(compact('jenis', 'siswa'));
        } else {
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
            'no_pembayaran' => 'required|unique:pembayarans',
            'siswa_id' => 'required',
            'jenis_pembayaran_id' => 'required'
        ]);
        $namas = Siswa::whereIn('id', array($request->get('siswa_id')))->get();
        foreach ($namas as $key => $value) {
            $nama = $value->user->id;
        }
        $data = $request->all();
        $data['operator'] = Auth::user()->name;
        $data['user_id'] = $nama;
        $pembayaran = Pembayaran::create($data);
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$pembayaran->no_pembayaran berhasil disimpan"
        ]);
        return redirect()->route('pembayaran.index');
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
        if (Auth::check() && Auth::user()->hak_akses == "admin") {
            $jenis = JenisPembayaran::pluck('pembayaran', 'id');
        $siswa = Siswa::pluck('nis', 'id');
        $pembayaran = Pembayaran::find($id);
        return view('pembayaran.edit')->with(compact('pembayaran', 'jenis', 'siswa'));
        } else {
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
        $namas = Siswa::whereIn('id', array($request->get('siswa_id')))->get();
        foreach ($namas as $key => $value) {
            $nama = $value->user->id;
        }
        $pembayaran = Pembayaran::find($id);
        $pembayaran->user_id = $nama;
        $pembayaran->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$pembayaran->no_pembayaran berhasil diubah."
        ]);
        return redirect()->route('pembayaran.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$pembayaran->no_pembayaran berhasil diubah."
        ]);
        return redirect()->route('pembayaran.index');
    }

    public function export()
    {
        if (Auth::user()->hak_akses == 'admin' || Auth::user()->hak_akses == 'kepsek') {
            return view('pembayaran.export');
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
        $awal = $request->get('awal');
        $akhir = $request->get('akhir');
        $pembayaran = Pembayaran::whereBetween('created_at', array($awal, $akhir))->orderBy('no_pembayaran')->get();
        $pdf = PDF::loadview('pembayaran.pdf', compact('pembayaran'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Pembayaran.pdf');
    }

    public function pembayaran()
    {
        if (Auth::user()->hak_akses == 'siswa') {
        $pembayaran = Pembayaran::where('user_id', Auth::user()->id)->get();
        return view('pembayaran.detail', compact('pembayaran'));
        } else {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Tidak dapat mengakses"
                ]);
            return redirect()->back();
        }
    }
}
