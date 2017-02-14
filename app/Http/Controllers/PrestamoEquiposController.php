<?php

namespace reservas\Http\Controllers;

use Illuminate\Http\Request;

use reservas\Http\Requests;
use reservas\Prestamo;
use reservas\Equipo;
use Session;

class PrestamoEquiposController extends Controller
{
	public function crearPrestamo()
	{
        $equipo = $_POST['equipo'];
        $doc_usuario = $_POST['doc_usuario'];
        $nombre = $_POST['nombre'];
        //dd($nombre);

        $prestamo = new Prestamo;
        $prestamo->PRES_IDUSARIO = $doc_usuario;
        $prestamo->PRES_NOMBREUSARIO = $nombre;
        $prestamo->EQUI_ID = $equipo;
        $prestamo->PRES_CREADOPOR = auth()->user()->username;

         $prestamo->save();

         $equipo = Equipo::findOrFail($equipo);

        $equipo->ESTA_ID = 4;
        //$equipo->edited_by = auth()->user()->username;
        $equipo->EQUI_MODIFICADOPOR = auth()->user()->username;
        $equipo->save();



   		Session::flash('message', 'Equipos prestamo!');
        return redirect()->to('home');


	}
}
