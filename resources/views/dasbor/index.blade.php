<div class="row">

{{--   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-maroon">
      <div class="inner">
        <h3>{{ $jmlKar }}</h3>
        <p>Karyawan</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="{{ route('karyawan.index') }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div> --}}

  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{ $jmlTS }}</h3>
        <p>Time Sheet Karyawan</p>
      </div>
      <div class="icon">
        <i class="fa fa-clock-o"></i>
      </div>
      <a href="{{ route('time-sheet.by-waktu') }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  {{-- <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-orange">
      <div class="inner">
        <h3>{{ $jmlKlien }}</h3>
        <p>Klien</p>
      </div>
      <div class="icon">
        <i class="fa fa-user-plus"></i>
      </div>
      <a href="{{ route('klien.index') }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div> --}}

{{--   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>{{ $jmlProyek }}</h3>
        <p>Proyek</p>
      </div>
      <div class="icon">
        <i class="fa fa-check-square-o"></i>
      </div>
      <a href="{{ route('proyek.index') }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div> --}}

{{--   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3>{{ $jmlTugas }}</h3>
        <p>Tugas</p>
      </div>
      <div class="icon">
        <i class="fa fa-circle-o"></i>
      </div>
      <a href="{{ route('tugas.index') }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div> --}}

  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-teal">
      <div class="inner">
        <h3>{{ $jmlProg }}</h3>
        <p>Progres Kerja Harian</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
      <a href="{{ Auth::user()->role != 'finance' ? route('progress-kerja-harian.index') : '#' }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  {{-- <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ $jmlUser }}</h3>
        <p>User</p>
      </div>
      <div class="icon">
        <i class="fa fa-user"></i>
      </div>
      <a href="{{ route('uam.index') }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div> --}}

{{--   <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-purple">
      <div class="inner">
        <h3>{{ $jmlKat }}</h3>
        <p>Kategori Pengeluaran</p>
      </div>
      <div class="icon">
        <i class="fa fa-cubes"></i>
      </div>
      <a href="{{ Auth::user()->role === 'superadmin' ? route('kategori.index') : '#' }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div> --}}

  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-purple">
      <div class="inner">
        <h3>{{ $jmlInvoice }}</h3>
        <p>Invoice</p>
      </div>
      <div class="icon">
        <i class="fa fa-print"></i>
      </div>
      <a href="{{ Auth::user()->role === 'superadmin' || Auth::user()->role === 'finance' ? route('invoice.by-waktu') : '#' }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-maroon">
      <div class="inner">
        <h3>{{ $jmlPengeluaran }}</h3>
        <p>Tambah Pengeluaran</p>
      </div>
      <div class="icon">
        <i class="fa fa-paypal"></i>
      </div>
      <a href="{{ route('pengeluaran.create') }}" class="small-box-footer">
        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>