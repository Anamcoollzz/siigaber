@php
$jmlPengadaan = \App\Pengadaan::count();
$jmlPenggilingan = \App\Penggilingan::count();
$jmlDistribusi = \App\Distribusi::count();
$jmlMitraKerja = \App\MitraKerja::count();
$totalPengadaan = \App\PengadaanKeGudang::sum('jumlah');
$totalPenggilingan = \App\PenggilinganDetail::sum('jumlah');
$totalDistribusi = \App\DistribusiDetail::sum('jumlah');
@endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dasbor SIIGABER</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
   <!-- iCheck -->
   <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
   <!-- Morris chart -->
   <link rel="stylesheet" href="plugins/morris/morris.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    @include('header')
    @include('leftbar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dasbor
          <small>Panel Kontrol</small>
        </h1>
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>{{$jmlPengadaan}}</h3>

                <p>Pengadaan</p>
              </div>
              <div class="icon">
                <i class="fa fa-flash"></i>
              </div>
              <a href="{{ route('pengadaan.index') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{$jmlPenggilingan}}</h3>

                <p>Penggilingan</p>
              </div>
              <div class="icon">
                <i class="fa fa-cart-arrow-down"></i>
              </div>
              <a href="{{ route('penggilingan.index') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{$jmlDistribusi}}</h3>

                <p>Distribusi</p>
              </div>
              <div class="icon">
                <i class="fa fa-rocket"></i>
              </div>
              <a href="{{ route('distribusi.index') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{$jmlMitraKerja}}</h3>

                <p>Mitra Kerja</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-plus"></i>
              </div>
              <a href="{{ route('mitra-kerja.index') }}" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
              <!-- Tabs within a box -->
              <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#revenue-chart" data-toggle="tab">Rincian</a></li>
                <li><a href="#sales-chart" data-toggle="tab">Perbandingan</a></li>
                <li class="pull-left header"><i class="fa fa-inbox"></i> Statistika</li>
              </ul>
              <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
              </div>
            </div>
            <!-- /.nav-tabs-custom -->

          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Calendar -->
            <div class="box box-solid bg-green-gradient">
              <div class="box-header">
                <i class="fa fa-calendar"></i>

                <h3 class="box-title">Calendar</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                  <!-- button with a dropdown -->
                  {{-- <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bars"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                      <li><a href="#">Add new event</a></li>
                      <li><a href="#">Clear events</a></li>
                      <li class="divider"></li>
                      <li><a href="#">View calendar</a></li>
                    </ul>
                  </div> --}}
                  <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.box-body -->
              {{-- <div class="box-footer text-black">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- Progress bars -->
                    <div class="clearfix">
                      <span class="pull-left">Task #1</span>
                      <small class="pull-right">90%</small>
                    </div>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                    </div>

                    <div class="clearfix">
                      <span class="pull-left">Task #2</span>
                      <small class="pull-right">70%</small>
                    </div>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <div class="clearfix">
                      <span class="pull-left">Task #3</span>
                      <small class="pull-right">60%</small>
                    </div>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                    </div>

                    <div class="clearfix">
                      <span class="pull-left">Task #4</span>
                      <small class="pull-right">40%</small>
                    </div>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div> --}}
            </div>
            <!-- /.box -->

          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('footer')
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <!-- jQuery 2.2.3 -->
 <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="plugins/jQueryUI/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
{{-- <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
{{-- <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
{{-- <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="plugins/knob/jquery.knob.js"></script> --}}
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
{{-- <script src="plugins/daterangepicker/daterangepicker.js"></script> --}}
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
{{-- <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> --}}
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>

<script>

  var AdminLTEOptions =

  {
  //Add slimscroll to navbar menus
  //This requires you to load the slimscroll plugin
  //in every page before app.js
  navbarMenuSlimscroll: true,
  navbarMenuSlimscrollWidth: "3px", //The width of the scroll bar
  navbarMenuHeight: "200px", //The height of the inner menu
  //General animation speed for JS animated elements such as box collapse/expand and
  //sidebar treeview slide up/down. This options accepts an integer as milliseconds,
  //'fast', 'normal', or 'slow'
  animationSpeed: 500,
  //Sidebar push menu toggle button selector
  sidebarToggleSelector: "[data-toggle='offcanvas']",
  //Activate sidebar push menu
  sidebarPushMenu: true,
  //Activate sidebar slimscroll if the fixed layout is set (requires SlimScroll Plugin)
  sidebarSlimScroll: true,
  //Enable sidebar expand on hover effect for sidebar mini
  //This option is forced to true if both the fixed layout and sidebar mini
  //are used together
  sidebarExpandOnHover: false,
  //BoxRefresh Plugin
  enableBoxRefresh: true,
  //Bootstrap.js tooltip
  enableBSToppltip: true,
  BSTooltipSelector: "[data-toggle='tooltip']",
  //Enable Fast Click. Fastclick.js creates a more
  //native touch experience with touch devices. If you
  //choose to enable the plugin, make sure you load the script
  //before AdminLTE's app.js
  enableFastclick: true,
  //Control Sidebar Tree Views
  enableControlTreeView: true,
  //Control Sidebar Options
  enableControlSidebar: true,
  controlSidebarOptions: {
    //Which button should trigger the open/close event
    toggleBtnSelector: "[data-toggle='control-sidebar']",
    //The sidebar selector
    selector: ".control-sidebar",
    //Enable slide over content
    slide: true
  },
  //Box Widget Plugin. Enable this plugin
  //to allow boxes to be collapsed and/or removed
  enableBoxWidget: true,
  //Box Widget plugin options
  boxWidgetOptions: {
    boxWidgetIcons: {
      //Collapse icon
      collapse: 'fa-minus',
      //Open icon
      open: 'fa-plus',
      //Remove icon
      remove: 'fa-times'
    },
    boxWidgetSelectors: {
      //Remove button selector
      remove: '[data-widget="remove"]',
      //Collapse button selector
      collapse: '[data-widget="collapse"]'
    }
  },
  //Direct Chat plugin options
  directChat: {
    //Enable direct chat by default
    enable: true,
    //The button to open and close the chat contacts pane
    contactToggleSelector: '[data-widget="chat-pane-toggle"]'
  },
  //Define the set of colors to use globally around the website
  colors: {
    lightBlue: "#3c8dbc",
    red: "#f56954",
    green: "#00a65a",
    aqua: "#00c0ef",
    yellow: "#f39c12",
    blue: "#0073b7",
    navy: "#001F3F",
    teal: "#39CCCC",
    olive: "#3D9970",
    lime: "#01FF70",
    orange: "#FF851B",
    fuchsia: "#F012BE",
    purple: "#8E24AA",
    maroon: "#D81B60",
    black: "#222222",
    gray: "#d2d6de"
  },
  //The standard screen sizes that bootstrap uses.
  //If you change these in the variables.less file, change
  //them here too.
  screenSizes: {
    xs: 480,
    sm: 768,
    md: 992,
    lg: 1200
  }
};

</script>

<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
{{-- <script src="dist/js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script>
  $(function () {

    "use strict";

    @php
    $pengadaan = DB::table('pengadaan')
    ->join('pengadaan_ke_gudang', 'pengadaan_ke_gudang.id_pengadaan', '=', 'pengadaan.id')
    ->groupBy(DB::raw('month(tanggal)'))
    ->select(DB::raw('*, month(tanggal) as bulan, sum(jumlah) as total'))
    ->get();
    $penggilingan = DB::table('penggilingan')
    ->join('detail_penggilingan', 'detail_penggilingan.id_penggilingan', '=', 'penggilingan.id')
    ->groupBy(DB::raw('month(tanggal_mulai)'))
    ->select(DB::raw('*, month(tanggal_mulai) as bulan, sum(jumlah) as total'))
    ->get();
    $distribusi = DB::table('distribusi')
    ->join('detail_distribusi', 'detail_distribusi.id_distribusi', '=', 'distribusi.id')
    ->groupBy(DB::raw('month(tanggal_mulai)'))
    ->select(DB::raw('*, month(tanggal_mulai) as bulan, sum(jumlah) as total'))
    ->get();
    @endphp

    //BAR CHART
    var bar = new Morris.Bar({
      element: 'revenue-chart',
      resize: true,
      data: [
      @foreach (range(1,12) as $bln)
      {
        y: '{{namaBulan($bln)}}', 
        a : {{count($pengadaan->where('bulan',$bln))>0?$pengadaan->where('bulan',$bln)->first()->total:0}},
        b: {{count($penggilingan->where('bulan',$bln))>0?$penggilingan->where('bulan',$bln)->first()->total:0}}, 
        c: {{count($distribusi->where('bulan',$bln))>0?$distribusi->where('bulan',$bln)->first()->total:0}},
      },

      @endforeach
      ],
      barColors: ['#00a65a', '#f56954', '#5BC902'],
      xkey: 'y',
      ykeys: ['a', 'b', 'c'],
      labels: ['Pengadaan', 'Penggilingan', 'Distribusi'],
      hideHover: 'auto'
    });

    var donut = new Morris.Donut({
      element: 'sales-chart',
      resize: true,
      colors: ["#3c8dbc", "#f56954", "#00a65a"],
      data: [
      {label: "Pengadaan", value: {{$totalPengadaan}} },
      {label: "Penggilingan", value: {{$totalPenggilingan}} },
      {label: "Distribusi", value: {{$totalDistribusi}} }
      ],
      hideHover: 'auto'
    });

    $('.box ul.nav a').on('shown.bs.tab', function () {
      // area.redraw();
      donut.redraw();
      // line.redraw();
    });

    $("#calendar").datepicker();
  });
</script>
{{-- <script src="dist/js/pages/dashboard.js"></script> --}}
</body>
</html>
