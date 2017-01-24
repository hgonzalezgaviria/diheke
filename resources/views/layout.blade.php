<!DOCTYPE html>
<html>
	<head>
		<title>Reservas @yield('title')</title>
		{!! Html::meta( null, 'IE=edge', [ 'http-equiv'=>'X-UA-Compatible' ] ) !!}
		{!! Html::meta( null, 'text/html; charset=utf-8', [ 'http-equiv'=>'Content-Type' ] ) !!}
		{!! Html::meta( 'viewport', 'width=device-width, initial-scale=1') !!}

		{!! Html::favicon('favicon.ico') !!}
		
		{!! Html::style('assets/js/jquery-ui/jquery-ui.min.css') !!}
		{{--{!! Html::style('assets/css/jquery.dataTables.min.css') !!}--}}
		{!! Html::style('assets/css/datatable/buttons.dataTables.min.css') !!}
		{{--{!! Html::style('assets/css/datatable/dataTables.bootstrap.min.css') !!}--}}
		{{--{!! Html::style('assets/css/datatable/buttons.bootstrap.min.css') !!}--}}
		{!! Html::style('assets/css/datatable/responsive.dataTables.min.css') !!}
		{!! Html::style('assets/css/datatable/buttons.bootstrap4.min.css') !!}
		{!! Html::style('assets/css/datatable/dataTables.bootstrap4.min.css') !!}
		{!! Html::style('assets/css/datatable/rowReorder.dataTables.min.css') !!}
		{!! Html::style('assets/css/datatable/responsive.bootstrap.min.css') !!}
		{!! Html::style('assets/css/fullcalendar.css') !!}
		{!! Html::style('assets/css/msgBoxLight.css') !!}
		{!! Html::style('assets/css/bootstrap.min.css') !!}
		{!! Html::style('assets/css/font-awesome.min.css') !!}
		{!! Html::style('assets/css/bootstrap-theme.min.css') !!}
		{!! Html::style('assets/css/dropdown-menu.css') !!}
		{!! Html::style('assets/css/style.css') !!}
		{!! Html::style('assets/css/styleon_off.css') !!}
		{!! Html::style('assets/css/bootstrap-toggle.min.css') !!}

		{!! Html::style('assets/css/bootstrap-datetimepicker.min.css') !!}
		<style>
			.page-header{
				margin-top:10px;
			}
		</style>
		<!-- Fonts 
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->
		@yield('head')
	</head>
	<body>

		@include('partials/menu')

		<!--
		<div class="container" style="padding-top:60px;padding-left:50px;padding-right:50px;">
		-->
		<div class="container" style="padding-top:60px;">

			<!-- Utilizado para mostrar cualquier mensaje -->
			@include('partials/messages')

			<!-- Contenido cargado desde el blade -->
			@yield('content')
		</div>

		<!-- Scripts -->
		{{--{!! Html::script('assets/js/jquery-1.11.2.min.js') !!}--}}
		{!! Html::script('assets/js/datatable/jquery-1.12.4.js') !!}
		{!! Html::script('assets/js/jquery-2.0.0.min.js') !!}
		{!! Html::script('assets/js/jquery-ui.min.js') !!}
		{!! Html::script('assets/js/moment.min.js') !!}
		{!! Html::script('assets/js/fullcalendar.js') !!}
		{!! Html::script('assets/js/es.js') !!}
		{!! Html::script('assets/js/bootstrap.min.js') !!}

		{!! Html::script('assets/js/datatable/jquery.dataTables.min.js') !!}
		{!! Html::script('assets/js/datatable/dataTables.buttons.min.js') !!}
		{!! Html::script('assets/js/datatable/jszip.min.js') !!}
		{!! Html::script('assets/js/datatable/pdfmake.min.js') !!}
		{!! Html::script('assets/js/datatable/vfs_fonts.js') !!}
		{!! Html::script('assets/js/datatable/buttons.html5.min.js') !!}
		{!! Html::script('assets/js/jquery.msgBox.js') !!}

		{!! Html::script('assets/js/bootstrap-datetimepicker.js') !!}
		{{--{!! Html::script('assets/js/datatable/dataTables.bootstrap.min.js') !!}--}}
		{!! Html::script('assets/js/datatable/buttons.colVis.min.js') !!}
		{!! Html::script('assets/js/datatable/buttons.print.min.js') !!}
		{!! Html::script('assets/js/datatable/dataTables.responsive.min.js') !!}
		{!! Html::script('assets/js/datatable/buttons.flash.min.js') !!}
		{!! Html::script('assets/js/datatable/buttons.bootstrap4.min.js') !!}
		{!! Html::script('assets/js/datatable/dataTables.bootstrap4.min.js') !!}
		{!! Html::script('assets/js/datatable/dataTables.rowReorder.min.js') !!}
		{!! Html::script('assets/js/datatable/responsive.bootstrap.min.js') !!}
		{!! Html::script('assets/js/bootstrap-toggle.min.js') !!}
		@yield('scripts')
	</body>
</html>