<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sppk;
use App\SppkKategori;
use App\SppkPrioritasKategori;
use App\SppkDaerahTujuan;

class SppkController extends Controller
{

	public function index(Request $r)
	{
		$data = Sppk::latest()->get();
		return view('sppk.index', [
			'data'      => $data,
			'title'     => 'SPPK',
			'active'    => 'sppk.index',
			'createLink'=>route('sppk.create'),
		]);
	}

	public function create()
	{
		return view('sppk.tambah', [
			'title'         => 'SPPK Baru',
			'modul_link'    => route('sppk.index'),
			'modul'         => 'SPPK',
			'active'        => 'sppk.index',
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'nama_desa'=>'required|array',
			'nama_kecamatan'=>'required|array',
			'nama_kepala_desa'=>'required|array',
			'kebutuhan'=>'required|array',
			'biaya'=>'required|array',
			'jarak'=>'required|array',
			'tanggal'=>'required|array',
			'nama_desa.*'=>'required',
			'nama_kecamatan.*'=>'required',
			'nama_kepala_desa.*'=>'required',
			'kebutuhan.*'=>'required',
			'biaya.*'=>'required',
			'jarak.*'=>'required',
			'tanggal.*'=>'required',
			'keterangan'=>'required',
		]);
		$sppk = new Sppk();
		$sppk->keterangan = $request->keterangan;
		$sppk->save();
		$i = 0;
		foreach($request->nama_desa as $nama_desa){
			$sdt 					= new SppkDaerahTujuan();
			$sdt->nama_desa 		= $request->nama_desa[$i];
			$sdt->nama_kecamatan 	= $request->nama_kecamatan[$i];
			$sdt->nama_kepala_desa 	= $request->nama_kepala_desa[$i];
			$sdt->kebutuhan 		= $request->kebutuhan[$i];
			$sdt->biaya 			= $request->biaya[$i];
			$sdt->jarak 			= $request->jarak[$i];
			$sdt->tanggal_distribusi= $request->tanggal[$i];
			$sdt->id_sppk			= $sppk->id;
			$sdt->save();
			$i++;
		}
		return redirect()->route('sppk.prioritas',[$sppk->id]);
	}

	public function prioritas(Sppk $sppk)
	{
		return view('sppk.prioritas',[
			'title'=>'Pilih Prioritas',
			'modul_link'=>route('sppk.index'),
			'modul'=>'SPPK',
			'active'=>'sppk.index',
			'kategori'=>SppkKategori::with('kriteria')->get(),
			'd'=>$sppk,
		]);
	}

	public function prioritasStore(Sppk $sppk, Request $request)
	{
		foreach ($request->prioritas as $id_kategori => $k) {
			$spk = SppkPrioritasKategori::where('id_sppk', $id_kategori)
			->where('id_sppk', $sppk->id)
			->first();
			if(is_null($spk))
				$spk = new SppkPrioritasKategori();
			$spk->id_kategori = $id_kategori;
			$spk->id_sppk = $sppk->id;
			$spk->save();
		}
		return redirect()->route('sppk.prioritas-sub',[$sppk->id]);
	}

	public function prioritasSub(Sppk $sppk)
	{
		return view('sppk.prioritas-sub',[
			'title'=>'Pilih Prioritas Sub Kriteria',
			'modul_link'=>route('sppk.index'),
			'modul'=>'SPPK',
			'active'=>'sppk.index',
			'kategori'=>SppkKategori::with('kriteria')->get(),
			'd'=>$sppk,
		]);
	}

}
