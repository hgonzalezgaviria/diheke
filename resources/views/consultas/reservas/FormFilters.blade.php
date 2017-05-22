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
				id= "COD_ID"
				placeholder="Descripción..."
			>
			
		</div>

		<div class='input-group date' id='fechaInicio'>
			{{ Form::text('fechaInicio', old('fechaInicio'), [ 'class'=>
			'form-control', 'placeholder'=>'Fecha inicio...' ]) }}
			<span class="input-group-addon">
				<span class="fa fa-calendar"></span>
			</span>
		</div>

		<div class='input-group date' id='fechaFin'>
			{{ Form::text('fechaFin', old('fechaFin'), [ 'class'=>
			'form-control', 'placeholder'=>'Fecha fin...' ]) }}
			<span class="input-group-addon">
				<span class="fa fa-calendar"></span>
			</span>
		</div>

	{{ Form::close() }}
	</div>
</div>

@section('scripts')

<script type="text/javascript">

		//Vigencia
		$('.date').datetimepicker({
			locale: 'es',
			stepping: 5,
			//inline: true,
			format: 'DD/MM/YYYY hh:mm A',
			//extraFormats: [ 'YY/MM/DD HH:mm' ],
			useCurrent: false,  //Important! See issue #1075. Requerido para minDate
			//minDate: new Date()-(5*1000+1), //-5min Permite seleccionar el dia actual
			sideBySide: true,
			icons: {
				time: "fa fa-clock-o",
				date: "fa fa-calendar",
				up: "fa fa-arrow-up",
				down: "fa fa-arrow-down",
				previous: 'fa fa-chevron-left',
				next: 'fa fa-chevron-right',
				today: 'glyphicon glyphicon-screenshot',
				clear: 'fa fa-trash',
				close: 'fa fa-times'
			},
			tooltips: {
				//today: 'Go to today',
				//clear: 'Clear selection',
				//close: 'Close the picker',
				selectMonth: 'Seleccione Mes',
				prevMonth: 'Mes Anterior',
				nextMonth: 'Mes Siguiente',
				selectYear: 'Seleccione Año',
				prevYear: 'Año Anterior',
				nextYear: 'Año Siguiente',
				selectDecade: 'Seleccione Década',
				prevDecade: 'Década Anterior',
				nextDecade: 'Década Siguiente',
				prevCentury: 'Siglo Anterior',
				nextCentury: 'Siglo Siguiente'
			}
		});
</script>
@parent
@endsection