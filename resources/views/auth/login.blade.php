@extends('layout')

@section('content')
<h1 class="page-header"></h1>
<div class="jumbotron">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					{{ Form::open( [ 'url'=>'login' , 'role'=>'form', 'class'=>'form-vertical' ] ) }}

						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label for="username" class="control-label">Usuario</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
							</div>
							@if ($errors->has('username'))
								<span class="help-block">
									<strong>{{ $errors->first('username') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password" class="control-label">Contraseña</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-key"></i></span>
								<input id="password" name="password" type="password" class="form-control" autocomplete="off" max="30">
							</div>
							@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<div class="col-md-offset-1">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Recordarme
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-offset-1">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-sign-in"></i> Iniciar sesión
								</button>

								<a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidó su contraseña?</a>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
