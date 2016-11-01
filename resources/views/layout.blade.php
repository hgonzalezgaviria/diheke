<!DOCTYPE html>
<html>
	<head>
		<title>Reservas @yield('title')</title>
		{!! Html::style('assets/css/bootstrap.min.css') !!}
		{!! Html::style('assets/css/font-awesome.min.css') !!}
		{!! Html::style('assets/css/bootstrap-theme.min.css') !!}
		{!! Html::style('assets/js/jquery-ui/jquery-ui.min.css') !!}
		{!! Html::style('assets/css/style.css') !!}
		<style>
			.page-header{
				margin-top:10px;
			}
		</style>
		<!-- !! Html::favicon('favicon.ico') !!} -->
		<!-- Fonts 
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->
		@yield('head')
	</head>
	<body>

		@include('partials/menu')

		<!--
		<div class="container" style="padding-top:60px;padding-left:50px;padding-right:50px;">
		-->
		<div class="container" style="padding-top:40px;">

			<!-- Utilizado para mostrar cualquier mensaje -->
			@include('partials/messages')

			<!-- Contenido cargado desde el blade -->
			@yield('content')
		</div>

		<!-- Scripts -->
		{!! Html::script('assets/js/jquery-1.11.2.min.js') !!}
		{!! Html::script('assets/js/bootstrap.min.js') !!}
		@yield('scripts')
	</body>
</html>