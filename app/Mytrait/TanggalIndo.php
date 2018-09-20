<?php 

namespace App\Mytrait;
use App\Mytrait\Tanggal;

trait TanggalIndo {

	use Tanggal;

	public function getTanggalIndoAttribute()
	{
		return $this->tglIndo($this->tanggal);
	}

	public function hh()
	{
		return 2;
	}

}