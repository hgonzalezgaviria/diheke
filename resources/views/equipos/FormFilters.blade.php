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
		{{ Form::open(['id'=>'formFilter' , 'class' => 'form-vertical']) }}

			<div class="input-group">
			<div class="input-group-addon">Sedes</div>
			<select name="SEDE_ID" id="SEDE_ID" class="form-control" required >
				<option value="">Seleccione..</option>
	            @foreach($sedes as $sede)
	            <option value="{{ $sede->SEDE_ID }}">{{ $sede->SEDE_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>

	
			<div class="input-group">			
			<div class="input-group-addon">Salas</div>
			<select name="SALA_ID" id="SALA_ID" class="form-control" required >
				<option value="">Seleccione una sede..</option>
	            @foreach($salas as $sala)
	            <option value="{{ $sala->SALA_ID }}">{{ $sala->SALA_DESCRIPCION }}</option>
	            @endforeach
	        </select>
		</div>




		<div class="input-group has-feedback">
			<div class="input-group-addon control-label">Descripción</div>
			<input type="text"
				class="form-control"
				id= "DES_ID"
				placeholder="Por Descripción..."
			>
			
		</div>


				
	{{ Form::close() }}
	</div>
</div>



