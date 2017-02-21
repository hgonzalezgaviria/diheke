@extends('layout')
@section('title', '/ Editar Estado')
@section('scripts')
    <script>
    </script>
@endsection

@section('content')

	<h1 class="page-header">Actualizar Estados</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::model($estado, array('action' => array('EstadosController@update', $estado->ESTA_ID,), 'method' => 'PUT', 'class' => 'form-vertical')) }}

	  	<div class="form-group">
			{{ Form::label('ESTA_DESCRIPCION', 'Descripción') }} 
			{{ Form::text('ESTA_DESCRIPCION', old('ESTA_DESCRIPCION'), array('class' => 'form-control', 'required')) }}
		</div>


		<div class="form-group">
			{{ Form::label('TIES_ID', 'Tipo Estados') }} 
			{{ Form::select('TIES_ID', [null => 'Seleccione un Tipo Estados...'] + $arrTipoEstados , old('TIES_ID'), ['class' => 'form-control', 'required']) }}
		</div>

	  

	    <div id="btn-form" class="text-right">
	    	{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
	        <a class="btn btn-warning" role="button" href="{{ URL::to('estados' ) }}">
	            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
	        </a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
	    </div>

	{{ Form::close() }}
    </div><!-- End ng-controller -->

@endsection