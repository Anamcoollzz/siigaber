<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p class="text-capitalize">
          {{-- {{ Auth::user()->nama_lengkap }} --}}
          Belum Login
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
            <a href="{{ route('akun.create') }}"><i class="fa fa-circle-o"></i> Tambah Akun</a>
          </li>
          <li @if(in_array($active, ['akun.index'])) class="active" @endif>
            <a href="{{ route('akun.index') }}"><i class="fa fa-circle-o"></i> Data Akun</a>
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
            <a href="{{ route('jenis-beras.create') }}"><i class="fa fa-circle-o"></i> Tambah Jenis Beras</a>
          </li>
          <li @if(in_array($active, ['jenis-beras.index'])) class="active" @endif>
            <a href="{{ route('jenis-beras.index') }}"><i class="fa fa-circle-o"></i> Data Jenis Beras</a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
</aside>