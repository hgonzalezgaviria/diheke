
@section('scripts')
<script type="text/javascript">
$(function () {

	
	//Se determina cuales son los días de la semana que se encuentran seleccionados
	$("input[name=chkdias]").click(function(){
	  adiassel = $("input[name=chkdias]:checked").map(function(){
					return $(this).val();
				}).get();
	  console.log(adiassel);
	});




});
</script>
@parent
@endsection

<div class="modal fade" id="modalresdias" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content panel-info">

			<div class="modal-header panel-heading" style="border-top-left-radius: inherit; border-top-right-radius: inherit;">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Cerrar</span>
				</button>
				<h4 class="modal-title">Reservas por días</h4>
			</div>

			<div class="modal-body">

				<div class="form-vertical" role="form">

					<div class="form-group">
						<label class="col-sm-2 control-label">Facultad:</label>
						<div class="col-sm-10">
							<select class="form-control" name="facultadesd" id="facultadesd">
								<option value="0">Seleccione..</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Docente:</label>
						<div class="col-sm-10">
							<select class="form-control" name="docentesd" id="docentesd">
								<option value="">Seleccione..</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Grupo:</label>
						<div class="col-sm-10">
							<select class="form-control" name="gruposd" id="gruposd">
								<option value="">Seleccione..</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="asignaturasd" class="col-sm-2 control-label">Asignatura:</label>
						<div class="col-sm-10">
							<select class="form-control" name="asignaturasd" id="asignaturasd">
								<option value="">Seleccione..</option>
							</select>
						</div>
					</div>

					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
						<div class="row">
							<div class="col-xs-2">
								<label>
									<input type="checkbox" value="lunes" name="chkdias" id="lu"> Lunes
								</label>
							</div>
							<div class="col-xs-2">
								<label>
									<input type="checkbox" value="martes" name="chkdias" id="ma"> Martes
								</label>
							</div>
							<div class="col-xs-2">
								<label>
									<input type="checkbox" value="miércoles" name="chkdias" id="mi"> Miércoles
								</label>
							</div>
							<div class="col-xs-2">
								<label>
									<input type="checkbox" value="jueves" name="chkdias" id="ju">
									Jueves
								</label>
							</div>
							<div class="col-xs-2">
								<label>
									<input type="checkbox" value="viernes" name="chkdias" id="vi">
									Viernes
								</label>
							</div>
							<div class="col-xs-2">
								<label>
									<input type="checkbox" value="sábado" name="chkdias" id="sa">
									Sábado
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="fechainiciod" class="col-sm-2 control-label">Fecha Inicial:</label>
						<div class='col-sm-10 input-group date' id='fechainiciod'>
							{{ Form::text('fechainiciod', false, [ 'class'=>'form-control', 'required' ]) }}
							<span class="input-group-addon">
								<span class="fa fa-calendar"></span>
							</span>
						</div>
					</div>

					<div class="form-group">
						<label for="nhorasd" class="col-sm-2 control-label">Horas:</label>
						<div class='col-sm-10 input-group date' id='nhorasd'>
							{{ Form::number('nhorasd', '2', [ 'class'=>'form-control', 'min'=>'1' ,'placeholder'=>'No. de horas', 'required' ]) }}
							<span class="input-group-addon">
								<span class="fa fa-calendar"></span>
							</span>
						</div>
					</div>

					<div class="form-group">
						<label for="fechahastad" class="col-sm-2 control-label">Hasta:</label>
						<div class='col-sm-10 input-group date' id='fechahastad'>
							{{ Form::text('fechahastad', false, [ 'class'=>'form-control', 'required' ]) }}
							<span class="input-group-addon">
								<span class="fa fa-calendar"></span>
							</span>
						</div>
					</div>

				</div> <!-- end Form -->
			</div>
						
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarmodal">
					Cerrar
				</button>
				<button type="button" class="btn btn-primary" id="btn-reservadias">
					Reservar
				</button>
			</div>
		</div> <!-- end modal-content -->
	</div><!-- end modal-dialog -->
</div>


