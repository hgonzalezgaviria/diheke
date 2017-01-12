@extends('layout')

@section('head')
	{!! Html::style('assets/css/bootstrap.vertical-tabs.css') !!}
	{!! Html::style('assets/css/hover-zoom.css') !!}
@endsection

@section('scripts')
@endsection

@section('content')
<h1 class="page-header">Inicio</h1>

<div class="col-xs-2"><h3>Sedes</h3>
	<ul class="nav nav-tabs tabs-left">
		@foreach($sedes as $sede)
		<li><a href="#Sede{{$sede->SEDE_ID}}" data-toggle="tab">{{$sede->SEDE_DESCRIPCION}}</a></li>
		@endforeach
	</ul>
</div>

<div class="col-xs-9">
	<div class="tab-content">
<h3>Salas</h3>
		@foreach($sedes as $sede)
		<div class="tab-pane fade" id="Sede{{$sede->SEDE_ID}}">
			@foreach($salas as $sala)
				@if($sala->SEDE_ID == $sede->SEDE_ID)
				{{-- <a href="{{ url('reservas/show?sede='.$sala->SEDE_ID.'&sala='.$sala->SALA_ID) }}"> --}}
				<div class="col-md-4 zoom-in-hover">
					<div class="panel panel-default">
						<div class="panel-heading">Sala {{$sala->SALA_ID}} en Sede {{$sala->SEDE_ID}}</div>
						<div class="panel-body">
							{{$sala->SALA_DESCRIPCION}}<br>
							Cantidad de equipos: {{$sala->SALA_CAPACIDAD}}<br>
							Equipos disponibles: {{$sala->equiposDisp()}}<br>
							{{ Form::open( ['url' => 'reservas/show', 'method' => 'get', 'class'=>'form-vertical' ]  ) }}

								{{ Form::hidden('sala', $sala->SALA_ID) }}
								<div class="row">
									<div class="col-xs-6">
										<div class="input-group">
											{{ Form::label('equipo', 'Equipo', [ 'class'=>'form-control' ]) }}
											<span class="input-group-addon">
												<input type="radio"
													title="Requerido!" 
													value="1"
													name="equipo"
													class="">
											</span>
										</div>
									</div>

									<div class="col-xs-6">
										<div class="input-group">
											{{ Form::label('equipo', 'Sala', [ 'class'=>'form-control' ]) }}
											<span class="input-group-addon">
												<input type="radio"
													value="0"
													name="equipo"
													class="">
											</span>
										</div>
									</div>
								</div>

								{{ Form::button('<i class="fa fa-ticket" aria-hidden="true"></i> Reservar', [ 'class'=>'btn btn-primary', 'type'=>'submit' ]) }}

							{{ Form::close() }}
						</div>
					</div>
				</div>
				{{-- </a> --}}
				@endif
			@endforeach
		</div>
		@endforeach
	</div>
	  <!-- /tabs -->
	  
</div>

@endsection
