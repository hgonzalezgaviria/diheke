@extends('layout')
@section('scripts')
    <script>
    </script>
@endsection

@section('content')
<h1 class="page-header">Inicio</h1>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Promo</div>

				<div class="panel-body">
					¡Bienvenido!<br>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<img src="{{ asset('assets/img/logo_redondo.jpg') }}" height="300">
		</div>
	</div>
</div>

@endsection
