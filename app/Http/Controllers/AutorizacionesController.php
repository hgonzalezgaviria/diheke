<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;

use reservas\Http\Requests;
use reservas\Reserva;
use reservas\Autorizacion;

use Session;
use Illuminate\Support\Facades\Input;

class AutorizacionesController extends Controller
{

    /**
     * Genera listado de reservas pendientes por autorizar.
     *
     * @return Response
     */
    public function index()
    {
        $reservas = Reserva::aprobadas()->get();

        //Se carga la vista y se pasan los registros.
        return view('reservas/autorizar', compact('reservas'));
    }


}
