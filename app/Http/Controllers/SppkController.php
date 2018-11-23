<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sppk;
use App\SppkKategori;
use App\SppkDetailDaerah;
use App\SppkSubKriteria;
use App\SppkPrioritasKategori;
use App\SppkPrioritasKriteria;
use App\SppkPrioritasSubKriteria;
use App\SppkDaerahTujuan;
use App\SppkKriteria;

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
			$sdt->rute 				= $request->rute[$i];
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
		$a = 0;
		foreach ($request->prioritas as $id_kategori => $k) {
			$nama_kategori = SppkKategori::find($id_kategori)->nama;
			$spk = SppkPrioritasKategori::where('id_kategori', $id_kategori)
			->where('id_sppk', $sppk->id)
			->first();
			if(is_null($spk))
				$spk = new SppkPrioritasKategori();
			$spk->id_kategori = $id_kategori;
			$spk->nama = $nama_kategori;
			$spk->id_sppk = $sppk->id;
			$spk->prioritas = $a;
			$spk->bobot = $this->getNilaiBobot(2)[$a];
			$spk->save();
			SppkPrioritasKriteria::where('id_prioritas_kategori', $spk->id)->delete();
			$i = 0;
			foreach ($k as $id_kriteria) {
				$prioritaskriteria = new SppkPrioritasKriteria();
				$prioritaskriteria->id_prioritas_kategori = $spk->id;
				$prioritaskriteria->id_kriteria = $id_kriteria;
				$prioritaskriteria->nama = SppkKriteria::find($id_kriteria)->nama;
				$prioritaskriteria->prioritas = $i;
				$prioritaskriteria->bobot = $this->getNilaiBobot(count($k))[$i];
				$prioritaskriteria->save();
				$i++;
			}
			$a++;
		}
		return redirect()->route('sppk.prioritas-sub',[$sppk->id]);
	}

	public function prioritasSub(Sppk $sppk)
	{
		$sppk->load('prioritaskategori.prioritaskriteria');
		return view('sppk.prioritas-sub',[
			'title'=>'Pilih Prioritas Sub Kriteria',
			'modul_link'=>route('sppk.index'),
			'modul'=>'SPPK',
			'active'=>'sppk.index',
			'kategori'=>SppkKategori::with('kriteria')->get(),
			'd'=>$sppk,
		]);
	}

	public function prioritasSubStore(Sppk $sppk, Request $request)
	{
		foreach ($request->prioritas as $id_prioritas_kategori => $k) {
			foreach ($k as $id_prioritas_kriteria => $subs) {
				SppkPrioritasSubKriteria::where('id_prioritas_kriteria', $id_prioritas_kriteria)->delete();
				$i = 0;
				foreach ($subs as $id_sub) {
					$nama_sub_kriteria = SppkSubKriteria::find($id_sub)->nama;
					$sss = new SppkPrioritasSubKriteria();
					$sss->id_prioritas_kriteria = $id_prioritas_kriteria;
					$sss->id_sub_kriteria = $id_sub;
					$sss->nama = $nama_sub_kriteria;
					$sss->bobot = $this->getNilaiBobot(count($subs))[$i];
					$sss->prioritas = $i;
					$sss->save();
					$i++;
				}
			}
		}
		return redirect()->route('sppk.proses',[$sppk->id]);
	}

	public function proses(Sppk $sppk)
	{
		$sppk->load('daerahtujuan');
		SppkDetailDaerah::whereIn('id_daerah_tujuan', $sppk->daerahtujuan->pluck('id'))->delete();
		foreach ($sppk->daerahtujuan as $d) {
			// JARAK
			$sub_kriteria = '> 15 km';
			if($d->jarak < 10){
				$sub_kriteria = '< 10 km';
			}else if($d->jarak < 15){
				$sub_kriteria = '10 - 15 km';
			}
			$sub = SppkPrioritasSubKriteria::where('nama', $sub_kriteria)->first();
			$detail = new SppkDetailDaerah();
			$detail->id_prioritas_sub_kriteria = $sub->id;
			$detail->id_daerah_tujuan = $d->id;
			$detail->save();

			// BIAYA
			$sub_kriteria = '> 2 juta';
			if($d->biaya < 1){
				$sub_kriteria = '< 1 juta';
			}else if($d->biaya < 2){
				$sub_kriteria = '1 - 2 juta';
			}
			$sub = SppkPrioritasSubKriteria::where('nama', $sub_kriteria)->first();
			$detail = new SppkDetailDaerah();
			$detail->id_prioritas_sub_kriteria = $sub->id;
			$detail->id_daerah_tujuan = $d->id;
			$detail->save();

			// TENGGANG WAKTU
			$tenggang_waktu = floor((strtotime($d->tanggal_distribusi) - strtotime(date('Y-m-d'))) / 3600 / 24 / 7);
			$sub_kriteria = '> 2 minggu';
			if($tenggang_waktu < 1){
				$sub_kriteria = '< 1 minggu';
			}else if($tenggang_waktu < 2){
				$sub_kriteria = '1 - 2 minggu';
			}
			$sub = SppkPrioritasSubKriteria::where('nama', $sub_kriteria)->first();
			$detail = new SppkDetailDaerah();
			$detail->id_prioritas_sub_kriteria = $sub->id;
			$detail->id_daerah_tujuan = $d->id;
			$detail->save();

			// PERMINTAAN
			$permintaan = $d->kebutuhan / 1000;
			$sub_kriteria = '> 500 ton';
			if($permintaan < 100){
				$sub_kriteria = '< 100 ton';
			}else if($permintaan <= 500){
				$sub_kriteria = '500 - 100 ton';
			}
			$sub = SppkPrioritasSubKriteria::where('nama', $sub_kriteria)->first();
			$detail = new SppkDetailDaerah();
			$detail->id_prioritas_sub_kriteria = $sub->id;
			$detail->id_daerah_tujuan = $d->id;
			$detail->save();

			// RUTE
			$sub_kriteria = $d->rute;
			$sub = SppkPrioritasSubKriteria::where('nama', $sub_kriteria)->first();
			$detail = new SppkDetailDaerah();
			$detail->id_prioritas_sub_kriteria = $sub->id;
			$detail->id_daerah_tujuan = $d->id;
			$detail->save();
		}
		$sppk = Sppk::with('daerahtujuan.detail.prioritassubkriteria.prioritaskriteria.prioritaskategori')->where('id',$sppk->id)->first();
		$sppk->daerahtujuan->transform(function($item){
			$item->detail->transform(function($q){
				$q->c = $q['prioritassubkriteria']['bobot'];
				$q->b = $q['prioritassubkriteria']['prioritaskriteria']['bobot'];
				$q->a = $q['prioritassubkriteria']['prioritaskriteria']['prioritaskategori']['bobot'];
				$q->bc = $q->b * $q->c;
				$q->abc = $q->a * $q->bc;
				$q->kategori = $q['prioritassubkriteria']['prioritaskriteria']['prioritaskategori']['nama'];
				$q->prioritas = $q['prioritassubkriteria']['prioritaskriteria']['prioritaskategori']['prioritas'].'.'.$q['prioritassubkriteria']['prioritaskriteria']['prioritas'].'.'.$q['prioritassubkriteria']['prioritas'];
				return $q;
			});
			$sortedPrioritas = $item->detail->sortBy('prioritas')->values();
			$item->nilai_hasil = $item->detail->sum(function($i){
				return $i['prioritassubkriteria']['bobot'] * $i['prioritassubkriteria']['prioritaskriteria']['bobot'] * $i['prioritassubkriteria']['prioritaskriteria']['prioritaskategori']['bobot'];
			});
			$item = collect($item)->forget('detail');
			$item['detail'] = $sortedPrioritas;
			return $item;
		});
		$sorted = $sppk->daerahtujuan->sortByDesc('nilai_hasil')->values();
		$sppk = collect($sppk)->forget('daerahtujuan');
		$sppk['daerahtujuan'] = $sorted;
		Sppk::find($sppk['id'])->update([
			'id_teratas'=>$sppk['daerahtujuan']->first()['id'],
		 	'teratas'=>$sppk['daerahtujuan']->first()['nama_desa'],
		 	'hasil'=>$sorted->toJson(),
		]);
		return redirect()->route('hasil',$sppk['id']);
	}

	function getNilaiBobot($jml){
		switch ($jml) {
			case 2:
			return [ 0.75, 0.25];
			break;
			case 3:
			return [ 0.611, 0.278, 0.111];
			break;
			case 4:
			return  [0.521, 0.271, 0.146, 0.063,];
			break;
			case 5:
			return [ 0.457, 0.257, 0.157, 0.090, 0.040,];
			break;
			case 6:
			return [ 0.408, 0.242, 0.158, 0.103, 0.061, 0.028, ];
			break;
			case 7:
			return [ 0.370, 0.228, 0.156, 0.109, 0.073, 0.044, 0.028, ];
			break;
			case 8:
			return [ 0.340, 0.215, 0.152, 0.111, 0.079, 0.054, 0.034, 0.016, ];
			break;
			case 9:
			return [ 0.314, 0.203, 0.148, 0.111, 0.083, 0.061, 0.042, 0.026, 0.012, ];
			break;

			default:
			'erroooooooor';
			break;
		}

	}

	public function hasil(Sppk $sppk)
	{
		// return $sppk->hasil;
		$sppk->load('detailteratas');
		return view('sppk.hasil',[
			'd'=>$sppk,
			'title'=>'Hasil SPPK',
			'modul_link'=>route('sppk.index'),
			'modul'=>'SPPK',
			'active'=>'sppk.index',
		]);
	}

}