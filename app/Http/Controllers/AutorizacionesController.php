<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

use reservas\Http\Requests;
use reservas\Reserva;
use reservas\Autorizacion;
use reservas\Estado;

use Session;
use Illuminate\Support\Facades\Input;

class AutorizacionesController extends Controller
{
    protected $index = 'autorizarReservas';

    /**
     * Genera listado de reservas pendientes por autorizar.
     *
     * @return Response
     */
    public function index()
    {
        $pendientesAprobar = Autorizacion::pendientesAprobar()
                            ->orderBy('AUTO_FECHACREADO', 'desc')
                            ->get();

        //Se carga la vista y se pasan los registros.
        return view('reservas/autorizar', compact('pendientesAprobar'));
    }

    /**
     * Aprueba una reserva o grupo de reservas.
     *
     * @param  int  $AUTO_ID
     * @return Response
     */
    public function aprobar($AUTO_ID)
    {
        // Se obtiene el registro
        $autorizacion = Autorizacion::findOrFail($AUTO_ID);

        $autorizacion->AUTO_ESTADO = Estado::RESERVA_APROBADA;
        $autorizacion->AUTO_OBSERVACIONES = Input::get('AUTO_OBSERVACIONES');
        $autorizacion->save();
    
    
        // redirecciona al index de controlador
        Session::flash('modal-success', 'Autorización '.$AUTO_ID.' aprobada.');
        return redirect()->to($this->index);
    }


    /**
     * Rechaza una reserva o grupo de reservas.
     *
     * @param  int  $AUTO_ID
     * @return Response
     */
    public function rechazar($AUTO_ID)
    {
        // Se obtiene el registro
        $autorizacion = Autorizacion::findOrFail($AUTO_ID);

        $autorizacion->AUTO_ESTADO = Estado::RESERVA_RECHAZADA;
        $autorizacion->AUTO_OBSERVACIONES = Input::get('AUTO_OBSERVACIONES');
        $autorizacion->save();

        // redirecciona al index de controlador
        Session::flash('modal-warning', 'Autorización '.$AUTO_ID.' rechazada.');
        return redirect()->to($this->index);
    }

}
