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

      $('#tab-salas').click(function (e) {
        e.preventDefault()
        var tabContent = $('.tab-content').find('#salas');
        tabContent.empty();

        for (var i = 0 ; i < salas.length; i++) {
          if(salas[i].SEDE_ID == $(this).data('sede')){

            var html = '<div class="col-md-4 zoom-in-hover">'+
                          '<div class="panel panel-default">'+
                            '<div class="panel-heading">'+salas[i].SALA_DESCRIPCION+'<br></div>'+
                              '<div class="panel-body">'+
                              'Texto'+
                            '</div>'+
                          '</div>'+
                        '</div>';
            tabContent.append(html);
          }
        }

        
        //$(this);
        $(this).tab('show')
      })

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


<div class="tab-content">
  <div class="tab-pane fade" id="salas"></div>
  <div class="tab-pane fade" id="equipos"></div>
</div>    

@endsection
