<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p class="text-capitalize">
          {{ Auth::user()->nama }}
          {{-- Belum Login --}}
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      {{-- <li @if($active == 'dasbor') class="active" @endif>
        <a href="{{ route('dasbor') }}">
          <i class="fa fa-dashboard"></i> <span>Dasbor</span>
        </a>
      </li> --}}
      <li class="treeview @if(in_array($active, ['akun.index','akun.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-group"></i>
          <span>Akun</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['akun.create'])) class="active" @endif>
            <a href="{{ route('akun.create') }}">@if(in_array($active, ['akun.create'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Tambah Akun</a>
          </li>
          <li @if(in_array($active, ['akun.index'])) class="active" @endif>
            <a href="{{ route('akun.index') }}">@if(in_array($active, ['akun.index'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Data Akun</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['jenis-beras.index','jenis-beras.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-cubes"></i>
          <span>Jenis Beras</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['jenis-beras.create'])) class="active" @endif>
            <a href="{{ route('jenis-beras.create') }}">@if(in_array($active, ['jenis-beras.create'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Tambah Jenis Beras</a>
          </li>
          <li @if(in_array($active, ['jenis-beras.index'])) class="active" @endif>
            <a href="{{ route('jenis-beras.index') }}">@if(in_array($active, ['jenis-beras.index'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Data Jenis Beras</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['gudang.index','gudang.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-university"></i>
          <span>Gudang</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['gudang.create'])) class="active" @endif>
            <a href="{{ route('gudang.create') }}">@if(in_array($active, ['gudang.create'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Tambah Gudang</a>
          </li>
          <li @if(in_array($active, ['gudang.index'])) class="active" @endif>
            <a href="{{ route('gudang.index') }}">@if(in_array($active, ['gudang.index'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Data Gudang</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['mitra-kerja.index','mitra-kerja.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-user-plus"></i>
          <span>Mitra Kerja</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['mitra-kerja.create'])) class="active" @endif>
            <a href="{{ route('mitra-kerja.create') }}">@if(in_array($active, ['mitra-kerja.create'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Tambah Mitra Kerja</a>
          </li>
          <li @if(in_array($active, ['mitra-kerja.index'])) class="active" @endif>
            <a href="{{ route('mitra-kerja.index') }}">@if(in_array($active, ['mitra-kerja.index'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Data Mitra Kerja</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['pengadaan.index','pengadaan.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-flash"></i>
          <span>Pengadaan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['pengadaan.create'])) class="active" @endif>
            <a href="{{ route('pengadaan.create') }}">@if(in_array($active, ['pengadaan.create'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Tambah Pengadaan</a>
          </li>
          <li @if(in_array($active, ['pengadaan.index'])) class="active" @endif>
            <a href="{{ route('pengadaan.index') }}">@if(in_array($active, ['pengadaan.index'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Data Pengadaan</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['penggilingan.index','penggilingan.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-cart-arrow-down"></i>
          <span>Penggilingan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['penggilingan.create'])) class="active" @endif>
            <a href="{{ route('penggilingan.create') }}">@if(in_array($active, ['penggilingan.create'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Tambah Penggilingan</a>
          </li>
          <li @if(in_array($active, ['penggilingan.index'])) class="active" @endif>
            <a href="{{ route('penggilingan.index') }}">@if(in_array($active, ['penggilingan.index'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Data Penggilingan</a>
          </li>
        </ul>
      </li>
      <li class="treeview @if(in_array($active, ['distribusi.index','distribusi.create'])) active @endif ">
        <a href="#">
          <i class="fa fa-rocket"></i>
          <span>Distribusi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li @if(in_array($active, ['distribusi.create'])) class="active" @endif>
            <a href="{{ route('distribusi.create') }}">@if(in_array($active, ['distribusi.create'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Tambah Distribusi</a>
          </li>
          <li @if(in_array($active, ['distribusi.index'])) class="active" @endif>
            <a href="{{ route('distribusi.index') }}">@if(in_array($active, ['distribusi.index'])) <i class="fa fa-check-circle-o"></i> @else <i class="fa fa-circle-o"></i> @endif Data Distribusi</a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
</aside>