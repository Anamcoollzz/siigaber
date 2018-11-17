<?php

namespace App\Http\Controllers;

use App\MitraKerja;
use Illuminate\Http\Request;
use DB;

class MitraKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = MitraKerja::all();
        return view('mitra-kerja.index', [
            'data'      => $data,
            'title'     => 'Mitra Kerja',
            'active'    => 'mitra-kerja.index',
            'createLink'=>$r->user()->role == 'Operator' ? route('mitra-kerja.create') : false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mitra-kerja.tambah', [
            'title'         => 'Tambah Mitra Kerja',
            'modul_link'    => route('mitra-kerja.index'),
            'modul'         => 'Mitra Kerja',
            'action'        => route('mitra-kerja.store'),
            'active'        => 'mitra-kerja.create',
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
            'bidang'=>'required|min:3', 
            'kontak'=>'required|min:3', 
        ]);
        if(MitraKerja::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            MitraKerja::truncate();
        }
        $mitraKerja = MitraKerja::create([
            'nama'=>$request->nama,
            'bidang'=>$request->bidang,
            'kontak'=>$request->kontak,
            'deskripsi'=>$request->deskripsi,
            'alamat'=>$request->alamat,
        ]);
        return redirect()->route('mitra-kerja.index')->with('success_msg', 'Mitra Kerja berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mitra Kerja  $mitraKerja
     * @return \Illuminate\Http\Response
     */
    public function show(MitraKerja $mitraKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mitra Kerja  $mitraKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(MitraKerja $mitraKerja)
    {
        return view('mitra-kerja.ubah', [
            'd'             => $mitraKerja,
            'title'         => 'Ubah Mitra Kerja',
            'modul_link'    => route('mitra-kerja.index'),
            'modul'         => 'Mitra Kerja',
            'action'        => route('mitra-kerja.update', $mitraKerja->id),
            'active'        => 'mitra-kerja.edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mitra Kerja  $mitraKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MitraKerja $mitraKerja)
    {
        $request->validate([
            'nama'=>'required|min:3', 
            'bidang'=>'required|min:3', 
            'kontak'=>'required|min:3', 
        ]);
        $data = [
            'nama'=>$request->nama,
            'bidang'=>$request->bidang,
            'kontak'=>$request->kontak,
            'deskripsi'=>$request->deskripsi,
            'alamat'=>$request->alamat,
        ];
        $mitraKerja->update($data);
        return redirect()->route('mitra-kerja.index')->with('success_msg', 'Mitra Kerja berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mitra Kerja  $mitraKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(MitraKerja $mitraKerja)
    {
        $mitraKerja->delete();
        return redirect()->back()->with('success_msg', 'Mitra Kerja berhasil dihapus');
    }
}
