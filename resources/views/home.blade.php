@extends('layout')

@section('head')
	{!! Html::style('assets/css/bootstrap.vertical-tabs.css') !!}
	{!! Html::style('assets/css/hover-zoom.css') !!}
@endsection

@section('scripts')
	<script>
	</script>
@endsection

@section('content')
<h1 class="page-header">Inicio</h1>

<div class="col-xs-2"><h3>Sedes</h3>
	<ul class="nav nav-tabs tabs-left">
		@foreach($sedes as $sede)
		<li><a href="#Sede{{$sede->ESFI_ID}}" data-toggle="tab">{{$sede->ESFI_DESCRIPCION}}</a></li>
		@endforeach
	</ul>
</div>

<div class="col-xs-9">
	<div class="tab-content">
<h3>Salas</h3>
		@foreach($sedes as $sede)
		<div class="tab-pane" id="Sede{{$sede->ESFI_ID}}">
			@foreach($salas as $sala)
			@if($sala->ESFI_ID == $sede->ESFI_ID)
			<a href="{{ url('reservas/show?sede='.$sala->ESFI_ID.'&sala='.$sala->REFI_ID) }}">
			<div class="col-md-4 zoom-in-hover">
				<div class="panel panel-default">
					<div class="panel-heading">Sala {{$sala->REFI_ID}} en Sede {{$sala->ESFI_ID}}</div>
					<div class="panel-body">
						{{$sala->REFI_DESCRIPCION}}<br>
						Cantidad de equipos: {{$sala->REFI_CAPACIDADREAL}}<br>
						Disponible: {{$sala->REFI_PRESTABLE ? 'SI' : 'NO'}}<br>
					</div>
				</div>
			</div>
			</a>
			@endif
			@endforeach
		</div>
		@endforeach
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
