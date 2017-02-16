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
        var tabContent = $('.tab-content').find('#salas');
        tabContent.empty();

        var navTop = $('.tabs-top a');
        navTop.data('sede', $(this).data('sede'));
        $('.tabs-top li').removeClass('hide');
        $('.tabs-top a:first').trigger('click');

        //$(this).tab('show')
      })

      // Inicio tab salas
      $('#tab-salas').click(function (e) {
        e.preventDefault()
        var tabContent = $('.tab-content').find('#salas');
        tabContent.empty();
        var nohaySalas=false;

        for (var i = 0 ; i < salas.length; i++) {
          if(salas[i].SEDE_ID == $(this).data('sede') && (salas[i].ESTA_ID==1)){

            nohaySalas=true;
            var html = '<div class="col-xs-3 zoom-in-hover">'+
                          '<div class="panel panel-default">'+
                            '<div class="panel-heading">'+salas[i].SALA_DESCRIPCION+'<br></div>'+
                              '<div class="panel-body">'+
                              'Cantidad de equipos:' + salas[i].SALA_CAPACIDAD+'<br><br>'+  
                              '{{ Form::open( ['url' => 'reservas/show', 'method' => 'get', 'class'=>'form-vertical' ]  ) }}'+
                              ' <input name="sala" type="hidden" value='+salas[i].SALA_ID+'>'+
                              '{{ Form::button('<i class="fa fa-ticket" aria-hidden="true"></i> Reservar', [ 'class'=>'btn btn-primary', 'type'=>'submit' ]) }}'+
                              '{{ Form::close() }}'+
                            '</div>'+
                          '</div>'+
                        '</div>';
            tabContent.append(html);
          }
        }
               if(!nohaySalas){
          var html='<br><br><br>'+
          '<div class="col-xs-12">'+
          '<div class="alert alert-info" id="note">'+
                    'Para la sede seleccionada no hay salas disponibles.'+
                    '<br><br>'+ 
                    'Ayuda: Debe ingresar al mantenimiento de salas e ingresar las salas para esta sede.'+
                    '</div>';
                    '</div>';
                    tabContent.append(html);

        } 
        $(this).tab('show')
      }) // Fin tab salas

      // Inicio tab equipos
      $('#tab-equipos').click(function (e) {
        e.preventDefault()
        var tabContent = $('.tab-content').find('#equipos');
        tabContent.empty();
        var nohayEquipos=false;
        for (var i = 0 ; i < salas.length; i++) {
          if(salas[i].SEDE_ID == $(this).data('sede') && 
            salas[i].ESTA_ID==1 &&
            salas[i].SALA_PRESTAMO==1 &&
          salas[i].equipos_disp > 0
          ){

            nohayEquipos=true;
            var html = '<div class="col-xs-3 zoom-in-hover">'+
                          '<div class="panel panel-default">'+
                            '<div class="panel-heading">'+salas[i].SALA_DESCRIPCION+'<br></div>'+
                              '<div class="panel-body">'+
                              'Total equipos:' + salas[i].SALA_CAPACIDAD+'<br>'+  
                              'Total disponibles:' + salas[i].equipos_disp+'<br><br>'+  
                              '{{ Form::open( ['url' => 'consultaEquipos', 'method' => 'get', 'class'=>'form-vertical' ]  ) }}'+
                              ' <input name="sala" type="hidden" value='+salas[i].SALA_ID+'>'+
                              '{{ Form::button('<i class="fa fa-ticket" aria-hidden="true"></i> Reservar', [ 'class'=>'btn btn-primary', 'type'=>'submit' ]) }}'+
                              '{{ Form::close() }}'+
                            '</div>'+
                          '</div>'+
                        '</div>';
            tabContent.append(html);
          }
        }

        if(!nohayEquipos){
          var html='<br><br><br>'+
          '<div class="col-xs-12">'+
          '<div class="alert alert-info" id="note">'+
                    'Para la sede seleccionada no hay salas disponibles para prestamos de Equipos.'+
                    '<br><br>'+ 
                    'Ayuda: Debe ingresar al mantenimiento de salas y habilitar una sala para prestamos de equipos.'+
                    '</div>';
                    '</div>';
                    tabContent.append(html);

        } 
        $(this).tab('show')
      }) // Fin tab equipos



      $('#tab-salas').on('shown.bs.tab', function (e) {
        //console.log(e.target) // newly activated tab
        //console.log(e.relatedTarget) // previous active tab
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
      <ul class="nav nav-tabs tabs-top">
        <li class="hide"><a href="#salas" id="tab-salas" data-toggle="tab" data-sede="">Salas</a></li>
        <li class="hide"><a href="#equipos" id="tab-equipos" data-toggle="tab" data-sede="">Equipos</a></li>
      </ul>
</div>


<div class="tab-content col-xs-offset-2">
  <div class="tab-pane fade" id="salas"></div>
  <div class="tab-pane fade" id="equipos"></div>
</div>    

@endsection