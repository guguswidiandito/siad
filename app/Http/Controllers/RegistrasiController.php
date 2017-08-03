<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registrasi;
use App\Pembayaran;
use Session;
use PDF;
use Auth;

class RegistrasiController extends Controller
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
            $jenis = $request->get('jenis');
            $registrasi = Registrasi::where('no_reg', 'LIKE', '%'.$q.'%')
                                  ->where('kelas_id', 'LIKE', '%'.$kelas.'%')
                                  ->where('jenis_pembayaran_id', 'LIKE', '%'.$jenis.'%')
                                  ->orderBy('no_reg')->paginate(10);
            return view('registrasi.index')->with(compact('registrasi', 'q', 'kelas', 'jenis'));
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
            $pembayaran = Pembayaran::pluck('no_pembayaran', 'id');
            return view('registrasi.create', with(compact('pembayaran')));
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
            'no_reg' => 'required|unique:registrasis',
            'pembayaran_id' => 'required|unique:registrasis',
            'semester' => 'required',
            'bayar' => 'required|integer'
        ]);
        $bayar = $request->get('bayar');
        $pembayaran = Pembayaran::whereIn('id', array($request->get('pembayaran_id')))->get();
        foreach ($pembayaran as $key => $value) {
            $nis = $value->siswa_id;
            $nama = $value->user_id;
            $kelas = $value->siswa->kelas_id;
            $jenis = $value->jenis_pembayaran_id;
            $tunggakan = $value->jenispembayaran->nominal-$bayar;
            if ($tunggakan <= 0) {
                $keterangan = 'Lunas';
            } else {
                $keterangan = 'Belum Lunas';
            }
        }
        $data = $request->all();
        $data['siswa_id'] = $nis;
        $data['user_id'] = $nama;
        $data['kelas_id'] = $kelas;
        $data['jenis_pembayaran_id'] = $jenis;
        $data['tunggakan'] = $tunggakan;
        $data['keterangan'] = $keterangan;
        $registrasi = Registrasi::create($data);
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$registrasi->no_reg berhasil disimpan."
        ]);
        return redirect()->route('registrasi.index');
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
            $registrasi = Registrasi::findOrFail($id);
            $pembayaran = Pembayaran::pluck('no_pembayaran', 'id');
            return view('registrasi.edit', with(compact('registrasi', 'pembayaran')));
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
            'bayar' => 'required|integer'
        ]);
        $bayar = $request->get('bayar');
        $registrasi = Registrasi::find($id);
        $registrasi->tunggakan = $registrasi->jenispembayaran->nominal-$bayar;
        if ($registrasi->tunggakan == 0) {
            $registrasi->keterangan = 'Lunas';
        } else {
            $registrasi->keterangan = 'Belum Lunas';
        }
        $registrasi->update($request->all());
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$registrasi->no_reg berhasil diupdate."
        ]);
        return redirect()->route('registrasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registrasi = Registrasi::find($id);
        $registrasi->delete();
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"$registrasi->no_reg berhasil dihapus."
        ]);
        return redirect()->route('registrasi.index');
    }

    public function export()
    {
        if (Auth::user()->hak_akses == 'admin' || Auth::user()->hak_akses == 'kepsek') {
            return view('registrasi.export');
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
        $registrasi = Registrasi::where('kelas_id', 'like', '%'.$request->get('kelas').'%')
                                   ->where('jenis_pembayaran_id', 'like', '%'.$request->get('jenis').'%')
                                   ->whereYear('created_at', 'LIKE', '%'.$request->get('tahun').'%')
                                   ->orderBy('no_reg')
                                   ->get();
        $pdf = PDF::loadview('registrasi.pdf', compact('registrasi'))->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan Registrasi.pdf');
    }

    public function registrasi()
    {
        if (Auth::user()->hak_akses == 'siswa') {
        $registrasi = Registrasi::where('user_id', Auth::user()->id)->get();
        return view('registrasi.detail', compact('registrasi'));
        } else {
            Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Tidak dapat mengakses"
                ]);
            return redirect()->back();
        }
    }
}
