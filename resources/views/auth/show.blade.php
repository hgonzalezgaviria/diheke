@extends('layout')
@section('title', '/ '.$usuario->username )

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>{{ $usuario->username }}</strong></div>
				<div class="panel-body">

					  	<div class="form-group">
							{{ Form::label('name', 'Nombre', [ 'class' => 'col-md-4 control-label' ]) }}
							<div class="col-md-6">
								{{ Form::text('name', $usuario->name, [ 'class' => 'form-control', 'disabled' ]) }}
							</div>
						</div>

					  	<div class="form-group">
							{{ Form::label('username', 'Usuario', [ 'class' => 'col-md-4 control-label' ]) }}
							<div class="col-md-6">
								{{ Form::text('username', $usuario->username, [ 'class' => 'form-control', 'disabled' ]) }}
							</div>
						</div>


					  	<div class="form-group">
							{{ Form::label('email', 'E-mail', [ 'class' => 'col-md-4 control-label' ]) }}
							<div class="col-md-6">
								{{ Form::email('email', $usuario->email, [ 'class' => 'form-control', 'disabled' ]) }}
							</div>
						</div>


					  	<div class="form-group">
							{{ Form::label('role', 'Rol', [ 'class' => 'col-md-4 control-label' ]) }}
							<div class="col-md-6">
								{{ Form::text('role', $usuario->role, [ 'class' => 'form-control', 'disabled' ]) }}
							</div>
						</div>


						<!-- Botones -->
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4 text-right">

								<br>
						        <a class="btn btn-warning" role="button" href="{{ URL::to('usuarios/') }}">
						            <i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
						        </a>

							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
