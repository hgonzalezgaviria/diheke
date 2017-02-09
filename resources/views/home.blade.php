@extends('layout')

@section('head')
	{!! Html::style('assets/css/bootstrap.vertical-tabs.css') !!}
	{!! Html::style('assets/css/hover-zoom.css') !!}
@endsection

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function () {

			//var sedes = {!! $sedes !!};
			var salas = {!! $salas !!};

			$('.tabs-left a').click(function (e) {
			  e.preventDefault()
			  var navTop = $('.nav-top a');
			  navTop.attr('data-sede', $(this).data('sede'));
			  //$(this).tab('show')
			})

			$('#tab-salas').click(function (e) {
			  e.preventDefault()
			  var tabContent = $('.tab-content').find('#salas');
			  tabContent.empty();

			  for (var i = 0 ; i < salas.length; i++) {
			  	if(salas[i].SEDE_ID == $(this).data('sede')){
			   	  tabContent.append(salas[i].SALA_DESCRIPCION+'<br>');
			    }
			  }

			  
			  //$(this);
			  $(this).tab('show')
			})

			$('#tab-salas').on('shown.bs.tab', function (e) {
			  console.log(e.target) // newly activated tab
			  console.log(e.relatedTarget) // previous active tab
			})

		});
	</script>
@parent
@endsection

@section('content')
<h1 class="page-header">Inicio</h1>

<div class="col-xs-2"><h3>Sedes</h3>
	<ul class="nav nav-tabs tabs-left">
		@foreach($sedes as $sede)
		<li><a href="#Sede{{$sede->SEDE_ID}}" data-toggle="tab" data-sede="{{$sede->SEDE_ID}}">{{$sede->SEDE_DESCRIPCION}}</a></li>
		@endforeach
	</ul>
</div>

<div class="col-xs-10">
			<ul class="nav nav-tabs nav-top">
				<li><a href="#salas" id="tab-salas" data-toggle="tab" data-sede="">Salas</a></li>
				<li><a href="#equipos" id="tab-equipos" data-toggle="tab" data-sede="">Equipos</a></li>
			</ul>
</div>


<div class="tab-content">
	<div class="tab-pane fade" id="salas"></div>
	<div class="tab-pane fade" id="equipos"></div>
</div>	  

@endsection
