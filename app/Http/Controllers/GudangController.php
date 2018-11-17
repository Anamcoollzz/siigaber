<?php

namespace App\Http\Controllers;

use App\Gudang;
use App\JenisBeras;
use App\GudangDetail;
use DB;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = Gudang::with('detail')->get();
        return view('gudang.index', [
            'data'      => $data,
            'title'     => 'Gudang',
            'active'    => 'gudang.index',
            'createLink'=>route('gudang.create'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gudang.tambah', [
            'title'         => 'Tambah Gudang',
            'modul_link'    => route('gudang.index'),
            'modul'         => 'Gudang',
            'action'        => route('gudang.store'),
            'active'        => 'gudang.create',
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
        $request->validate([
            'nama'=>'required|min:3', 
            'lokasi'=>'required',
            'kapasitas'=>'required|numeric|min:1',
        ]);
        if(Gudang::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Gudang::truncate();
        }
        $gudang = Gudang::create([
            'nama'=>$request->nama,
            'lokasi'=>$request->lokasi,
            'kapasitas'=>$request->kapasitas,
        ]);
        return redirect()->route('gudang.index')->with('success_msg', 'Gudang berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function show(Gudang $gudang)
    {
        $gudang->load('detail.jenis');
        return view('gudang.detail', [
            'title'         => 'Detail Gudang',
            'modul_link'    => route('gudang.index'),
            'modul'         => 'Gudang',
            'active'        => 'gudang.index',
            'd'=>$gudang, 
            'custom_breadcrumb'=>true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function edit(Gudang $gudang)
    {
        return view('gudang.ubah', [
            'd'             => $gudang,
            'title'         => 'Ubah Gudang',
            'modul_link'    => route('gudang.index'),
            'modul'         => 'Gudang',
            'action'        => route('gudang.update', $gudang->id),
            'active'        => 'gudang.edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gudang $gudang)
    {
        $request->validate([
            'nama'=>'required|min:3', 
            'lokasi'=>'required',
            'kapasitas'=>'required|numeric|min:1',
        ]);
        $data = [
            'nama'=>$request->nama,
            'lokasi'=>$request->lokasi,
            'kapasitas'=>$request->kapasitas,
        ];
        $gudang->update($data);
        return redirect()->route('gudang.index')->with('success_msg', 'Gudang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gudang $gudang)
    {
        $gudang->delete();
        return redirect()->back()->with('success_msg', 'Gudang berhasil dihapus');
    }

    public function stokBerasPerJenis(Request $request)
    {
        $request->validate([
            'id_jenis_beras'=>'required',
            'id_gudang'=>'required'
        ]);
        $gd = GudangDetail::firstOrCreate([
            'id_jenis_beras'=>$request->id_jenis_beras,
            'id_gudang'=>$request->id_gudang,
        ]);
        $gd = GudangDetail::where('id_jenis_beras', $request->id_jenis_beras)
        ->where('id_gudang',$request->id_gudang)
        ->first();
        return [
            'status'=>'ok',
            'status_code'=>200,
            'message'=>'Stok beras dengan jenis '.JenisBeras::find($request->id_jenis_beras)->nama,
            'data'=>$gd
        ];
    }
}
