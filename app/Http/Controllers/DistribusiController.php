<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Distribusi;
use App\MitraKerja;
use App\JenisBeras;
use App\Gudang;
use App\GudangDetail;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = Distribusi::with('jenis')->orderBy('id','desc')->get();
        return view('distribusi.index', [
            'data'      => $data,
            'title'     => 'Distribusi',
            'active'    => 'distribusi.index',
            'createLink'=>route('distribusi.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distribusi.tambah', [
            'title'         => 'Tambah Distribusi',
            'modul_link'    => route('distribusi.index'),
            'modul'         => 'Distribusi',
            'action'        => route('distribusi.store'),
            'active'        => 'distribusi.create',
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
            'tipe'=>'required', 
        ]);
        if(!isset($request->id_gudang)){
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Setidaknya pilih salah satu gudang');
        }
        foreach ($request->id_gudang as $id_gudang) {
            $rules['isi_gudang_'.$id_gudang] = 'required|numeric';
        }
        $request->validate($rules);
        if(Distribusi::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Distribusi::truncate();
        }
        $distribusi = Distribusi::create([
            'tanggal_mulai'=>$request->tanggal_mulai,
            'biaya'=>$request->biaya,
            'id_mitra_kerja'=>$request->tipe == 'Umum' ? $request->id_mitra_kerja : null,
            'id_jenis_beras'=>$request->id_jenis_beras,
            'nama_desa'=>$request->tipe == 'Raskin' ? $request->nama_desa : null,
            'nama_kecamatan'=>$request->tipe == 'Raskin' ? $request->nama_kecamatan : null,
            'nama_kepala_desa'=>$request->tipe == 'Raskin' ? $request->nama_kepala_desa : null,
            'status'=>'Menunggu persetujuan',
            'tipe'=>$request->tipe,
        ]);
        foreach ($request->id_gudang as $id_gudang) {
            $distribusi->detail()->create([
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
            $gd->jml_beras -= $request['isi_gudang_'.$id_gudang];
            $gd->save();
        }
        return redirect()->route('distribusi.index')->with('success_msg', 'Distribusi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Distribusi  $distribusi
     * @return \Illuminate\Http\Response
     */
    public function show(Distribusi $distribusi)
    {
        $distribusi->load('detail.gudang','jenis');
        return view('distribusi.detail', [
            'title'         => 'Detail Distribusi',
            'modul_link'    => route('distribusi.index'),
            'modul'         => 'Distribusi',
            'active'        => 'distribusi.index',
            'd'=>$distribusi, 
            'custom_breadcrumb'=>true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Distribusi  $distribusi
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribusi $distribusi)
    {
        $distribusi->load('detail.gudang');
        return view('distribusi.ubah', [
            'd'             => $distribusi,
            'title'         => 'Ubah Distribusi',
            'modul_link'    => route('distribusi.index'),
            'modul'         => 'Distribusi',
            'action'        => route('distribusi.update', $distribusi->id),
            'active'        => 'distribusi.index',
            'listMitraKerja'=>MitraKerja::listMode(),
            'listJenisBeras'=>JenisBeras::listMode(),
            'gudang'=>Gudang::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Distribusi  $distribusi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribusi $distribusi)
    {
        $rules = [];
        $validator = Validator::make($request->all(), [
            'tanggal_mulai'=>'required|date_format:Y-m-d', 
            'tipe'=>'required', 
        ]);
        if(!isset($request->id_gudang)){
            return redirect()->back()->withErrors($validator)->withInput()->with('error_msg', 'Setidaknya pilih salah satu gudang');
        }
        foreach ($request->id_gudang as $id_gudang) {
            $rules['isi_gudang_'.$id_gudang] = 'required|numeric';
        }
        $request->validate($rules);
        if(Distribusi::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Distribusi::truncate();
        }
        $distribusi->load('detail');
        foreach ($distribusi->detail as $detail) {
            $gd = GudangDetail::where('id_gudang',$detail->id_gudang)
            ->where('id_jenis_beras',$distribusi->id_jenis_beras)
            ->first();
            $gd->jml_beras += $detail->jumlah;
            $gd->save();
        }
        $distribusi->update([
            'tanggal_mulai'=>$request->tanggal_mulai,
            'biaya'=>$request->biaya,
            'id_mitra_kerja'=>$request->tipe == 'Umum' ? $request->id_mitra_kerja : null,
            'id_jenis_beras'=>$request->id_jenis_beras,
            'nama_desa'=>$request->tipe == 'Raskin' ? $request->nama_desa : null,
            'nama_kecamatan'=>$request->tipe == 'Raskin' ? $request->nama_kecamatan : null,
            'nama_kepala_desa'=>$request->tipe == 'Raskin' ? $request->nama_kepala_desa : null,
            'status'=>'Menunggu persetujuan',
            'tipe'=>$request->tipe,
        ]);
        $distribusi->detail()->delete();
        foreach ($request->id_gudang as $id_gudang) {
            $distribusi->detail()->create([
                'jumlah'=>$request['isi_gudang_'.$id_gudang],
                'id_gudang'=>$id_gudang,
            ]);
            $gd = GudangDetail::where('id_gudang',$id_gudang)
            ->where('id_jenis_beras',$request->id_jenis_beras)
            ->first();
            if(is_null($gd)){
                $gd = GudangDetail::create([
                    'id_gudang'=>$id_gudang,
                    'id_jenis_beras'=>$request->id_jenis_beras,
                ]);
            }
            $gd->jml_beras -= $request['isi_gudang_'.$id_gudang];
            $gd->save();
        }
        return redirect()->route('distribusi.show',[$distribusi->id])->with('success_msg', 'Distribusi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Distribusi  $distribusi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribusi $distribusi)
    {
        $distribusi->delete();
        return redirect()->back()->with('success_msg', 'Distribusi berhasil dihapus');
    }

    public function verifikasi(Distribusi $distribusi)
    {
        $distribusi->update([
            'status'=>'Dalam pengerjaan',
        ]);
        return redirect()->back()->with('success_msg', 'Distribusi berhasil diverifikasi');
    }

    public function selesai(Distribusi $distribusi, Request $r)
    {
        $r->validate([
            'biaya_transport'=>'required|numeric|min:1',
        ]);
        $distribusi->update([
            'status'=>'Selesai',
            'biaya_transport'=>$r->biaya_transport,
        ]);
        return redirect(url()->previous().'?error_id='.$distribusi->id)->with('success_msg', 'Distribusi selesai :)');
    }
}
