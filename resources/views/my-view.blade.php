@include('table.atas')
<div class="content-wrapper">
  @include('page_header')
  <section class="content">
    <div class="row">
      @include('success_msg')
      <div class="col-xs-12">
        @yield('other-box')
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            @isset($role)
            @if(is_array($role) && in_array(Auth::user()->role, $role))
            @include('tambah_button', ['link'  => $createLink])
            @elseif($role == Auth::user()->role)
            @include('tambah_button', ['link'  => $createLink])
            @endif
            @else
            @include('tambah_button', ['link'  => $createLink])
            @endisset
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table id="dt" class="table table-bordered table-striped">
                @yield('table')
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<form action="" id="form-hapus" method="post">
  @method('delete')
  @csrf
</form>
<script>
  function hapus(link, e){
    e.preventDefault();
    if(confirm('Anda yakin ? ')){
      var f = document.getElementById('form-hapus');
      f.action = link;
      f.submit();
    }
  }
</script>
@include('table.bawah')