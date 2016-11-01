@extends('index')
@section('title', '/ Pregunta / Editar '. $pregunta->id )

@section('head')
    {!! Html::script('assets/js/angular/angular.min.js') !!}
    {!! Html::script('assets/js/angular/angular-animate.js') !!}
@endsection

@section('scripts')
<script>
    var appEva360 = angular.module('appEva360', ['ngAnimate'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    appEva360.controller('PreguntasCtrl', ['$scope', function($scope){
		$scope.tipos_preg = {!! json_encode(Config::get('enums.preg_tipos2')) !!}
		$scope.selectedPregTipo = $scope.tipos_preg[{{ $pregunta->preg_tipo_id }} - 1].id;
    }]);
    
    appEva360.controller('PregEleccionUnicaCtrl', ['$scope', function($scope){
        $scope.pregOpciones = {!! $pregunta->pregItems !!};
        $scope.cantOpciones = ($scope.pregOpciones.length > 0) ? $scope.pregOpciones.length : 1;
        $scope.index = 0;

        $scope.getIndex = function (index) {
            return pregOpciones[index].id == null ? index+1 : pregOpciones[index].id;
        };

    }]);
</script>
@endsection

@section('content')

	<h1 class="page-header">Editar Pregunta # {{ $pregunta->id }} en Reserva # {{ $pregunta->reserva->id }} </h1>
	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all()) }}

    <div ng-app="appEva360" ng-controller="PreguntasCtrl">
    
	{{ Form::model($pregunta, array('action' => array('PreguntaController@update', $pregunta->reserva->id, $pregunta->id), 'method' => 'PUT', 'class' => 'form-horizontal')) }}

		<div class="form-group">
			{{ Form::label('texto', 'Texto') }}
			{{ Form::text('texto', old('texto'), array('class' => 'form-control')) }}
		</div>
	    <div class="form-group">
	        {{ Form::label('preg_tipo_id', 'Tipo Pregunta:') }}
			<select class="form-control" ng-model="selectedPregTipo" id="preg_tipo_id" name="preg_tipo_id">
				<option value="<% tipo.id %>" ng-repeat="(key, tipo) in tipos_preg"><% tipo.value %></option>
			</select>
	    </div>
	    
		<div class="animate-switch-container" ng-switch on="selectedPregTipo">
			<div class="animate-switch" ng-switch-when="1" >
				@include('preguntas/preg_abierta')
			</div>
			<div class="animate-switch" ng-switch-when="2">
				@include('preguntas/preg_escala')
			</div>
			<div class="animate-switch" ng-switch-when="3">
				@include('preguntas/preg_eleccion_unica')
			</div>
			<div class="animate-switch" ng-switch-when="4">
				@include('preguntas/preg_booleana')
			</div>
			<div class="animate-switch" ng-switch-default>Nonas...</div>
		</div>

	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('reservas/'.$pregunta->reserva->id ) }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div><!-- End ng-controller -->

@endsection