@extends('emails/layout')
@section('title', '- Reserva Creada')

@section('tituloMensaje')
  <td class="alert alert-warning" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #FF9F00; margin: 0; padding: 20px;" align="center" bgcolor="#FF9F00" valign="top">
    {{ 'Reserva en '.$autorizacion->reservas->first()->sala->SALA_DESCRIPCION.'' }}
  </td>
@endsection

@section('mensaje')

  <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
      Se crearon <strong style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">{{$autorizacion->reservas->count()}} reserva(s)</strong>.
      </td>
    </tr>


    <tr>
<table class="table table-striped" id="tabla">
  <thead>
    <tr class="info">
      <th class="col-xs-1">ID</th>
      <th class="col-xs-2">Fecha y Hora Inicio</th>
      <th class="col-xs-2">Fecha y Hora Fin</th>
      <th class="col-xs-2">Descripción</th>     
      <th class="col-xs-2">Sala</th>
      <th class="col-xs-2">Sede</th>
      <th class="col-xs-2">Estado</th>
      <th class="col-xs-1">Creado por</th>      
      <th> </th>

    </tr>
  </thead>
  <tbody>


    @foreach($autorizacion->reservas as $reserva)
    <tr>
      <td>{{ $reserva -> RESE_ID }}</td>
      <td class="fecha">{{ date_format(new DateTime($reserva->RESE_FECHAINI), Config::get('view.formatDateTime')) }}</td>
      <td class="fecha">{{ date_format(new DateTime($reserva->RESE_FECHAFIN), Config::get('view.formatDateTime')) }}</td>
      <td>{{ $reserva -> RESE_TITULO }}</td>        
      <td>{{ $reserva -> sala -> SALA_DESCRIPCION }}</td>
      <td>{{ $reserva -> sala -> sede -> SEDE_DESCRIPCION }}</td>
      <td>{{ $reserva -> autorizaciones -> first() -> estado -> ESTA_DESCRIPCION }}</td>
      <td>{{ $reserva -> RESE_CREADOPOR }}</td>
    
      <td>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
    </tr>

    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
        <a href="{{ URL::to('reservas/show?sala='. $autorizacion->reservas->first()->SALA_ID ) }}" class="btn-primary" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;" target="_blank">
          Ver reporte
        </a>
      </td>
    </tr>

    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
        <div class="footer">
          <div class="text-right" style="color: #606060;padding-right:20px;">
            <small>Powered by <i>diheke</i></small>
          </div>
        </div>
      </td>
    </tr>

  </table>

@endsection