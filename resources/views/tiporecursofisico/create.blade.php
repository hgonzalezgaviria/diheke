@extends('layout')
@section('title', '/ Crear contrato')

@section('scripts')
<script type="text/javascript">
    
</script>
@endsection

@section('content')

	<h1 class="page-header">Nuevo Tipo de Recurso Fisico</h1>

	@include('partials/errors')

	<!-- if there are creation errors, they will show here -->
	{{ Html::ul($errors->all() )}}

		{{ Form::open(array('url' => 'contratos', 'class' => 'form-horizontal')) }}

	  	<div class="form-group">
			{{ Form::label('tirf_descripcion', 'Descripción') }} 
			{{ Form::text('tirf_descripcion', old('tirf_descripcion'), array('class' => 'form-control', 'required')) }}
		</div>

		<div class="text-right">
			{{ Form::button('<i class="fa fa-exclamation" aria-hidden="true"></i> Reset', array('class'=>'btn btn-warning', 'type'=>'reset')) }}
			<a class="btn btn-warning" role="button" href="{{ URL::to('contratos') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
			{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', array('class'=>'btn btn-primary', 'type'=>'submit')) }}
		</div>

		
		{{ Form::close() }}
@endsection
