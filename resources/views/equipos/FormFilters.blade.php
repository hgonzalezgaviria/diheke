@section('head')
	<style>
		/* Define el tamaño de los input-group-addon para que sean todos iguales */
		.input-group-addon {
			min-width:100px;
			text-align:left;
		}
	</style>
@parent
@endsection



<!-- Filtrar datos en vista -->
<div id="frm-find" class="col-xs-3 col-md-9 col-lg-9">
	<a class='btn btn-primary' role='button' data-toggle="collapse" data-target="#filters" href="#">
		<i class="fa fa-filter" aria-hidden="true"></i> 
		<span class="hidden-xs">Filtrar resultados</span>
		<span class="sr-only">Filtrar</span>
	</a>
</div>


<div id="filters" class="collapse">
	<div class="form-group col-xs-12 col-md-8">
	<form>
		<div class="input-group has-feedback">
			<div class="input-group-addon control-label">Sede</div>
			<input type="text"
				class="form-control"
				id= "SEDE_ID"
				placeholder="Por título..."
			>
			
		</div>

		<div class="input-group">
			<div class="input-group-addon">Salas</div>
			
			{{ Form::select('SALA_ID', [null => 'Seleccione una sala...'] + $arrSalas , old('SALA_ID'), [
				'id'=>'SALA_ID',
				'class' => 'form-control', 
				'required'
			]) }}
		</div>

				
	</form>
	</div>
</div>



