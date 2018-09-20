@include('table.atas')
<div class="content-wrapper">
  @include('page_header')
  <section class="content">
    <div class="row">
      @include('success_msg')
      <div class="col-xs-12">
        @yield('other-box')
      </div>
    </div>
  </section>
</div>
@include('table.bawah')