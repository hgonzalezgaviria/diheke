@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@parent
@endsection

@section('scripts')
	{{--Librería para manejo de Excel --}}
	{!! Html::script('assets/js/js-xlsx/shim.js') !!}
	{!! Html::script('assets/js/js-xlsx/xlsx.core.min.js') !!}

	<script type="text/javascript">
		//Carga archivo de excel y crea los usuarios
		var workbook = null;
		var rABS = false; // true: readAsBinaryString ; false: readAsArrayBuffer

		/* processing array buffers, only required for readAsArrayBuffer */
		function fixdata(data) {
		  var o = "", l = 0, w = 10240;
		  for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
		  o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
		  return o;
		}


		//Restaura el formulario para realizar una nueva carga.
		function resetForm() {
			$('#pregModalImport')
				.prop('tabindex', -1)
				.modal({backdrop: false, keyboard: true});
			$('#cargarExcel').prop('disabled', true);
			$('#cancelLoad').prop('disabled', false);
			$('#archivo').val('');
		}


		$('#archivo').on('click', function (e) {
			resetForm();
		});

		// Al seleccionar un archivo, lo carga en la variable global workbook.
		// Al terminar la carga, habilita el botón 'Cargar'.
		$('#archivo').on('change', function (e) {
			//e.preventDefault();
			//$('#cargarExcel').addClass('disabled');
			if ($('#archivo').val() != ''){
				var xlsFile = $('#archivo')[0].files[0];
				var reader = new FileReader();

				//Función al cargar el archivo
				reader.onload = function(e) {
				  var data = e.target.result;

				  if(rABS) {
					/* if binary string, read with type 'binary' */
					workbook = XLSX.read(data, {type: 'binary'});
				  } else {
					/* if array buffer, convert to base64 */
					var arr = fixdata(data);
					workbook = XLSX.read(btoa(arr), {type: 'base64'});
				  }

				  /* DO SOMETHING WITH workbook HERE */
				  $('#cargarExcel').prop('disabled', false);

				};

				if(rABS) reader.readAsBinaryString(xlsFile);
				else reader.readAsArrayBuffer(xlsFile);
			}
		});

		//Procesa el archivo previamente seleccionado y cargado. El botón solo estará habilitado si se ha cargado previamente un archivo. 
		$('#cargarExcel').on('click', function (e) {
			e.preventDefault();

			$('#pregModalImport')
				.prop('tabindex', false)
				.modal({backdrop: 'static', keyboard: false});
			$('#cargarExcel').prop('disabled', true);
			$('#cancelLoad').prop('disabled', true);

			var sheetUsuarios = workbook.Sheets['ImportUsers'];
			var jsonSheet = XLSX.utils.sheet_to_json(sheetUsuarios);

			if(jsonSheet.length > 0){
				createUsers(jsonSheet, 0);
			}
		});
		
		function createUsers(jsonUsers, i) {
			var jsonUser = jsonUsers[i];
			i++;
			jsonUser['row'] = i;
			var cantRows = jsonUsers.length;
			var porcent = (i/cantRows*100).toFixed(0);

			$.ajax({
					async: true, 
					url: 'createUserFromAjax',
					data: jsonUser,
					dataType: "json",
					type: "POST",
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				})
				.done(function( data, textStatus, jqXHR ) {
					//updateBarProgress(porcent);
					//console.log('Response: '+JSON.stringify(textStatus));
					//$('#response').html(JSON.stringify(response));
				})
				.fail(function( jqXHR, textStatus, errorThrown ) {
					//updateBarProgress(porcent, 'danger');
					//console.log('Error ajax: '+JSON.stringify(event));
					//$('#response').html(event.responseText);
				})
				.always(function( data, textStatus, jqXHR ) {
					console.log('proc: '+i+' de '+cantRows+'('+porcent+'%)');
					if (i == cantRows) {
						updateBarProgress(100);
					} else {
						updateBarProgress(porcent);
						createUsers(jsonUsers, i);
					}
					
					addLog(i, jqXHR.responseJSON);
					//console.log('ajax responseText: '+jqXHR.responseText);
					console.log('ajax Finish: '+JSON.stringify(jqXHR));
				});
		}

		function updateBarProgress(porcent, bar_class) {
			if (typeof bar_class === 'undefined') {var bar_class = 'primary';}

			$('.progress-bar-'+bar_class)
				.css('width', porcent+'%')
				.css('min-width', '2em')
				.attr('aria-valuenow', porcent)
				.find('.valuePorcent').text(porcent+' %');

				if(porcent == 100)
					$('.progress-bar-primary').addClass('progress-bar-success');
		}

		function addLog(row, log) {
			var status = log['status'];
			var logMsg = log['msg'];
			if (typeof status === 'undefined') {
				var status = 'ERR';
				var logMsg = 'Error en el servidor.';
			}

			var alert_class = '';
			switch(status){
				case 'OK':
					alert_class = 'success';
					break;
				case 'ERR':
				default:
					alert_class = 'danger';
					break;
			}

			var resultados = $('#resultadosCarga');
			resultados.append(
					'<li class="list-group-item list-group-item-'+alert_class+'" style="padding: 0px 15px;">'+
						'<strong>Fila '+row+': </strong>'+logMsg+
					'</li>'
			 	);
			if( $('#scrollLog').is(':checked') ){
    			console.log('scrollLog: '+ resultados.prop('scrollHeight'));
    			resultados.scrollTop(resultados.prop('scrollHeight'));
			}
		}

	</script>
@parent
@endsection

	{{ Form::button('<i class="fa fa-file-excel-o" aria-hidden="true"></i> Importar<span class="hidden-xs"> desde Excel</span>',[
			'class'=>'btn btn-primary',
			'data-toggle'=>'modal',
			'data-target'=>'#pregModalImport',
	]) }}

	<!-- Mensaje Modal. -->
	<div class="modal fade" id="pregModalImport" role="dialog" tabindex="-1" >
		<div class="modal-dialog">

			{{ Form::open( /*[ 'url'=>'usuarios/importXLS', 'class'=>'form-vertical', 'files'=>true ] */) }}

			<!-- Modal content-->
			<div class="modal-content panel-info">
				<div class="modal-header panel-heading" style="border-top-left-radius: inherit; border-top-right-radius: inherit;">
					<h4 class="modal-title">Importar XLS con usuarios</h4>
				</div>

				<div class="modal-body">

				{{-- Inicialmente se iba a generar la plantilla con los datos del modelo, pero por facilidad y poca disponibilidad de tiempo, se optó por un archivo ya creado y guardado en public.
					<a class='btn btn-primary' role='button' href="{{ URL::to('usuarios/plantilla/xlsx') }}">
						<i class="fa fa-download" aria-hidden="true"></i> Descargar plantilla
					</a>
				--}}
					<a class='btn btn-info' role='button' href="{{ asset('templates/TemplateImportUsers.xlsx') }}" download>
						<i class="fa fa-download" aria-hidden="true"></i> Descargar plantilla
					</a>


					<div class="form-group">
						{{ Form::label('archivo', 'Archivo') }}
						{{ Form::file('archivo', [ 
							'class' => 'form-control',
							'accept' => '.xls*',
							'required',
						]) }}
					</div>

					<div class="progress">
						<div class="progress-bar progress-bar-danger" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
							<span class="valuePorcent"></span>
						</div>
						<div class="progress-bar progress-bar-primary" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
							<span class="valuePorcent"></span>
						</div>
					</div>

				</div>

				<div class="modal-footer">

					<div class="btn btn-link">
						<label>
							<input type="checkbox" id="scrollLog" checked> Scroll log
						</label>
					</div>
					{{ Form::button('<i class="fa fa-times" aria-hidden="true"></i> Cancelar', [ 'class'=>'btn btn-default', 'data-dismiss'=>'modal', 'type'=>'button', 'id'=>'cancelLoad' ]) }}
					{{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i> Cargar', [ 'class'=>'btn btn-primary', 'type'=>'button', 'id'=>'cargarExcel', 'disabled' ]) }}

					<ul id="resultadosCarga" class="list-group" style="max-height: 150px; overflow-y: auto; margin-top: 10px;text-align: left;">
					</ul>
				</div>

			</div>

			{{ Form::close() }}
		</div>


	</div>
