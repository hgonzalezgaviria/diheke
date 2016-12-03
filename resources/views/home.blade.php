@extends('layout')

@section('head')
	{{-- Html::style('assets/css/bootstrap-nav-tabs.css') --}}
	{!! Html::style('assets/css/bootstrap.vertical-tabs.css') !!}
	{!! Html::style('assets/css/hover-zoom.css') !!}
@endsection

@section('scripts')
    <script>
    </script>
@endsection

@section('content')
<h1 class="page-header">Inicio</h1>

<div class="col-xs-3"><h3>Sedes</h3>
  <!-- tabs left -->
	<ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
      <li><a href="#a" data-toggle="tab">Sede 1</a></li>
      <li><a href="#b" data-toggle="tab">Sede 2</a></li>
      <li><a href="#c" data-toggle="tab">Sede 3</a></li>
    </ul>
</div>

<div class="col-xs-9">
    <div class="tab-content">
<h3>Salas</h3>
        <div class="tab-pane" id="a">
         	@for($i=0; $i<5; $i++)
         	<a href="#">
			<div class="col-md-4 zoom-in-hover">
				<div class="panel panel-default">
					<div class="panel-heading">Sede 1 Sala {{$i}}</div>
					<div class="panel-body">
						Cantidad de equipos: XXX<br>
						Disponible: XXX<br>
					</div>
				</div>
			</div>
			</a>
			@endfor
        </div>

        <div class="tab-pane" id="b">
         	@for($i=0; $i<6; $i++)
         	<a href="#" >
			<div class="col-md-4 zoom-in-hover">
				<div class="panel panel-default">
					<div class="panel-heading">Sede 2 Sala {{$i}}</div>
					<div class="panel-body">
						Cantidad de equipos: XXX<br>
						Disponible: XXX<br>
					</div>
				</div>
		 	</div>
			</a>
			@endfor
        </div>

        <div class="tab-pane" id="c">
         	@for($i=0; $i<2; $i++)
         	<a href="#" >
			<div class="col-md-4 zoom-in-hover">
				<div class="panel panel-default">
					<div class="panel-heading">Sede 3 Sala {{$i}}</div>
					<div class="panel-body">
						Cantidad de equipos: XXX<br>
						Disponible: XXX<br>
					</div>
				</div>
			</div>
			</a>
			@endfor
		</div>

    </div>
      <!-- /tabs -->
      
</div>

{{-- <div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Sistema de Reservas de Salas y Equipos - UNIAJC</div>

				<div class="panel-body">
					¡Bienvenido!<br>
					<canvas id="cbar" width="350" height="220"></canvas>
				</div>
			</div>
		</div>
	</div>
</div> --}}
@endsection
