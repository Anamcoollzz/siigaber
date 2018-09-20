<?php 

namespace App\Mytrait;

trait Tanggal {

	public function tglIndo($tgl)
	{
		return $this->tgl($tgl).' '.$this->namaBulan($this->bulan($tgl)).' '.$this->tahun($tgl);
	}

	public function englishFormat($tgl)
	{
		return substr($tgl, 6, 4).'-'.substr($tgl, 3, 2).'-'.substr($tgl, 0, 2);
	}

	public function formatIndo($tgl)
	{
		return $this->tgl($tgl).'-'.$this->bulan($tgl).'-'.$this->tahun($tgl);
	}

	public function tahun($tgl)
	{
		return substr($tgl, 0, 4);
	}

	public function bulan($tgl)
	{
		return substr($tgl, 5, 2);
	}

	public function tgl($tgl)
	{
		return substr($tgl, 8, 2);
	}

	public function namaBulan($bulan){
		switch ($bulan) {
			case '01': return 'Januari'; break;
			case '02': return 'Februari'; break;
			case '03': return 'Maret'; break;
			case '04': return 'April'; break;
			case '05': return 'Mei'; break;
			case '06': return 'Juni'; break;
			case '07': return 'Juli'; break;
			case '08': return 'Agustus'; break;
			case '09': return 'September'; break;
			case '10': return 'Oktober'; break;
			case '11': return 'November'; break;
			case '12': return 'Desember'; break;
			default: return 'Tidak valid!!!'; break;
		}
	}


}