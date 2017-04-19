<!DOCTYPE html>
<html>
	<head>
		<title>Reservas @yield('title')</title>
		{!! Html::meta( null, 'IE=edge', [ 'http-equiv'=>'X-UA-Compatible' ] ) !!}
		{!! Html::meta( null, 'text/html; charset=utf-8', [ 'http-equiv'=>'Content-Type' ] ) !!}
		{!! Html::meta( 'viewport', 'width=device-width, initial-scale=1') !!}

		{!! Html::favicon('favicon.ico') !!}
		{{-- Automatic page load progress bar --}}
		{!! Html::script('assets/js/pace/pace.min.js') !!}
		{!! Html::style('assets/js/pace/pace-theme-flash.css') !!}
		
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
		{!! Html::style('assets/css/bootstrap-colorpicker.min.css') !!}

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
			{!! Html::script('assets/js/IE9/html5shiv.min.js') !!}
			{!! Html::script('assets/js/IE9/respond.min.js') !!}
	    <![endif]-->
	    
		<style>
			.container{padding: 60px 10px 20px;}
			.page-header{margin-top:10px;}
			.jumbotron{padding:10px 20px !important;}

			/*Tamaño de checkbox mas grande.*/
			.form-check-input {
				width: 15px;
				height: 15px;
				margin-top: 2px !important;
			}
			.radio-inline+.radio-inline {margin-left: 0;}
			.radio-inline {margin-right: 10px;}

			/*Modal centrado en pantallas xs.*/
			@media screen and (min-width: 768px) { 
			  .modal:before {
				display: inline-block;
				vertical-align: middle;
				content: " ";
				height: 100%;
			  }
			}
			.modal {text-align: center;}
			.modal-dialog {
			  display: inline-block;
			  text-align: left;
			  vertical-align: middle;
			}

			.fa-2x, .fa-3x{
				vertical-align: middle;
			}

			/*Alerta flotante a la derecha.*/
			.alertas {
			    position: absolute;
			    max-height: 500px;
			    max-width: 600px;
			    bottom : 20px;
			    right: 20px;
			    z-index: 999;
			}
			.alertas>.alert{
				width: 300px;
				margin-bottom: 5px;
			}

			/*Sombra en botones*/
			.btn-danger, .btn-default, .btn-info, .btn-primary, .btn-success, .btn-warning {
				-webkit-box-shadow: 4px 3px 3px 0px rgba(0, 0, 0, 0.25), inset 1px 1px 1px 1px rgba(255, 255, 255, 0.25);
				-moz-box-shadow: 4px 3px 3px 0px rgba(0, 0, 0, 0.25), inset 1px 1px 1px 1px rgba(255, 255, 255, 0.25);
				box-shadow: 4px 3px 3px 0px rgba(0, 0, 0, 0.25), inset 1px 1px 1px 1px rgba(255, 255, 255, 0.25);
			}
			/*.btn:active{
				box-shadow: inset 0px 0px 6px 2px rgba(0,0,0, .4), inset 0px 0px 6px 2px rgba(0,0,0, .4);
			}*/
		</style>
		<!-- Fonts 
		<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->
		@yield('head')
	</head>
	<body>

		@include('partials/menu')

		<div class="container">
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
		<script type="text/javascript">
			$('#msgModalProcessing').modal('show');
		</script>
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
		{!! Html::script('assets/js/bootstrap-colorpicker.js') !!}
		
		@yield('scripts')
	</body>
</html>