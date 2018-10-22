<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$title?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/font-awesome/4.5.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/ionicons/2.0.1/css/ionicons.min.css') }}">
	@stack('css')
	<link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		@include('header')
		@include('leftbar')

		<div class="content-wrapper">
			@include('page_header')
			<section class="content">
				<div class="row">
					@include('success_msg')
					<div class="col-xs-12">
						@yield('box')
					</div>
				</div>
			</section>
		</div>

		@include('footer')
		@include('sidebar')

	</div>
	<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
	@stack('js')
	<script src="{{ asset('dist/js/app.min.js') }}"></script>
	<script src="{{ asset('dist/js/demo.js') }}"></script>
	@stack('script')
</body>
</html>
