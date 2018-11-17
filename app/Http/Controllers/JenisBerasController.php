<?php

namespace App\Http\Controllers;

use App\JenisBeras;
use Illuminate\Http\Request;
use DB;

class JenisBerasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = JenisBeras::all();
        return view('jenis-beras.index', [
            'data'      => $data,
            'title'     => 'Jenis Beras',
            'active'    => 'jenis-beras.index',
            'createLink'=>$r->user()->role == 'Operator' ? route('jenis-beras.create') : false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis-beras.tambah', [
            'title'         => 'Tambah Jenis Beras',
            'modul_link'    => route('jenis-beras.index'),
            'modul'         => 'Jenis Beras',
            'action'        => route('jenis-beras.store'),
            'active'        => 'jenis-beras.create',
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
        ]);
        if(JenisBeras::count() == 0){
            DB::statement('set foreign_key_checks=0;');
            JenisBeras::truncate();
        }
        $jenisBeras = JenisBeras::create([
            'nama'=>$request->nama,
        ]);
        return redirect()->route('jenis-beras.index')->with('success_msg', 'Jenis Beras berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jenis Beras  $jenisBeras
     * @return \Illuminate\Http\Response
     */
    public function show(JenisBeras $jenisBeras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jenis Beras  $jenisBeras
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisBeras $jenisBera)
    {
        return view('jenis-beras.ubah', [
            'd'             => $jenisBera,
            'title'         => 'Ubah Jenis Beras',
            'modul_link'    => route('jenis-beras.index'),
            'modul'         => 'Jenis Beras',
            'action'        => route('jenis-beras.update', $jenisBera->id),
            'active'        => 'jenis-beras.edit',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jenis Beras  $jenisBeras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisBeras $jenisBera)
    {
        $request->validate([
            'nama'=>'required|min:3', 
        ]);
        $data = [
            'nama'=>$request->nama,
        ];
        $jenisBera->update($data);
        return redirect()->route('jenis-beras.index')->with('success_msg', 'Jenis Beras berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jenis Beras  $jenisBeras
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisBeras $jenisBera)
    {
        $jenisBera->delete();
        return redirect()->back()->with('success_msg', 'Jenis Beras berhasil dihapus');
    }
}
