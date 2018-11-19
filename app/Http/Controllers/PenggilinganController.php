<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Penggilingan;
use App\MitraKerja;
use App\JenisBeras;
use App\Gudang;
use App\GudangDetail;
use Illuminate\Http\Request;

class PenggilinganController extends Controller
{

    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\HanyaOperator::class)->except('index','show','verifikasi','selesai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = Penggilingan::with('jenis')->get();
        return view('penggilingan.index', [
            'data'      => $data,
            'title'     => 'Penggilingan',
            'active'    => 'penggilingan.index',
            'createLink'=>route('penggilingan.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penggilingan.tambah', [
            'title'         => 'Tambah Penggilingan',
            'modul_link'    => route('penggilingan.index'),
            'modul'         => 'Penggilingan',
            'action'        => route('penggilingan.store'),
            'active'        => 'penggilingan.create',
            'listMitraKerja'=>MitraKerja::listMode(),
            'listJenisBeras'=>JenisBeras::listMode(),
            'gudang'=>Gudang::all(),
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
        $validator = Validator::make($request->all(), [
            'tanggal_mulai'=>'required|date_format:Y-m-d', 
            'jumlah'=>'required|numeric', 
            'biaya'=>'required|numeric', 
        ]);
        if(!isset($request->id_gudang)){
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Setidaknya pilih salah satu gudang');
        }
        foreach ($request->id_gudang as $id_gudang) {
            $rules['isi_gudang_'.$id_gudang] = 'required|numeric';
        }
        $request->validate($rules);
        if(Penggilingan::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Penggilingan::truncate();
        }
        $penggilingan = Penggilingan::create([
            'tanggal_mulai'=>$request->tanggal_mulai,
            'biaya'=>$request->biaya,
            'id_mitra_kerja'=>$request->id_mitra_kerja,
            'id_jenis_beras'=>$request->id_jenis_beras,
            'status'=>'Menunggu persetujuan',
        ]);
        foreach ($request->id_gudang as $id_gudang) {
            $penggilingan->detail()->create([
                'jumlah'=>$request['isi_gudang_'.$id_gudang],
                'id_gudang'=>$id_gudang,
            ]);
            $gd = GudangDetail::where('id_gudang',$id_gudang)->where('id_jenis_beras',$request->id_jenis_beras)
            ->first();
            if(is_null($gd)){
                $gd = GudangDetail::create([
                    'id_gudang'=>$id_gudang,
                    'id_jenis_beras'=>$request->id_jenis_beras,
                ]);
            }
            $gd->jml_gabah -= $request['isi_gudang_'.$id_gudang];
            $gd->save();
        }
        return redirect()->route('penggilingan.index')->with('success_msg', 'Penggilingan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penggilingan  $penggilingan
     * @return \Illuminate\Http\Response
     */
    public function show(Penggilingan $penggilingan)
    {
        $penggilingan->load('detail.gudang','jenis');
        return view('penggilingan.detail', [
            'title'         => 'Detail Penggilingan',
            'modul_link'    => route('penggilingan.index'),
            'modul'         => 'Penggilingan',
            'active'        => 'penggilingan.index',
            'd'=>$penggilingan, 
            'custom_breadcrumb'=>true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penggilingan  $penggilingan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penggilingan $penggilingan)
    {
        $penggilingan->load('kegudang.gudang');
        return view('penggilingan.ubah', [
            'd'             => $penggilingan,
            'title'         => 'Ubah Penggilingan',
            'modul_link'    => route('penggilingan.index'),
            'modul'         => 'Penggilingan',
            'action'        => route('penggilingan.update', $penggilingan->id),
            'active'        => 'penggilingan.index',
            'listMitraKerja'=>MitraKerja::listMode(),
            'gudang'=>Gudang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penggilingan  $penggilingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penggilingan $penggilingan)
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
        $penggilingan->update($data);
        $penggilingan->kegudang()->delete();
        foreach ($request->id_gudang as $id_gudang) {
            $penggilingan->kegudang()->create([
                'jumlah'=>$request['isi_gudang_'.$id_gudang],
                'id_gudang'=>$id_gudang,
            ]);
        }
        return redirect()->route('penggilingan.index')->with('success_msg', 'Penggilingan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penggilingan  $penggilingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penggilingan $penggilingan)
    {
        $penggilingan->delete();
        return redirect()->back()->with('success_msg', 'Penggilingan berhasil dihapus');
    }

    public function verifikasi(Penggilingan $penggilingan)
    {
        $penggilingan->update([
            'status'=>'Dalam pengerjaan',
        ]);
        return redirect()->back()->with('success_msg', 'Penggilingan berhasil diverifikasi');
    }

    public function selesai(Penggilingan $penggilingan, Request $r)
    {
        $r->validate([
            'biaya_transport'=>'required|numeric|min:1',
        ]);
        $penggilingan->update([
            'status'=>'Selesai',
            'biaya_transport'=>$r->biaya_transport,
        ]);
        return redirect(url()->previous().'?error_id='.$penggilingan->id)->with('success_msg', 'Penggilingan selesai :)');
    }
}
