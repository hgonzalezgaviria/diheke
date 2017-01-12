@extends('layout')
@section('title', '/ Sala '.$sala->SALA_ID)

@section('content')

	<h1 class="page-header">Sala {{ $sala->SALA_ID }}:</h1>

	<div class="jumbotron text-center">
		<p>
			<ul class="list-group">
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Descripción:</strong></div>
						<div class="col-lg-8">{{ $sala -> SALA_DESCRIPCION }}</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Capacidad:</strong></div>
						<div class="col-lg-8">{{ $sala -> SALA_CAPACIDAD }}</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Estado:</strong></div>
						<div class="col-lg-8">{{ $sala -> estado -> ESTA_DESCRIPCION }}</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Sede:</strong></div>
						<div class="col-lg-8">{{ $sala -> sede -> SEDE_DESCRIPCION }}</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Foto Sala:</strong></div>
						<div class="col-lg-8">
							<a href="#modalSala" data-toggle="modal" data-target="#modalSala">
							{{ Html::image(asset('img/'.$sala -> SALA_FOTOSALA), 'SALA_FOTOSALA', [
								'class'=>'img-responsive',
								'style'=>'max-width: 250px;',
							]) }}
							</a>
						</div>
					</div>
				</li>




				<li class="list-group-item">
					<div class="row">
						<div class="col-lg-4"><strong>Foto Croquis:</strong></div>
						<div class="col-lg-8">
						<a href="#modalCroquis" data-toggle="modal" data-target="#modalCroquis">						
							{{ Html::image(asset('img/'.$sala -> SALA_FOTOCROQUIS), 'SALA_FOTOCROQUIS', [
								'class'=>'img-responsive',
								'style'=>'max-width: 250px;',
							]) }}
							</a>
						</div>
					</div>
				</li>
			</ul>
		</p>
		<div class="text-right">
			<a class="btn btn-primary" role="button" href="{{ URL::to('salas/') }}">
				<i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar
			</a>
		</div>
	</div>

	<div id="modalSala" class="modal fade" role="dialog">  
		<div class="modal-dialog">
		    <div class="modal-content">      
		        <div class="modal-header">        
		            <button type="button" class="close" data-dismiss="modal">×</button>        
		            <h4 class="modal-title">Imagen Sala</h4>      </div>      
		        <div class="modal-body">
		       {{ Html::image(asset('img/'.$sala -> SALA_FOTOSALA), 'SALA_FOTOSALA', [
								'class'=>'img-responsive',
								
							]) }}
		        </div>      
		        <div class="modal-footer">        
		            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>     
		        </div>  
		    </div>  
		</div>
	</div>
	<div id="modalCroquis" class="modal fade" role="dialog">  
		<div class="modal-dialog">
		    <div class="modal-content">      
		        <div class="modal-header">        
		            <button type="button" class="close" data-dismiss="modal">×</button>        
		            <h4 class="modal-title">Imagen Croquis</h4>      </div>      
		        <div class="modal-body">
		        {{ Html::image(asset('img/'.$sala -> SALA_FOTOCROQUIS), 'SALA_FOTOCROQUIS', [
								'class'=>'img-responsive',
								
							]) }}
		        </div>      
		        <div class="modal-footer">        
		            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>     
		        </div>  
		    </div>  
		</div>
	</div>

@endsection
