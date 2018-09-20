<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dasbor</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/4.5.0/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/ionicons/2.0.1/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('header')
    @include('leftbar')
    <div class="content-wrapper">
      <section class="content-header">
        <h1>Dasbor <small>Panel Kontrol</small></h1>
        <ol class="breadcrumb">
          <li>Dasbor</li>
        </ol>
      </section>
      <section class="content">
        @include('dasbor.index')
        @include('dasbor.kalender')
      </section>
    </div>
    @include('footer')
    @include('sidebar')
    <div class="control-sidebar-bg"></div>
  </div>

  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="plugins/jQueryUI/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
  <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
  <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>

  <script>
    $(function () {

      "use strict";
      $("#calendar").datepicker();

    });
  </script>
  <script src="dist/js/app.min.js"></script>
  <script src="dist/js/demo.js"></script>
</body>
</html>
