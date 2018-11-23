@extends('app.form')
@section('content')
<div class="content-wrapper">
	@include('page_header2')
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">
							Rekomendasi Distribusi
						</h3>
					</div>
					<div class="box-body">
						<table class="table table-bordered table-striped">
							<tbody>
								<tr>
									<td>Nama Desa</td>
									<td>:</td>
									<td>{{ $d->detailteratas->nama_desa }}</td>
								</tr>
								<tr>
									<td>Nama Kecamatan</td>
									<td>:</td>
									<td>{{ $d->detailteratas->nama_kecamatan }}</td>
								</tr>
								<tr>
									<td>Nama Kepala Desa</td>
									<td>:</td>
									<td>{{ $d->detailteratas->nama_kepala_desa }}</td>
								</tr>
								<tr>
									<td>Kebutuhan</td>
									<td>:</td>
									<td>{{ $d->detailteratas->kebutuhan }} kg</td>
								</tr>
								<tr>
									<td>Biaya</td>
									<td>:</td>
									<td>Rp. {{ $d->detailteratas->biaya }}</td>
								</tr>
								<tr>
									<td>Jarak</td>
									<td>:</td>
									<td>{{ $d->detailteratas->jarak }} km</td>
								</tr>
								<tr>
									<td>Tanggal Distribusi</td>
									<td>:</td>
									<td>{{ $d->detailteratas->tanggal_distribusi }}</td>
								</tr>
								<tr>
									<td>Rute</td>
									<td>:</td>
									<td>{{ $d->detailteratas->rute }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="box-footer">
						<a onclick="showRincian(event)" href="" class="btn btn-success btn-flat">Rincian</a>
						<a id="show-rincian-nilai" style="display: none;" onclick="showRincianNilai(event)" href="" class="btn btn-primary btn-flat">Cek Nilai</a>
					</div>
				</div>
			</div>
			<div id="perankingan" style="display: none;">
				<div class="col-md-12">
					<h3 id="hasil-perankingan" class="text-center">
						Hasil Perankingan
					</h3>
				</div>
				@php
				$hasil = is_string($d->hasil) ? json_decode($d->hasil) : $d->hasil;
				@endphp
				@foreach ($hasil as $h)
				<div class="col-md-6">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title">
								Ranking {{$loop->iteration}}
							</h3>
						</div>
						<div class="box-body">
							<table class="table table-bordered table-striped">
								<tbody>
									<tr>
										<td>Nama Desa</td>
										<td>:</td>
										<td>{{ $h->nama_desa }}</td>
									</tr>
									<tr>
										<td>Nama Kecamatan</td>
										<td>:</td>
										<td>{{ $h->nama_kecamatan }}</td>
									</tr>
									<tr>
										<td>Nama Kepala Desa</td>
										<td>:</td>
										<td>{{ $h->nama_kepala_desa }}</td>
									</tr>
									<tr>
										<td>Kebutuhan</td>
										<td>:</td>
										<td>{{ $h->kebutuhan }} kg</td>
									</tr>
									<tr>
										<td>Biaya</td>
										<td>:</td>
										<td>Rp. {{ $h->biaya }}</td>
									</tr>
									<tr>
										<td>Jarak</td>
										<td>:</td>
										<td>{{ $h->jarak }} km</td>
									</tr>
									<tr>
										<td>Tanggal Distribusi</td>
										<td>:</td>
										<td>{{ $h->tanggal_distribusi }}</td>
									</tr>
									<tr>
										<td>Rute</td>
										<td>:</td>
										<td>{{ $h->rute }}</td>
									</tr>
									<tr class="perhitungan" style="display: none;">
										<td colspan="3" align="center">
											<strong>
												Perhitungan
											</strong>
										</td>
									</tr>
									@foreach (collect($h->detail)->groupBy('kategori') as $kategori => $k)
									<tr class="perhitungan" style="display: none;">
										<td colspan="3" style="color: red;">{{$kategori}} ({{$k->first()->a}})</td>
									</tr>
									@foreach ($k as $detail)
									<tr class="perhitungan" style="display: none;">
										<td>
											{{$detail->prioritassubkriteria->prioritaskriteria->nama}}
											({{$detail->b}})
										</td>
										<td>:</td>
										<td>
											{{$detail->prioritassubkriteria->nama}}
											({{$detail->c}})
										</td>
									</tr>
									@endforeach
									<tr class="perhitungan" style="display: none;">
										<td>Hasil</td>
										<td>:</td>
										<td>{{$k->sum(function($item){return $item->abc;})}}</td>
									</tr>
									@endforeach
									<tr class="perhitungan" style="color: green; display: none;">
										<td>Total Hasil</td>
										<td>:</td>
										<td>{{ $h->nilai_hasil }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
</div>
@endsection

@push('script')
<script>
	function showRincian(e){
		e.preventDefault();
		$('#perankingan').fadeIn();
		var body = $("html, body");
		body.stop().animate({scrollTop:$('#hasil-perankingan').offset().top-100}, 700, 'swing');
		$('#show-rincian-nilai').fadeIn();
	}

	function showRincianNilai(e){
		e.preventDefault();
		$('.perhitungan').fadeIn();
	}
</script>
@endpush