<?php

namespace App\Http\Controllers;

use App\Pengadaan;
use App\GudangDetail;
use App\JenisBeras;
use App\MitraKerja;
use Illuminate\Http\Request;
use App\Gudang;
use Validator;
use DB;

class PengadaanController extends Controller
{

    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\HanyaOperator::class)->except('index','verifikasi','show','selesai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = Pengadaan::latest()->get();
        return view('pengadaan.index', [
            'data'      => $data,
            'title'     => 'Pengadaan',
            'active'    => 'pengadaan.index',
            'createLink'=>$r->user()->role == 'Operator' ? route('pengadaan.create') : false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengadaan.tambah', [
            'title'         => 'Tambah Pengadaan',
            'modul_link'    => route('pengadaan.index'),
            'modul'         => 'Pengadaan',
            'action'        => route('pengadaan.store'),
            'active'        => 'pengadaan.create',
            'listMitraKerja'=>MitraKerja::listMode(),
            'gudang'=>Gudang::all(),
            'listJenisBeras'=>JenisBeras::listMode(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];
        $request->validate([
            'tanggal'=>'required|date_format:Y-m-d',  
            'biaya'=>'required|numeric', 
        ]);
        $validator = Validator::make($request->all(), [
            'tanggal'=>'required|date_format:Y-m-d', 
            'biaya'=>'required|numeric', 
        ]);
        if(!isset($request->id_gudang)){
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Setidaknya pilih salah satu gudang');
        }
        foreach ($request->id_gudang as $id_gudang) {
            $rules['isi_gudang_'.$id_gudang] = 'required|numeric';
        }
        $request->validate($rules);
        if(Pengadaan::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Pengadaan::truncate();
        }
        $pengadaan = Pengadaan::create([
            'jumlah'=>$request->jumlah,
            'biaya'=>$request->biaya,
            // 'biaya_transport'=>$request->biaya_transport,
            'id_mitra_kerja'=>$request->id_mitra_kerja,
            'jenis_pengadaan'=>$request->jenis,
            'status'=>'Menunggu persetujuan',
            'tanggal'=>$request->tanggal,
            'id_jenis_beras'=>$request->id_jenis_beras,
        ]);
        foreach ($request->id_gudang as $id_gudang) {
            $pengadaan->kegudang()->create([
                'jumlah'=>$request['isi_gudang_'.$id_gudang],
                'id_gudang'=>$id_gudang,
            ]);
        }
        return redirect()->route('pengadaan.index')->with('success_msg', 'Pengadaan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengadaan $pengadaan)
    {
        // DB::enableQueryLog();
        $pengadaan->load('kegudang.gudang');
        // return DB::getQueryLog();
        // return $pengadaan;
        return view('pengadaan.detail', [
            'title'         => 'Detail Pengadaan',
            'modul_link'    => route('pengadaan.index'),
            'modul'         => 'Pengadaan',
            'active'        => 'pengadaan.index',
            'd'=>$pengadaan, 
            'custom_breadcrumb'=>true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengadaan $pengadaan)
    {
        $pengadaan->load('kegudang.gudang');
        return view('pengadaan.ubah', [
            'd'             => $pengadaan,
            'title'         => 'Ubah Pengadaan',
            'modul_link'    => route('pengadaan.index'),
            'modul'         => 'Pengadaan',
            'action'        => route('pengadaan.update', $pengadaan->id),
            'active'        => 'pengadaan.index',
            'listMitraKerja'=>MitraKerja::listMode(),
            'gudang'=>Gudang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengadaan $pengadaan)
    {
        $rules = [];
        $validator = Validator::make($request->all(), [
            'tanggal'=>'required|date_format:Y-m-d', 
            'jumlah'=>'required|numeric', 
            'biaya'=>'required|numeric', 
            'biaya_transport'=>'required|numeric',
        ]);
        if(!isset($request->id_gudang)){
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Setidaknya pilih salah satu gudang');
        }
        foreach ($request->id_gudang as $id_gudang) {
            $rules['isi_gudang_'.$id_gudang] = 'required|numeric';
        }
        $request->validate($rules);
        $data = [
            'jumlah'=>$request->jumlah,
            'biaya'=>$request->biaya,
            'biaya_transport'=>$request->biaya_transport,
            'id_mitra_kerja'=>$request->id_mitra_kerja,
            'status'=>'Menunggu persetujuan',
            'tanggal'=>$request->tanggal,
        ];
        $pengadaan->update($data);
        $pengadaan->kegudang()->delete();
        foreach ($request->id_gudang as $id_gudang) {
            $pengadaan->kegudang()->create([
                'jumlah'=>$request['isi_gudang_'.$id_gudang],
                'id_gudang'=>$id_gudang,
            ]);
        }
        return redirect()->route('pengadaan.index')->with('success_msg', 'Pengadaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengadaan $pengadaan)
    {
        $pengadaan->delete();
        return redirect()->back()->with('success_msg', 'Pengadaan berhasil dihapus');
    }

    public function verifikasi(Pengadaan $pengadaan)
    {
        $pengadaan->update([
            'status'=>'Dalam pengerjaan',
        ]);
        return redirect()->back()->with('success_msg', 'Pengadaan berhasil diverifikasi');
    }

    public function selesai(Pengadaan $pengadaan, Request $request)
    {
        $request->validate([
            'biaya_transport'=>'required|numeric|min:1000',
        ]);
        $pengadaan->update([
            'status'=>'Selesai',
            'biaya_transport'=>$request->biaya_transport,
            'tanggal_selesai'=>date('Y-m-d'),
        ]);
        $pengadaan->load('kegudang');
        foreach ($pengadaan->kegudang as $detail) {
            $gd = GudangDetail::where('id_jenis_beras', $pengadaan->id_jenis_beras)
            ->where('id_gudang', $detail->id_gudang)
            ->first();
            if(is_null($gd)){
                $gd = GudangDetail::create([
                    'id_jenis_beras'=>$pengadaan->id_jenis_beras,
                    'id_gudang'=>$detail->id_gudang,
                    'jml_beras'=>$pengadaan->jenis_pengadaan == 'Beras' ? $detail->jumlah : 0,
                    'jml_gabah'=>$pengadaan->jenis_pengadaan == 'Gabah' ? $detail->jumlah : 0,
                ]);
            }
            if($pengadaan->jenis_pengadaan == 'Beras')
                $gd->jml_beras += $detail->jumlah;
            else
                $gd->jml_gabah += $detail->jumlah;
            $gd->save();
        }
        return redirect()->back()->with('success_msg', 'Pengadaan selesai :)');
    }
}
