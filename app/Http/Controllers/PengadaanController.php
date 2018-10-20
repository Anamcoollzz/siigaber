<?php

namespace App\Http\Controllers;

use App\Pengadaan;
use App\MitraKerja;
use Illuminate\Http\Request;
use App\Gudang;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = Pengadaan::all();
        return view('pengadaan.index', [
            'data'      => $data,
            'title'     => 'Pengadaan',
            'active'    => 'pengadaan.index',
            'createLink'=>route('pengadaan.create'),
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
        if(Pengadaan::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            Pengadaan::truncate();
        }
        $pengadaan = Pengadaan::create([
            'nama'=>$request->nama,
            'bidang'=>$request->bidang,
            'kontak'=>$request->kontak,
            'deskripsi'=>$request->deskripsi,
            'alamat'=>$request->alamat,
        ]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengadaan  $pengadaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengadaan $pengadaan)
    {
        return view('pengadaan.ubah', [
            'd'             => $pengadaan,
            'title'         => 'Ubah Pengadaan',
            'modul_link'    => route('pengadaan.index'),
            'modul'         => 'Pengadaan',
            'action'        => route('pengadaan.update', $pengadaan->id),
            'active'        => 'pengadaan.edit',
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
        $pengadaan->update($data);
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
}
